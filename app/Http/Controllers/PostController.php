<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PostColletion;
use App\Post;

class PostController extends Controller
{

    public function index(){
        return new PostColletion(Post::all());
    }

    public function store(Request $request){
        $post = Post::create($request->all());
        return response()->json('success');
   }

   public function edit($id){
       $post = Post::find($id);
       return response()->json($post);
   }

   public function update($id, Request $request){
       $post = Post::find($id);
       $post->update($request->all());
       return response()->json('Post atualizado com sucesso');
   }

   public function delete($id){
       $post = Post::find($id);
       $post->delete();
       return response()->json('Post deletado com sucesso');
   }

}
