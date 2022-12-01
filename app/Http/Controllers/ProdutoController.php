<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Mail\ComprasMail;
use Illuminate\Support\Facades\Mail;

class ProdutoController extends Controller
{
   /** 
     *Retorna os dados dos Produtos
     *
     * @return void
     */
    public function getProdutos()
    {
        $data = Produtos::get();
        
        


        return response()->json($data);
    }

// Retorna os dados de um produto, de acordo com o seu ID
    public function getProdutoById($id)
    {
    
        $data = Produtos::findOrFail($id);
        return response()->json($data);
    }

    //Envia um email automático.  Como ao se criar um array em Vue.js, este torna-se um Proxy
    //foi necessário torna-lo num array, de modo a poder ser acedido no template do email
    // Dentro do Vue.js o Proxy foi tornado num string (atraves de um Stringify) e aqui o mesmo
    // é tornado num array atraves do json_decode

    public function mailSend(Request $request) {

        $email = $request->email;

     $temp = $request->compras;
     $compras = json_decode($temp);



        $data = [
            'nome' =>  $request->nome,
            'transportadora' => $request->transportadora,
            'soma' => $request->soma,
             'compras'=>$compras
        ];

        Mail::to($email)->send(new ComprasMail($data));

   

       return response()->json([$request->all()]);  


    }
}
