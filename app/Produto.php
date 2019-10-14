<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Produto extends Model
{
    Use SoftDeletes;
    protected $table = 'produtos';
    protected $fillable = ['nome','descricao','imagem','categoria_id','preco'];

    public function categorias(){
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }
}
