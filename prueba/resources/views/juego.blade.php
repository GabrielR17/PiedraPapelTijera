<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piedra, Papel o Tijeras</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 560px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
            text-align: center;
        }

        .titulo {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .subtitulo {
            color: rgba(255,255,255,0.45);
            font-size: 0.95rem;
            margin-bottom: 36px;
        }

        .label-jugada {
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .botones {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-jugada {
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 20px 24px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            min-width: 130px;
            color: #fff;
            font-family: inherit;
        }

        .btn-jugada:hover {
            transform: translateY(-6px) scale(1.04);
            border-color: rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.13);
            box-shadow: 0 12px 30px rgba(0,0,0,0.3);
        }

        .btn-jugada:active {
            transform: translateY(0) scale(0.97);
        }

        .btn-jugada .icono {
            font-size: 3rem;
            line-height: 1;
        }

        .btn-jugada .nombre {
            font-size: 0.9rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.85;
        }

        /* Colores por jugada */
        .btn-piedra:hover  { border-color: #e87c3e; box-shadow: 0 12px 30px rgba(232,124,62,0.3); }
        .btn-papel:hover   { border-color: #5c9fff; box-shadow: 0 12px 30px rgba(92,159,255,0.3); }
        .btn-tijeras:hover { border-color: #a78bfa; box-shadow: 0 12px 30px rgba(167,139,250,0.3); }

        /* Resultado */
        .resultado-wrap {
            margin-top: 36px;
            animation: aparecer 0.4s ease;
        }

        @keyframes aparecer {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .jugadas-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .jugador-card {
            background: rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 18px 22px;
            flex: 1;
        }

        .jugador-card .rol {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255,255,255,0.45);
            margin-bottom: 8px;
        }

        .jugador-card .emoji-jugada {
            font-size: 2.6rem;
            display: block;
            margin-bottom: 6px;
        }

        .jugador-card .nombre-jugada {
            font-size: 0.85rem;
            font-weight: 600;
            color: rgba(255,255,255,0.8);
            text-transform: capitalize;
        }

        .vs {
            font-size: 1.1rem;
            font-weight: 800;
            color: rgba(255,255,255,0.3);
            flex-shrink: 0;
        }

        .badge-resultado {
            display: inline-block;
            padding: 12px 32px;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .badge-gana    { background: linear-gradient(135deg, #22c55e, #16a34a); color: #fff; box-shadow: 0 6px 20px rgba(34,197,94,0.4); }
        .badge-pierde  { background: linear-gradient(135deg, #ef4444, #dc2626); color: #fff; box-shadow: 0 6px 20px rgba(239,68,68,0.4); }
        .badge-empate  { background: linear-gradient(135deg, #f59e0b, #d97706); color: #fff; box-shadow: 0 6px 20px rgba(245,158,11,0.4); }

        .btn-reintentar {
            margin-top: 20px;
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.6);
            padding: 10px 24px;
            border-radius: 50px;
            font-size: 0.85rem;
            cursor: pointer;
            font-family: inherit;
            transition: all 0.2s;
        }

        .btn-reintentar:hover {
            border-color: rgba(255,255,255,0.5);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1 class="titulo">Piedra, Papel o Tijeras</h1>
        <p class="subtitulo">Elige una jugada para enfrentar a la máquina</p>

        <p class="label-jugada">Tu jugada</p>

        <form action="{{ route('ppt.play') }}" method="POST">
            @csrf
            <div class="botones">
                <button type="submit" name="jugada" value="piedra" class="btn-jugada btn-piedra">
                    <span class="icono">🪨</span>
                    <span class="nombre">Piedra</span>
                </button>
                <button type="submit" name="jugada" value="papel" class="btn-jugada btn-papel">
                    <span class="icono">📄</span>
                    <span class="nombre">Papel</span>
                </button>
                <button type="submit" name="jugada" value="tijeras" class="btn-jugada btn-tijeras">
                    <span class="icono">✂️</span>
                    <span class="nombre">Tijeras</span>
                </button>
            </div>
        </form>

        @isset($resultado)
        @php
            $emojis = ['piedra' => '🪨', 'papel' => '📄', 'tijeras' => '✂️'];
            $claseResultado = str_contains($resultado, 'Ganaste') ? 'badge-gana'
                            : (str_contains($resultado, 'Perdiste') ? 'badge-pierde' : 'badge-empate');
        @endphp
        <div class="resultado-wrap">
            <div class="jugadas-grid">
                <div class="jugador-card">
                    <p class="rol">Tú</p>
                    <span class="emoji-jugada">{{ $emojis[$usuario] }}</span>
                    <p class="nombre-jugada">{{ $usuario }}</p>
                </div>
                <div class="vs">VS</div>
                <div class="jugador-card">
                    <p class="rol">Máquina</p>
                    <span class="emoji-jugada">{{ $emojis[$pc] }}</span>
                    <p class="nombre-jugada">{{ $pc }}</p>
                </div>
            </div>
            <span class="badge-resultado {{ $claseResultado }}">{{ $resultado }}</span>
            <br>
            <form action="{{ route('ppt.play') }}" method="GET">
                <button type="submit" class="btn-reintentar">↩ Jugar de nuevo</button>
            </form>
        </div>
        @endisset
    </div>
</body>
</html>