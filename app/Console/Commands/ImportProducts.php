<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import {--id= : ID do produto a ser importado}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa produtos da Fake Store API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->option('id');

        if ($id) {
            $this->importProductById($id);
        } else {
            $this->importAllProducts();
        }

        $this->info('Importação concluída.');
    }


    protected function importAllProducts()
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if ($response->successful()) {
            foreach ($response->json() as $item) {
                $this->saveProduct($item);
            }

            $this->info('Todos os produtos foram importados.');
        } else {
            $this->error('Erro ao buscar os produtos.');
        }
    }


    protected function importProductById($id)
    {
        $response = Http::get("https://fakestoreapi.com/products/{$id}");

        if ($response->successful()) {
            $this->saveProduct($response->json());
            $this->info("Produto com ID {$id} importado.");
        } else {
            $this->error("Produto com ID {$id} não encontrado.");
        }
    }

    protected function saveProduct($data)
    {//TODO: VERIFICAR SE O PRODUTO J  EXISTE
        Product::updateOrCreate(
            [
                'name' => $data['title'],
                'description' => $data['description'],
                'price' => $data['price'],
                'category' => $data['category'],
                'image_url' => $data['image'],
                'created_at' => now(),
               // 'updated_at' => now(),
            ]
        );
    }
}
