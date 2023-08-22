<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CallbackController extends Controller
{
    public function success(Request $request): Response
    {
        // https://example.net/success?status=success&method=wallet&transactionId=3XhRne2PpyfBDsXy9wv8Si&reference=null
        return Inertia::render('Callback/Success', [
            'status' => $request->query('status'),
            'method' => $request->query('method'),
            'transactionId' => $request->query('transactionId'),
            'reference' => $request->query('reference'),
        ]);
    }

    public function failed(Request $request): Response
    {
        return Inertia::render('Callback/Failed', [
            'status' => $request->query('status'),
            'method' => $request->query('method'),
            'transactionId' => $request->query('transactionId'),
            'reference' => $request->query('reference'),
        ]);
    }
}
