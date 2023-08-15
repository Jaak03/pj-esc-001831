<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function order(): Response
    {
        return Inertia::render('Product/Order', [
            // TODO Jaak - Get product from DB
            'product' => [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 100,
            ],
        ]);
    }
}
