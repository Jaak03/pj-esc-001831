<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function success(Request $request)
    {
        return Inertia::render('Product/Order', [
            // TODO Jaak - Get product from DB
            'product' => [
                'id' => 1,
                'name' => 'Product 1',
                'price' => 100,
            ],
            'payment' => [
                'transactionId' => $request->transactionId,
                'success' => $request->success,
            ],
        ]);
    }
}
