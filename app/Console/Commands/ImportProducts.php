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
    // protected $signature = 'products:import {--id= : ID do produto a ser importado}';
    protected $signature = 'products:import {--id= : ID do produto a ser importado} {--offline : Usar dados locais ao invés da API}';

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
        $offline = $this->option('offline');

        if ($id) {
            $this->importProductById($id, $offline);
        } else {
            $this->importAllProducts($offline);
        }

        $this->info('Importação concluída.');
    }


    protected function importAllProducts($offline = false)
    {
        if ($offline) {
            $jsonPath = storage_path('app/fake_store.json');
            if (!file_exists($jsonPath)) {
                return $this->error("Arquivo fake_store.json não encontrado.");
            }

            $items = json_decode(file_get_contents($jsonPath), true);

            foreach ($items as $item) {
                $this->saveProduct($item);
            }

            return $this->info('Produtos importados a partir do arquivo local.');
        }

        $response = Http::get('https://fakestoreapi.com/products');

        if ($response->successful()) {
            foreach ($response->json() as $item) {
                $this->saveProduct($item);
            }

            $this->info('Todos os produtos foram importados da API.');
        } else {
            $this->error('Erro ao buscar os produtos da API.');
        }
    }

    protected function importProductById($id, $offline = false)
    {
        if ($offline) {
            $jsonPath = storage_path('app/fake_store.json');
            if (!file_exists($jsonPath)) {
                return $this->error("Arquivo fake_store.json não encontrado.");
            }

            $items = json_decode(file_get_contents($jsonPath), true);
            $product = collect($items)->firstWhere('id', $id);

            if ($product) {
                $this->saveProduct($product);
                return $this->info("Produto com ID {$id} importado do arquivo local.");
            } else {
                return $this->error("Produto com ID {$id} não encontrado no arquivo local.");
            }
        }

        $response = Http::get("https://fakestoreapi.com/products/{$id}");

        if ($response->successful()) {
            $this->saveProduct($response->json());
            $this->info("Produto com ID {$id} importado da API.");
        } else {
            $this->error("Produto com ID {$id} não encontrado na API.");
        }
    }

    protected function saveProduct($data)
    {
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
