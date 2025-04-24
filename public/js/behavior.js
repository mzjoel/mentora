const agentUrl = "https://sasana-be-chat-ts.sasana.ai/v3/chat";  
const agentKey = "bKNUvAY357niO64xpn6N8w2hGJHuUdaIWDlR4VahWE";
const agentHeaders = {  
    "Content-Type": "application/json",  
    "X-API-KEY": agentKey  
};  

function displayGreeting(sender, message){
    const chatDiv = document.getElementById('chat');
    chatDiv.innerHTML += `<div class="${sender === 'Anda' ? 'user-message' : 'agent-message'}"><strong>${sender}:</strong> ${message}</div>`;    
    chatDiv.scrollTop = chatDiv.scrollHeight; 
}
  

fetch('/generate-id', {  
    method: "GET",  
    agentHeaders: {  
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')  
    }  
})  
.then(response => response.json())  
.then(data => {  
    const userId = data.userId;  
    const sessionId = data.sessionId;  
    const agentId = data.agentId;  

    //Initial Greeting 
    const greeting = "Halo, ada yang bisa saya bantu?";
    displayGreeting("MentoraAgent", greeting);
  
    document.getElementById('send').addEventListener('click', () => {  
        const message = document.getElementById('message').value; 
        const sendButton = document.getElementById('send');
        setButtonState(sendButton, 'processing');
  
        const dataToSend = {  
            message: message,  
            userId: userId,  
            sessionId: sessionId,  
            agentId: agentId  
        };  
  
        fetch(agentUrl, {  
            method: "POST",  
            agentHeaders: agentHeaders,  
            body: JSON.stringify(dataToSend)  
        })  
        .then(response => {  
            if (!response.ok) {  
                throw new Error('Network response was not ok');  
            }  
            return response.json();  
        })  
        .then(data => {  
            displayGreeting("You", message );
            displayGreeting("MentoraAgent", data.data.content);
            document.getElementById('message').value = '';
            setButtonState(sendButton, 'finished');
        })  
        .catch(error => console.error('Error:', error));  
    });  
})  
.catch(error => console.error('Error fetching IDs:', error));  