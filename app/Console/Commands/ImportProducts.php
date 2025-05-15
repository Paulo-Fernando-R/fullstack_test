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

    /**
     * Importa todos os produtos da Fake Store API.
     *
     * Busca todos os produtos na API e os salva no banco de dados.
     *
     * @return void
     */
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

    /**
     * Importa um produto da Fake Store API pelo seu ID.
     *
     * Faz uma requisi o GET para a API e salva o produto no banco de dados.
     *
     * @param int $id O ID do produto que ser  importado.
     *
     * @return void
     */
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

    /**
     * Salva um produto no banco de dados.
     *
     * Recebe um array com os dados do produto e o salva no banco de dados.
     * Se o produto j  existir, ele   atualizado.
     *
     * @param array $data Os dados do produto que ser o salvos.
     *
     * @return void
     */
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
                'updated_at' => now(),
            ]
        );
    }
}
