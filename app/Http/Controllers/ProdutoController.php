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
        $teste = Produtos::get();

        $email = "tneveda@hotmail.com";
        

        $data = [
            'nome' =>  "tiago",
        ];

    //  Mail::to($email)->send(new ComprasMail($data));

        return response()->json($teste);
    }


    public function getProdutoById($id)
    {
    
        $data = Produtos::findOrFail($id);
        return response()->json($data);
    }

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
