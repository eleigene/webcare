from flask import Flask, request, jsonify, render_template
from flask_cors import CORS
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
    df = pd.DataFrame(columns=['symptom', 'condition', 'disorder', 'intervention'])
    responses = pd.DataFrame(columns=['input', 'response'])

@app.route('/get_data', methods=['GET'])
def get_data(): 
    return df.to_json(orient='records')

@app.route('/submit', methods=['POST'])
def submit():
    selected_symptoms = request.json['symptoms']
    matched_data = df[df['symptom'].isin(selected_symptoms)]
    if not matched_data.empty:
        condition = matched_data['condition'].iloc[0]
        disorder = matched_data['disorder'].iloc[0]
        intervention = matched_data['intervention'].iloc[0]
    else:
        condition = ("The symptoms you selected do not match a specific disorder that can be determined through this checklist. "
                     "It is possible that you are experiencing a combination of symptoms that require a more comprehensive evaluation by a mental health professional. "
                     "It is important to seek a detailed assessment to identify and address any underlying issues.")
        disorder = "Unclear"
        intervention = ("Seek a comprehensive evaluation from a mental health professional who can provide a detailed diagnosis and treatment plan. "
                        "Maintaining a healthy lifestyle, including regular exercise, a balanced diet, and good sleep hygiene, can support overall mental health. "
                        "Engage in stress-reducing activities such as yoga, meditation, or hobbies you enjoy. Building a support network with family and friends can also provide emotional support.")
    return jsonify(condition=condition, disorder=disorder, intervention=intervention)

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
    for index, row in responses.iterrows():
        input_text = row['input'].strip().lower()
        if input_text in message.lower():
            return row['response']
    return "I'm sorry, I don't understand that."

if __name__ == "__main__":
    app.run(debug=True)
