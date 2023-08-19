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
        return Inertia::location('https://pay-sit.tradesafe.dev/checkout/eyJpdiI6ImJGYUpIV0p4ZXhkdTk3VGRZL2xyMFE9PSIsInZhbHVlIjoiT2pkQ3J0RGtvSnNFc3VkZnhLaWRmVms4b0hzUXdONm9FT3pDaTJkUFBEaGxiSisrMGZ4MHd4UVNFb3RNZTB3dEZMNVRQQ1RQQ2JaaGkvODBhbG1sOWc4Nm1USElDSVFkazB5eXZhZWp5ejI2RFNpdXcybGpNWGFqV1FJQ2lGWjVHbU5tYmJQRVRhSnRiVHZtd1laajJQRXZUMk5zaWV0NWdFQ0g0R01GSkdWbXdoK3k4MHZxOWRPM2ZoaWZ2bytiUnEzTWQ0Yk1YU0R0eEJWQU8ycysxbnBrTCsvQWNsOE1BaVc3dlRuWHJIWT0iLCJtYWMiOiI1YWRmZTMxMzM0YTM5ZDExYWM0Mzc2Y2EyOGFiYjFkZTc0MmFhN2JiNjM2ODA3MTE0YjJlODFiOTAyYjcyYzM2IiwidGFnIjoiIn0=');
    }
}
