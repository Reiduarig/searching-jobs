<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controlador para el chatbot de atención al cliente
 * Proporciona respuestas automáticas a preguntas frecuentes y asistencia básica
 * Utiliza reglas simples para determinar la intención del usuario y responder adecuadamente
 * No utiliza IA avanzada, pero puede ser extendido en el futuro
 */

/**
 * Opciones de mejora futura:
 * 1. Integrar con OpenAI GPT para respuestas más naturales
 * 2. Usar DialogFlow de Google para NLP avanzado
 * 3. Implementar un sistema de NLP personalizado
 * 4. Guardar historial de chat para mejorar respuestas
 * 5. Analíticas de consultas para identificar áreas comunes de ayuda
 * 6. Permitir feedback de usuarios sobre respuestas del bot
 * 7. Integrar con WhatsApp Business API para soporte multicanal
 * 8. Conectar con plataformas de soporte como Zendesk o Intercom
 * 9. Usar Slack para soporte interno del equipo
 */
class ChatbotController extends Controller
{
    /**
     * Procesar mensajes del chatbot
     */
    public function processMessage(Request $request): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $message = strtolower(trim($request->message));
        $response = $this->getBotResponse($message);

        return response()->json([
            'response' => $response,
            'timestamp' => now()->format('H:i'),
        ]);
    }

    /**
     * Obtener respuesta del bot basada en el mensaje
     */
    private function getBotResponse(string $message): string
    {
        $responses = [
            'buscar trabajo' => [
                'keywords' => ['buscar', 'trabajo', 'empleo', 'busqueda'],
                'response' => "Para buscar trabajo en JobSearch:\n\n1. 🔍 Usa la barra de búsqueda principal\n2. 📋 Explora por categorías\n3. 🌟 Revisa trabajos destacados\n4. 📱 Crea tu perfil\n\n¿Necesitas ayuda con algún paso específico?",
            ],
            'publicar trabajo' => [
                'keywords' => ['publicar', 'crear', 'empleo', 'empresa', 'reclutar'],
                'response' => "Para publicar un trabajo:\n\n1. 📝 Clic en 'Publicar Trabajo'\n2. 🏢 Información de empresa\n3. 💼 Detalles del puesto\n4. 💰 Salario y beneficios\n5. ✅ Revisar y publicar\n\n¿Qué información necesitas?",
            ],
            'problemas tecnicos' => [
                'keywords' => ['problema', 'error', 'bug', 'no funciona', 'tecnico'],
                'response' => "🔧 Soluciones rápidas:\n\n• Actualizar página (F5)\n• Limpiar caché\n• Verificar conexión\n• Modo incógnito\n\n¿Persiste el problema? Describe qué ocurre.",
            ],
            'cuenta' => [
                'keywords' => ['cuenta', 'perfil', 'registro', 'login', 'contraseña'],
                'response' => "👤 Para tu cuenta:\n\n• Registro: Clic en 'Registrarse'\n• Login: 'Iniciar Sesión'\n• Recuperar contraseña: Link en login\n• Editar perfil: Después de iniciar sesión\n\n¿Qué necesitas hacer?",
            ],
            'salario' => [
                'keywords' => ['salario', 'sueldo', 'pago', 'dinero', 'cuanto'],
                'response' => "💰 Sobre salarios:\n\n• Los rangos se muestran en cada oferta\n• Puedes filtrar por salario\n• Negocia siempre en entrevistas\n• Consulta promedios del mercado\n\n¿Buscas algo específico?",
            ],
        ];

        foreach ($responses as $category => $data) {
            foreach ($data['keywords'] as $keyword) {
                if (str_contains($message, $keyword)) {
                    return $data['response'];
                }
            }
        }

        // Respuestas específicas a preguntas comunes
        if (str_contains($message, 'hola') || str_contains($message, 'saludos')) {
            return '¡Hola! 👋 Bienvenido a JobSearch. ¿En qué puedo ayudarte hoy?';
        }

        if (str_contains($message, 'gracias')) {
            return '¡De nada! 😊 ¿Hay algo más en lo que pueda ayudarte?';
        }

        if (str_contains($message, 'contacto') || str_contains($message, 'soporte')) {
            return "📞 Contacto:\n\n• Email: soporte@jobsearch.com\n• WhatsApp: +34 600 000 000\n• Horario: Lun-Vie 9:00-18:00\n\n¿Prefieres que te conecte con un agente humano?";
        }

        // Respuesta por defecto
        return "🤔 Entiendo que necesitas ayuda. Puedo asistirte con:\n\n• Búsqueda de empleos\n• Publicar trabajos\n• Problemas técnicos\n• Gestión de cuenta\n• Información de salarios\n\n¿Sobre qué te gustaría saber más?";
    }

    /**
     * Obtener preguntas frecuentes
     */
    public function getFAQ(): JsonResponse
    {
        $faqs = [
            [
                'question' => '¿Cómo busco trabajo?',
                'answer' => 'Usa la barra de búsqueda, explora categorías o revisa trabajos destacados.',
                'category' => 'búsqueda',
            ],
            [
                'question' => '¿Es gratis para candidatos?',
                'answer' => 'Sí, buscar y aplicar a trabajos es completamente gratuito.',
                'category' => 'precio',
            ],
            [
                'question' => '¿Cómo publico un trabajo?',
                'answer' => 'Regístrate como empresa y usa el botón "Publicar Trabajo".',
                'category' => 'empresas',
            ],
            [
                'question' => '¿Puedo editar mi perfil?',
                'answer' => 'Sí, después de iniciar sesión puedes actualizar toda tu información.',
                'category' => 'perfil',
            ],
        ];

        return response()->json($faqs);
    }
}
