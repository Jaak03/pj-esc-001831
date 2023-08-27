<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * @param Request $order
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function checkout(Request $order)
    {
        return Inertia::location('https://pay-sit.tradesafe.dev/checkout/eyJpdiI6IldLWThzYm9rVldibGs0aTYzMldJRVE9PSIsInZhbHVlIjoiM0ZHKy9yR2FiZVhxWDdyMVVkSWYwbnNZNitkaHdQR0VlRkVVVnNncnE3NkhVSXFtY0VhUXlHRnplOEhvVjZRZXA1Ym9LN1hXcHJOcmJqeVNZU0g3dDlzQVhkcXdjSVpJbEYxSW8vd2FDOFFWbEZvdEFUako0QlZDSFRzNlBaekJjTWRLMXFRaExrRXBpU0hBOUJmcDBwVkhzM3JSbnRQVHoycEVLaVhhcE5kcEMySkl3eGtIclEzNkVMR2RXKzRHdFRzZitUMFN0TFlLM1dVdzRvSkk4YkZxYlgyUEpHb3d0SGZwRmZ0b1hXWXZPL2d4V2twT3laZFJ1dzd6SEtNRCIsIm1hYyI6IjgzZjE2ZjQ5NWJhN2YwMmQzNjk1NjZiZTMwNGJjZGM1ZDE5ZTRjYTQzYzgyODhjOTY1MWQ4MzUxYjY2N2YwMzkiLCJ0YWciOiIifQ==');
    }
}
