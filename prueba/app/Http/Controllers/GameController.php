<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class GameController extends Controller
{
 public function index()
 {
 return view('juego');
 }
 public function play(Request $request)
 {
 $opciones = ['piedra', 'papel', 'tijeras'];
 $usuario = $request->input('jugada');
 $pc = $opciones[array_rand($opciones)];
 if ($usuario === $pc) {
 $resultado = 'Empate';
 } elseif (
 ($usuario == 'piedra' && $pc == 'tijeras') ||
 ($usuario == 'papel' && $pc == 'piedra') ||
 ($usuario == 'tijeras' && $pc == 'papel')
 ) {
 $resultado = 'Ganaste!';
 } else {
 $resultado = 'Perdiste';
 }
 return view('juego', compact('usuario', 'pc', 'resultado'));
 }
}