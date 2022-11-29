<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;

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
}
