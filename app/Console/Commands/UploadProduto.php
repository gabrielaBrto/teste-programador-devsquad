<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mail;  
use App\{Produto, User};
use Excel;
use Illuminate\Database\QueryException;

class UploadProduto extends Command
{
    protected $signature = 'upload:produto';

    protected $description = 'Upload de arquivos';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {   
        $files = scandir(Storage::path('/arquivo'));
        foreach($files as $i => $file){
            if($i > 1){
                $rows = Excel::load(Storage::path('arquivo\\').$file, function($reader){});
                    $produtosTotal = 0;
                    foreach($rows->get() as $row){
                    try{
                        $produto = 
                        Produto::create([
                            'nome' => $row->nome,
                            'descricao' => $row->descricao,
                            'imagem' => $row->imagem,
                            'categoria_id' => $row->categoria_id,
                            'preco' => $row->preco
                        ]);
                        $produtosTotal++;
                        Storage::move('arquivo/'.$file, 'importados/'.$file);
                    }catch(QueryException $err){} 
                    }
            }
        }

        $data['title'] = 'Resultado upload de produtos';
        $data['total'] = $produtosTotal;
        Mail::send('emails.email',$data, function($message){
            $message->to(User::find(1)->email, 'CRUD Produtos')  
            ->subject('Upload Produtos');
        });
    }
}
