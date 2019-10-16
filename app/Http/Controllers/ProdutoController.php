<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProdutoCollection;
use Illuminate\Support\Facades\Storage;
use App\Produto;
use App\Categoria;
use Excel;
use Session;
use Auth;

class ProdutoController extends Controller
{
    
    public function index()
    {   
        return new ProdutoCollection(Produto::orderBy('nome')->with('categorias')->paginate(10));
    }

    public function show($id){
        $data = [
            'produto' => Produto::findorFail($id),
            'url' => asset('/'),
            'categoria' => Produto::findOrFail($id)->categorias->nome
          ];
          return response()->json($data);
    }

    public function store(Request $request)
    {
        if($request->hasFile('imagem')){
            $produto = Produto::create([
                 'nome' => $request->nome,
                 'preco' => $request->preco,
                 'descricao' => $request->descricao,
                 'categoria_id' => $request->categoria_id,
                 'imagem' => $request->imagem->storeAs('images', date('Y-m-d H-i-s').'.jpg')
                ]);
             return response()->json('success');
        }else{
            return response()->json('error');
        }    
    }

    public function update($id, Request $request){
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());   
        return response()->json('sucesso');
    }
 
    public function delete($id){
        $produto = Produto::findOrFail($id);
        $produto->delete();
        return response()->json('sucesso');
    }

    public function categorias(){
        return response()->json(Categoria::all());
    }

    public function pesquisa($dado){
        if($dado) {
            return new ProdutoCollection(Produto::where('nome', 'like', '%'.$dado.'%')->with('categorias')->paginate(1));
          }else{
            return new ProdutoCollection(Produto::orderBy('nome')->with('categorias')->paginate(10)); 
        }
    }

    public function upload(Request $request){
        $data = $request->arquivo->storeAs('arquivo', date('Y-m-d H-i-s').'.csv');
        return response()->json('sucesso');
    }

}
