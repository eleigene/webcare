from flask import Flask, request, jsonify, render_template
from flask_cors import CORS
from fuzzywuzzy import process
import pandas as pd

app = Flask(__name__)
CORS(app)

# Load the Excel files
try:
    df = pd.read_excel("data.xlsx")
    responses = pd.read_excel('data/CHATBOT.xlsx')
    responses.columns = responses.columns.str.strip()
    print("Excel files loaded successfully.")
except Exception as e:
    print(f"Error loading Excel files: {e}")
    df = pd.DataFrame(columns=['symptom', 'condition', 'disorder', 'intervention', 'category','links'])
    responses = pd.DataFrame(columns=['input', 'response'])

@app.route('/get_data', methods=['GET'])
def get_data(): 
    return df.to_json(orient='records')

@app.route('/submit', methods=['POST'])
def submit():
    selected_symptoms = request.json['symptoms']
    
    # Filter the DataFrame based on the selected symptoms
    matched_data = df[df['symptom'].isin(selected_symptoms)]
    
    if not matched_data.empty:
        # Find the most frequent condition (mode) based on the symptoms
        condition = matched_data['condition'].mode().iloc[0]

        # Now filter the rows that exactly match this condition
        exact_row = matched_data[matched_data['condition'] == condition].iloc[0]

        # Extract the disorder and intervention from the same row
        disorder = exact_row['disorder']
        intervention = exact_row['intervention']
        links = exact_row['links']
    else:
        # Default responses if no match is found
        condition = ("The symptoms you selected do not match a specific condition. "
                     "Please consult a professional for a detailed diagnosis.")
        disorder = "Unclear"
        intervention = "Seek professional evaluation."
        links='Please select symptoms!'
    # Send the response as a JSON object
    return jsonify(condition=condition, disorder=disorder, intervention=intervention,links=links)

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/chat', methods=['POST'])
def chat():
    user_message = request.json.get("message")
    print(f"Received message: {user_message}")  # Debugging: Print received message
    response = generate_response(user_message)
    print(f"Response: {response}")  # Debugging: Print response
    return jsonify({"reply": response})

def generate_response(message):
    # Define a threshold score for similarity (e.g., 70)
    threshold = 80
    
    # Get the closest match to the user message in the 'input' column of the responses DataFrame
    possible_inputs = responses['input'].str.strip().str.lower().tolist()
    closest_match, score = process.extractOne(message.lower(), possible_inputs)

    # Check if the score meets the threshold
    if score >= threshold:
        # Find the response associated with the closest match
        response_row = responses[responses['input'].str.strip().str.lower() == closest_match]
        return response_row['response'].iloc[0]
    else:
        # Default response if no close match is found
        return "I'm sorry, I don't understand that."



if __name__ == "__main__":
    app.run(debug=True)
