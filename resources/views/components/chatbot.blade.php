<!-- Botón flotante del chatbot -->
<div id="chatbot-container" class="fixed bottom-6 right-6 z-50">
    <!-- Botón principal del chat -->
    <button id="chatbot-toggle" class="group relative bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-4 rounded-full shadow-2xl hover:shadow-blue-500/25 transition-all duration-300 transform hover:scale-110">
        <!-- Indicador de notificación -->
        <div id="chat-notification" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse hidden"></div>
        
        <!-- Icono de chat -->
        <svg id="chat-icon" class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
        </svg>
        
        <!-- Icono de cerrar -->
        <svg id="close-chat-icon" class="w-6 h-6 hidden transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
        
        <!-- Tooltip -->
        <div class="absolute bottom-full right-0 mb-2 px-3 py-2 bg-slate-800 text-white text-sm rounded-lg shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 whitespace-nowrap">
            ¿Necesitas ayuda? ¡Chatea con nosotros!
            <div class="absolute top-full right-4 w-0 h-0 border-l-4 border-r-4 border-t-4 border-transparent border-t-slate-800"></div>
        </div>
    </button>

    <!-- Ventana del chat -->
    <div id="chatbot-window" class="absolute bottom-20 right-0 w-80 sm:w-96 bg-slate-800/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-700/50 transform translate-y-4 opacity-0 scale-95 pointer-events-none transition-all duration-300">
        <!-- Header del chat -->
        <div class="flex items-center justify-between p-4 border-b border-slate-700/50">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-slate-800"></div>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Asistente JobSearch</h3>
                    <p class="text-xs text-slate-400">En línea • Responde en minutos</p>
                </div>
            </div>
            <button id="minimize-chat" class="text-slate-400 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>

        <!-- Área de mensajes -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-4 scrollbar-thin scrollbar-thumb-slate-600 scrollbar-track-slate-800">
            <!-- Mensaje de bienvenida -->
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="bg-slate-700/50 rounded-2xl rounded-tl-md p-3">
                        <p class="text-slate-200 text-sm">¡Hola! 👋 Soy tu asistente de JobSearch. ¿En qué puedo ayudarte hoy?</p>
                    </div>
                    <div class="mt-1 text-xs text-slate-500">Hace un momento</div>
                </div>
            </div>

            <!-- Opciones rápidas -->
            <div class="flex flex-wrap gap-2">
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-colors" data-message="¿Cómo busco trabajo?">
                    🔍 ¿Cómo busco trabajo?
                </button>
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-colors" data-message="¿Cómo publico un trabajo?">
                    📝 ¿Cómo publico un trabajo?
                </button>
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-colors" data-message="Problemas técnicos">
                    ⚙️ Problemas técnicos
                </button>
            </div>
        </div>

        <!-- Área de escritura -->
        <div class="p-4 border-t border-slate-700/50">
            <form id="chat-form" class="flex items-center space-x-2">
                <div class="flex-1 relative">
                    <input 
                        id="chat-input" 
                        type="text" 
                        placeholder="Escribe tu mensaje..." 
                        class="w-full bg-slate-700/30 border border-slate-600/50 rounded-full px-4 py-2 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10"
                        maxlength="500"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                        </svg>
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-2 rounded-full transition-all duration-200 transform hover:scale-110 disabled:opacity-50 disabled:cursor-not-allowed"
                    id="send-button"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
            
            <!-- Indicador de escritura -->
            <div id="typing-indicator" class="hidden mt-2">
                <div class="flex items-center space-x-2 text-slate-400 text-xs">
                    <div class="flex space-x-1">
                        <div class="w-1 h-1 bg-slate-400 rounded-full animate-bounce"></div>
                        <div class="w-1 h-1 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-1 h-1 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                    <span>El asistente está escribiendo...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatToggle = document.getElementById('chatbot-toggle');
    const chatWindow = document.getElementById('chatbot-window');
    const minimizeChat = document.getElementById('minimize-chat');
    const chatIcon = document.getElementById('chat-icon');
    const closeChatIcon = document.getElementById('close-chat-icon');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');
    const typingIndicator = document.getElementById('typing-indicator');
    const quickReplies = document.querySelectorAll('.quick-reply');
    
    let isChatOpen = false;

    // Respuestas predefinidas del chatbot
    const responses = {
        '¿cómo busco trabajo?': 'Para buscar trabajo en JobSearch: \n\n1. 🔍 Usa la barra de búsqueda en la página principal\n2. 📋 Navega por las categorías disponibles\n3. 🌟 Revisa los trabajos destacados\n4. 📱 Crea tu perfil para recibir notificaciones\n\n¿Te gustaría que te ayude con algo específico?',
        '¿cómo publico un trabajo?': 'Para publicar un trabajo: \n\n1. 📝 Haz clic en "Publicar Trabajo" en el menú\n2. 🏢 Completa la información de tu empresa\n3. 💼 Describe el puesto y requisitos\n4. 💰 Indica el salario y beneficios\n5. ✅ Revisa y publica\n\n¿Necesitas ayuda con algún paso específico?',
        'problemas técnicos': 'Lamento que tengas problemas técnicos. Estos son los más comunes:\n\n🔧 **Soluciones rápidas:**\n• Actualiza la página (F5)\n• Limpia caché del navegador\n• Verifica tu conexión a internet\n• Prueba en modo incógnito\n\n¿El problema persiste? Describe qué está ocurriendo para ayudarte mejor.',
        'default': '🤔 Entiendo que necesitas ayuda. Puedes preguntarme sobre:\n\n• Búsqueda de empleos\n• Publicación de trabajos\n• Problemas técnicos\n• Información sobre la plataforma\n\n¿En qué específicamente puedo asistirte?'
    };

    function toggleChat() {
        isChatOpen = !isChatOpen;
        
        if (isChatOpen) {
            chatWindow.classList.remove('translate-y-4', 'opacity-0', 'scale-95', 'pointer-events-none');
            chatWindow.classList.add('translate-y-0', 'opacity-100', 'scale-100');
            chatIcon.classList.add('hidden');
            closeChatIcon.classList.remove('hidden');
            chatInput.focus();
        } else {
            chatWindow.classList.add('translate-y-4', 'opacity-0', 'scale-95', 'pointer-events-none');
            chatWindow.classList.remove('translate-y-0', 'opacity-100', 'scale-100');
            chatIcon.classList.remove('hidden');
            closeChatIcon.classList.add('hidden');
        }
    }

    function addMessage(message, isUser = false) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3';
        
        if (isUser) {
            messageDiv.innerHTML = `
                <div class="flex-1 flex justify-end">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl rounded-tr-md p-3 max-w-xs">
                        <p class="text-white text-sm">${message}</p>
                    </div>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="bg-slate-700/50 rounded-2xl rounded-tl-md p-3">
                        <p class="text-slate-200 text-sm whitespace-pre-line">${message}</p>
                    </div>
                    <div class="mt-1 text-xs text-slate-500">Ahora</div>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTypingIndicator() {
        typingIndicator.classList.remove('hidden');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function hideTypingIndicator() {
        typingIndicator.classList.add('hidden');
    }

    function getBotResponse(userMessage) {
        const normalizedMessage = userMessage.toLowerCase().trim();
        
        for (const [key, response] of Object.entries(responses)) {
            if (key !== 'default' && normalizedMessage.includes(key)) {
                return response;
            }
        }
        
        return responses.default;
    }

    function handleUserMessage(message) {
        if (!message.trim()) return;
        
        addMessage(message, true);
        chatInput.value = '';
        
        showTypingIndicator();
        
        // Simular tiempo de respuesta
        setTimeout(() => {
            hideTypingIndicator();
            const response = getBotResponse(message);
            addMessage(response);
        }, 1000 + Math.random() * 1500);
    }

    // Event listeners
    chatToggle.addEventListener('click', toggleChat);
    minimizeChat.addEventListener('click', toggleChat);

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();
        handleUserMessage(chatInput.value);
    });

    quickReplies.forEach(button => {
        button.addEventListener('click', () => {
            const message = button.dataset.message;
            handleUserMessage(message);
            // Ocultar botones de respuesta rápida después de usar uno
            button.parentElement.style.display = 'none';
        });
    });

    // Mostrar notificación después de 10 segundos si no se ha abierto el chat
    setTimeout(() => {
        if (!isChatOpen) {
            document.getElementById('chat-notification').classList.remove('hidden');
        }
    }, 10000);
});
</script>