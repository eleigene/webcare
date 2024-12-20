<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Chatbot</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400&family=Raleway&family=Rowdies&family=Satisfy&family=Assistant&display=swap" rel="stylesheet">
    <style>
        /* General body styling */
        body {
            background-color: #F5F7F5;
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container styling */
        .container {
            max-width: 1100px;
            margin: 50px auto;
            background-color: #FFFFFF;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            border-radius: 40px;
            padding: 20px;
        }

        /* Header styling */
        .header {
            text-align: center;
            font-family: 'Satisfy', cursive;
            font-size: 36px;
            color: #00796b;
            margin-bottom: 20px;
        }

        /* Chatbox styling */
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 400px;
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .message {
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 10px;
            max-width: 80%;
        }

        .user-message {
            background-color: #d4edda;
            color: #155724;
            align-self: flex-end;
        }

        .bot-message {
            background-color: #cce5ff;
            color: #007bff;
            align-self: flex-start;
        }

        /* Input styling */
        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 0 0 10px 10px;
        }

        .message-input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            font-size: 16px;
        }

        .send-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .send-button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="header">Mental Health Chatbot</h1>
        
        <div class="chat-container">
            <div class="messages" id="chat-messages"></div>
            <div class="input-container">
                <input type="text" id="user-input" class="message-input" placeholder="Type a message...">
                <button class="send-button" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>

    <script>
        function sendMessage() {
            var inputField = document.getElementById("user-input");
            var message = inputField.value;
            if (message.trim() === "") return;

            // Display the user's message
            var userMessageContainer = document.createElement("div");
            userMessageContainer.classList.add("message", "user-message");
            userMessageContainer.textContent = message;
            document.getElementById("chat-messages").appendChild(userMessageContainer);

            // Send message to backend
            fetch("/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message: message })
            })
            .then(response => response.json())
            .then(data => {
                // Display bot response
                var botMessageContainer = document.createElement("div");
                botMessageContainer.classList.add("message", "bot-message");
                botMessageContainer.textContent = data.reply;
                document.getElementById("chat-messages").appendChild(botMessageContainer);

                // Clear input field
                inputField.value = "";
                document.getElementById("chat-messages").scrollTop = document.getElementById("chat-messages").scrollHeight;
            })
            .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>
