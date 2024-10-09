from flask import Flask, request, jsonify, render_template
import pandas as pd

app = Flask(__name__)

# Load responses from Excel
try:
    responses = pd.read_excel('data/CHATBOT.xlsx')          
    # Strip whitespace from column names
    responses.columns = responses.columns.str.strip()
    print("Excel file loaded successfully.")
    print(responses.head())  # Debugging: Print first few rows of the DataFrame
except Exception as e:
    print(f"Error loading Excel file: {e}") 
    responses = pd.DataFrame(columns=['input', 'response'])

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
