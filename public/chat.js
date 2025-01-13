const chatBox = document.getElementById('chat-box');
const messageInput = document.getElementById('message-input');
const sendBtn = document.getElementById('send-btn');
const recipientSelect = document.getElementById('recipient');

// senderId ya está disponible como variable global
let recipientId = null; // El destinatario aún no está seleccionado

async function fetchUsers() {
    const response = await fetch(`../server/fetch_users.php?idUser=${window.senderId}`);
    const users = await response.json();

    recipientSelect.innerHTML = '<option value="">Seleccionar Usuario</option>';
    users.forEach(user => {
        const option = document.createElement('option');
        option.value = user.idUser;
        option.textContent = user.userName;
        recipientSelect.appendChild(option);
    });
}

async function fetchMessages() {
    if (!recipientId) return;

    const response = await fetch(`../server/fetch_messages.php?recipient_id=${recipientId}`);
    const messages = await response.json();
    chatBox.innerHTML = '';

    console.log('Mensajes recibidos:', messages);

    messages.forEach(message => {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('p-2', 'rounded-lg', 'mb-2', 'max-w-md');
        messageDiv.style.wordBreak = 'break-word';

        if (message.sender_id === window.senderId) {
            messageDiv.classList.add('ml-auto', 'bg-blue-500', 'text-white');
        } else {
            messageDiv.classList.add('bg-gray-200', 'text-black');
        }

        messageDiv.innerHTML = `<strong>${message.sender_name}</strong>: ${message.message}`;
        chatBox.appendChild(messageDiv);
    });

    chatBox.scrollTop = chatBox.scrollHeight;
}

async function sendMessage() {
    const message = messageInput.value.trim();
    if (!message || !recipientId) return;

    await fetch('../server/send_message.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ sender_id: window.senderId, recipient_id: recipientId, message })
    }).then(response => response.json())
      .then(data => console.log('Respuesta del servidor:', data))
      .catch(error => console.error('Error al enviar el mensaje:', error));

    messageInput.value = '';
    fetchMessages();
}

sendBtn.addEventListener('click', sendMessage);
messageInput.addEventListener('keypress', e => {
    if (e.key === 'Enter') sendMessage();
});

recipientSelect.addEventListener('change', () => {
    recipientId = recipientSelect.value;
    console.log('Destinatario seleccionado:', recipientId);
    fetchMessages();
});

setInterval(fetchMessages, 2000);

// Cargar usuarios al inicio
fetchUsers();
