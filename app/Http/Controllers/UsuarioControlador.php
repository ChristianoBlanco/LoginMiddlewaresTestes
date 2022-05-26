<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
class UsuarioControlador extends Controller
{
  public function __construct()
  {
     //$this->middleware('primeiro'); 
  }  
    public function index(){
      Log::debug('UsuarioControlador@index');
        echo "<h3>Lista de Usuarios</h3>";
        echo "<ul>";
        echo "<li>Usuario Joao</li>";
        echo "<li>Usuario Maria</li>";
        echo "</ul>"; 
    }
}
