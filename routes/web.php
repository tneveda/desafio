<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Mail\ComprasMail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


 
Route::get('/get_produtos', [ProdutoController::class, 'getProdutos']);
Route::get('/get_produtos/{id}', [ProdutoController::class, 'getProdutoById']);
Route::post('/mail-send', [ProdutoController::class, 'mailSend']);

/*Route::get('send-email', function(){
       $data= [
        "nome" => "TEST NAME",
        "transportadora"=> "DHL"
        
       ];
     Mail::to("example@mail.com")->send( new ComprasMail($data));
     dd("Enviado");
    }

)*/
?>