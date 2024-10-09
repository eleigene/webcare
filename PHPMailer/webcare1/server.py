from flask import Flask, jsonify
import pandas as pd

app = Flask(__name__)

@app.route('/get_data', methods=['GET'])
def get_data():
    df = pd.read_excel('data.xlsx')
    data = df.to_dict(orient='records')
    return jsonify(data)

if __name__ == '__main__':
    app.run(debug=True)