<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Piedra, Papel o Tijeras</title>
    <style>
        body { 
            font-family: Arial, sans-serif; text-align: center;
            margin-top: 40px; background: #f5f5f5; }
        button { padding: 10px 20px; margin: 10px; border: none;
            border-radius: 8px; font-size: 18px; cursor: pointer;
            transition: transform .2s; }
        button:hover { transform: scale(1.1); }
            .resultado { margin-top: 35px; background: #fff;
            display: inline-block; padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,.15); }
    </style>
</head>
<body>
    <h2>Juego: Piedra, Papel o Tijeras</h2>
    <form action="{{ route('ppt.play') }}" method="POST">
        @csrf
        <label>Elige tu jugada:</label><br><br>
        <button type="submit" name="jugada" value="piedra">Piedra</button>
        <button type="submit" name="jugada" value="papel">Papel</button>
        <button type="submit" name="jugada" value="tijeras">Tijeras</button>
    </form>
    @isset($resultado)
        <div class="resultado">
            <h3>Tu jugada: <strong>{{ $usuario }}</strong></h3>
            <h3>PC jugo: <strong>{{ $pc }}</strong></h3>
            <h2>{{ $resultado }}</h2>
        </div>
    @endisset
</body>
</html>