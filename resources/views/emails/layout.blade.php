<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JobSearch')</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8fafc;
        }
        .email-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .email-content {
            padding: 30px;
        }
        .job-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .job-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a202c;
            margin: 0 0 8px 0;
        }
        .company-name {
            color: #4a5568;
            font-size: 16px;
            margin: 0 0 12px 0;
        }
        .job-details {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin: 12px 0;
        }
        .detail-item {
            color: #64748b;
            font-size: 14px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-reviewed {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-interviewed {
            background: #e0e7ff;
            color: #5b21b6;
        }
        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }
        .email-footer {
            background: #f8fafc;
            padding: 20px 30px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #e2e8f0;
        }
        .email-footer a {
            color: #3b82f6;
            text-decoration: none;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 24px 0;
        }
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-header, .email-content {
                padding: 20px;
            }
            .job-details {
                flex-direction: column;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>@yield('header-title', 'JobSearch')</h1>
            <p>@yield('header-subtitle', 'Tu plataforma de búsqueda de empleo')</p>
        </div>
        
        <div class="email-content">
            @yield('content')
        </div>
        
        <div class="email-footer">
            <p>
                Este email fue enviado por <strong>JobSearch</strong><br>
                <a href="{{ config('app.url') }}">Visitar plataforma</a> | 
                <a href="{{ config('app.url') }}/dashboard">Mi Dashboard</a>
            </p>
            <p style="margin-top: 16px; font-size: 12px; color: #94a3b8;">
                Si no deseas recibir estos emails, puedes <a href="#">darte de baja aquí</a>
            </p>
        </div>
    </div>
</body>
</html>