<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Mail\ComprasMail;

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


        

        
        $email = "tneveda@hotmail.com";
        

        $data = [
            'name' =>  "tiago",
        ];

        Mail::to($email)->send(new ComprasMail($data));

        return response()->json($data);
    }


    public function getProdutoById($id)
    {
    
        $data = Produtos::findOrFail($id);
        return response()->json($data);
    }

    public function mailSend(Request $request) {
   

       return response()->json([$request->all()]);  

        $email = $request->email;
        

        $data = [
            'name' =>  $request->nome,
            'transportadora' => $request->transportadora
        ];

        Mail::to($email)->send(new ComprasMail($data));

       
   
      /*  return response()->json([
            'message' => 'Mail has sent.'
        ], Response::HTTP_OK);*/
    }
}
