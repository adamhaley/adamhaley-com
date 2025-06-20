document.addEventListener('DOMContentLoaded', () => {
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const chatMessages = document.getElementById('chat-messages');
    const chatContainer = document.querySelector('.chat-container');
    const closeButton = document.querySelector('.close-button');
    const reopenButton = document.querySelector('.reopen-chat-button');
    
    // Replace this with your actual webhook URL
    const WEBHOOK_URL = 'https://n8n.ahmedia.ai/webhook/3c8f2fca-5a61-4402-887c-a43f6c137e73';
    //const WEBHOOK_URL = 'https://n8n.ahmedia.ai/webhook-test/3c8f2fca-5a61-4402-887c-a43f6c137e73';


    function createTypingIndicator() {
        const indicator = document.createElement('div');
        indicator.className = 'typing-indicator';
        
        // Create three dots
        for (let i = 0; i < 3; i++) {
            const dot = document.createElement('div');
            dot.className = 'typing-dot';
            indicator.appendChild(dot);
        }
        
        return indicator;
    }

    function addMessage(message, isUser = true) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${isUser ? 'user-message' : 'bot-message'}`;
        
        // Parse the message text
        const parsedMessage = message
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/\n/g, '<br>');
            
        messageDiv.innerHTML = parsedMessage;
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    async function sendMessage(message) {
        if (!message.trim()) return;

        // Disable input while processing
        chatInput.disabled = true;
        sendButton.disabled = true;

        // Add user message to chat
        addMessage(message, true);

        // Show typing indicator
        const typingIndicator = createTypingIndicator();
        chatMessages.appendChild(typingIndicator);
        chatMessages.scrollTop = chatMessages.scrollHeight;

        try {
            const response = await fetch(WEBHOOK_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ message: message })
            });

            // Remove typing indicator
            if (typingIndicator && typingIndicator.parentNode) {
                chatMessages.removeChild(typingIndicator);
            }

            if (!response.ok) {
                throw new Error('Failed to send message');
            }

            const data = await response.json();
            console.log(data.output);
            
            // Add the response to the chat with parsed formatting
            addMessage(data.output, false);

            // Clear input after successful send
            chatInput.value = '';
        } catch (error) {
            // Remove typing indicator if it exists
            if (typingIndicator && typingIndicator.parentNode) {
                chatMessages.removeChild(typingIndicator);
            }
            
            console.error('Error sending message:', error);
            addMessage('Failed to send message. Please try again.', false);
        } finally {
            // Re-enable input
            chatInput.disabled = false;
            sendButton.disabled = false;
            chatInput.focus();
        }
    }

    // Handle close button click
    closeButton.addEventListener('click', () => {
        chatContainer.style.display = 'none';
        reopenButton.style.display = 'flex';
    });

    // Handle reopen button click
    reopenButton.addEventListener('click', () => {
        chatContainer.style.display = 'flex';
        reopenButton.style.display = 'none';
    });

    // Handle send button click
    sendButton.addEventListener('click', () => {
        sendMessage(chatInput.value);
    });

    // Handle Enter key press
    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage(chatInput.value);
        }
    });
}); 
