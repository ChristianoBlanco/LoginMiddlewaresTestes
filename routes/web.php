<?php

use Illuminate\Http\Request;
//use App\Http\Middleware\PrimeiroMiddleware;


Route::get('/', function () {
    return view('welcome');
});

// -------------------------------------------------------------------------------------------- //

//EXEMPLO 1 - MIDDLEWARE
//OBS: Dentro do arquivo ""Kernel.php"" eu declaro o path da pasta onde está o arquivo de middleware;

//Route::get('/usuarios', 'UsuarioControlador@index')
//->middleware(PrimeiroMiddleware::class);
Route::get('/usuarios', 'UsuarioControlador@index')
->middleware('primeiro','segundo');
//Route::get('/usuarios', 'UsuarioControlador@index');

//EXEMPLO 2 - MIDDLEWARE COM PASSAGEM DE PARAMETROS
Route::get('/terceiro', function () {
    return 'Passou pelo terceiro';
})->middleware('terceiro:Joao,20') ;

// -------------------------------------------------------------------------------------------- //


Route::get('/produtos', 'ProdutoController@index');

Route::get('/negado', function () {
    // return "Acesso negado. Somente usuarios logados podem acessar os produtos."; // 1))
    return "Acesso negado. Somente administrador tem acesso aos produtos"; // 2))
})->name('negado');

Route::get('/negadologin', function () {
    // return "Acesso negado. Somente usuarios logados podem acessar os produtos."; // 1))
    return "Acesso negado. tem que ser administrador"; // 2))
})->name('negadologin');

Route::post('/login', function (Request $request) {
    $admin = false;
    $passwdOK = false;
    switch( $request->input('user') ) {
        case 'joao':
            $passwdOK = $request->input('passwd') === "senhajoao";
            $admin = true;
            break;
        case 'marcos':
            $passwdOK = $request->input('passwd') === "senhamarcos";
            $admin = false;
            break;
        case 'default':
            $passwdOK = false;
    }
    if ($passwdOK) {
        $login = [ 'user' => $request->input('user'), 'isadmin' => $admin ];
        $request->session()->put('login', $login);
        return response("Tudo OK!", 200);
    }
    else {
        $request->session()->flush(); //Apaga os dados em cach. Limpa os dados de uma sesssão
        return response("Erro no login", 404);
    }
});

Route::get('/logout', function (Request $request) {
    $request->session()->flush();
    return response("Deslogado com sucesso.", 200);
});


