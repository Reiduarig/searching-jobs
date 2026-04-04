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
            ¿Necesitas ayuda? ¡Chatea con nosotros! 💬
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
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-slate-800 animate-pulse"></div>
                </div>
                <div>
                    <h3 class="font-semibold text-white">Asistente JobSearch</h3>
                    <p class="text-xs text-slate-400">En línea • Respuesta inmediata</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button id="help-button" class="text-slate-400 hover:text-white transition-colors p-1 rounded hover:bg-slate-700/50" title="Ayuda">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </button>
                <button id="minimize-chat" class="text-slate-400 hover:text-white transition-colors p-1 rounded hover:bg-slate-700/50" title="Minimizar">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Área de mensajes -->
        <div id="chat-messages" class="h-80 overflow-y-auto p-4 space-y-4 scrollbar-thin scrollbar-thumb-slate-600 scrollbar-track-slate-800">
            <!-- Mensaje de bienvenida -->
            <div class="flex items-start space-x-3 animate-fade-in">
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
            <div id="quick-replies" class="flex flex-wrap gap-2 animate-fade-in">
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-all hover:scale-105" data-message="¿Cómo busco trabajo?">
                    🔍 ¿Cómo busco trabajo?
                </button>
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-all hover:scale-105" data-message="¿Cómo publico un trabajo?">
                    📝 ¿Cómo publico un trabajo?
                </button>
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-all hover:scale-105" data-message="Problemas técnicos">
                    ⚙️ Problemas técnicos
                </button>
                <button class="quick-reply bg-slate-700/30 hover:bg-slate-700/50 text-slate-300 hover:text-white px-3 py-2 rounded-full text-xs transition-all hover:scale-105" data-message="Contacto">
                    📞 Contacto
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
                        class="w-full bg-slate-700/30 border border-slate-600/50 rounded-full px-4 py-2 text-sm text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 pr-10 transition-all"
                        maxlength="500"
                    >
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <span id="char-counter" class="text-xs text-slate-500">500</span>
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white p-2 rounded-full transition-all duration-200 transform hover:scale-110 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
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

            <!-- Información adicional -->
            <div class="mt-2 text-center">
                <p class="text-xs text-slate-500">
                    Potenciado por IA • <button id="feedback-btn" class="text-blue-400 hover:text-blue-300 underline">Enviar feedback</button>
                </p>
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
    const sendButton = document.getElementById('send-button');
    const charCounter = document.getElementById('char-counter');
    const helpButton = document.getElementById('help-button');
    const feedbackBtn = document.getElementById('feedback-btn');
    
    let isChatOpen = false;
    let isTyping = false;

    // CSRF token para las peticiones
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function toggleChat() {
        isChatOpen = !isChatOpen;
        
        if (isChatOpen) {
            chatWindow.classList.remove('translate-y-4', 'opacity-0', 'scale-95', 'pointer-events-none');
            chatWindow.classList.add('translate-y-0', 'opacity-100', 'scale-100');
            chatIcon.classList.add('hidden');
            closeChatIcon.classList.remove('hidden');
            chatInput.focus();
            // Ocultar notificación
            document.getElementById('chat-notification').classList.add('hidden');
        } else {
            chatWindow.classList.add('translate-y-4', 'opacity-0', 'scale-95', 'pointer-events-none');
            chatWindow.classList.remove('translate-y-0', 'opacity-100', 'scale-100');
            chatIcon.classList.remove('hidden');
            closeChatIcon.classList.add('hidden');
        }
    }

    function addMessage(message, isUser = false, timestamp = null) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-start space-x-3 animate-fade-in';
        
        const time = timestamp || new Date().toLocaleTimeString('es-ES', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
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
                    <div class="mt-1 text-xs text-slate-500">${time}</div>
                </div>
            `;
        }
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function showTypingIndicator() {
        if (!isTyping) {
            isTyping = true;
            typingIndicator.classList.remove('hidden');
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    function hideTypingIndicator() {
        if (isTyping) {
            isTyping = false;
            typingIndicator.classList.add('hidden');
        }
    }

    async function sendMessageToBot(message) {
        try {
            const response = await fetch('/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || '',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ message: message })
            });

            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error:', error);
            return {
                response: '🔧 Lo siento, hay un problema temporal con el servidor. Intenta de nuevo en unos momentos o contacta con soporte.',
                timestamp: new Date().toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' })
            };
        }
    }

    async function handleUserMessage(message) {
        if (!message.trim() || isTyping) return;
        
        addMessage(message, true);
        chatInput.value = '';
        updateCharCounter();
        sendButton.disabled = true;
        
        showTypingIndicator();
        
        // Simular tiempo de procesamiento realista
        const minDelay = 800;
        const maxDelay = 2000;
        const delay = Math.random() * (maxDelay - minDelay) + minDelay;
        
        setTimeout(async () => {
            const botResponse = await sendMessageToBot(message);
            hideTypingIndicator();
            addMessage(botResponse.response, false, botResponse.timestamp);
            sendButton.disabled = false;
        }, delay);
    }

    function updateCharCounter() {
        const remaining = 500 - chatInput.value.length;
        charCounter.textContent = remaining;
        charCounter.classList.toggle('text-red-400', remaining < 50);
        charCounter.classList.toggle('text-yellow-400', remaining >= 50 && remaining < 100);
        charCounter.classList.toggle('text-slate-500', remaining >= 100);
    }

    function showHelp() {
        const helpMessage = `ℹ️ **Cómo usar el chat:**

• Escribe tu pregunta y presiona Enter
• Usa los botones de respuesta rápida
• Máximo 500 caracteres por mensaje
• Puedes preguntar sobre trabajos, empresas, cuenta, etc.

**Comandos útiles:**
• "contacto" - Información de contacto
• "ayuda" - Mostrar esta ayuda
• "faq" - Preguntas frecuentes`;
        
        addMessage(helpMessage, false);
    }

    // Event listeners
    chatToggle.addEventListener('click', toggleChat);
    minimizeChat.addEventListener('click', toggleChat);
    helpButton.addEventListener('click', showHelp);

    chatForm.addEventListener('submit', (e) => {
        e.preventDefault();
        handleUserMessage(chatInput.value);
    });

    chatInput.addEventListener('input', updateCharCounter);
    chatInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });

    quickReplies.forEach(button => {
        button.addEventListener('click', () => {
            const message = button.dataset.message;
            handleUserMessage(message);
            // Ocultar botones de respuesta rápida después de usar uno
            document.getElementById('quick-replies').style.display = 'none';
        });
    });

    feedbackBtn.addEventListener('click', () => {
        const feedbackMessage = "📝 **Enviar Feedback:**\n\n¿Cómo podemos mejorar? Tu opinión es importante:\n• feedback@jobsearch.com\n• Teléfono: +34 600 000 000\n\n¡Gracias por ayudarnos a mejorar! 🙏";
        addMessage(feedbackMessage, false);
    });

    // Mostrar notificación después de 15 segundos si no se ha abierto el chat
    setTimeout(() => {
        if (!isChatOpen) {
            document.getElementById('chat-notification').classList.remove('hidden');
            
            // Auto-ocultar después de 10 segundos más
            setTimeout(() => {
                document.getElementById('chat-notification').classList.add('hidden');
            }, 10000);
        }
    }, 15000);

    // Inicializar contador
    updateCharCounter();
});
</script>

<!-- Estilos adicionales para animaciones -->
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

.scrollbar-thin::-webkit-scrollbar {
    width: 4px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: rgb(30 41 59 / 0.3);
    border-radius: 2px;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: rgb(71 85 105);
    border-radius: 2px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: rgb(100 116 139);
}
</style>