<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class product extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name : Product Name} {reference : Product Ref} {price : Product Price} {delivery_days : Product Delivery Days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um produto na tabela Produtos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $reference = $this->argument('reference');
        $price = $this->argument('price');
        $delivery_days = $this->argument('delivery_days');

        $product = \App\Models\Product::create([
            'name' => $name,
            'reference' => $reference,
            'price' => $price,
            'delivery_days' => $delivery_days
        ]);

        if(!$product) {
            return $this->warn('Não foi possível adicionar o produto.');
        }
        return $this->warn('Produto adicionado com sucesso!');
    }
}
