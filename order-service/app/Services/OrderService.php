<?php

namespace App\Services;

use App\Interfaces\OrderServiceInterface;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class OrderService implements OrderServiceInterface
{
    public function createOrder($data, $token)
    {
        $updateProduct = [];
        //Consulta al servicio de inventario para verificar si el producto existe
        foreach ($data['items'] as $item) {
            $inventoryResponse = Http::withToken($token)->timeout(10)->get(env('INVENTORY_SERVICE_URL') . '/products/' . $item['product_id']);
            if (!$inventoryResponse->json() || $inventoryResponse->status() !== Response::HTTP_OK) {
                throw new \Exception($inventoryResponse->json()['message'], $inventoryResponse->status());
            }
            $product = $inventoryResponse->json();
            //Verificar si la cantidad de productos solicitados esta disponible
            if ($product['quantity'] < $item['quantity']) {
                throw new \Exception('Product quantity not available', Response::HTTP_NOT_FOUND);
            }

            $updateProduct[] = [
                'product_id' => $item['product_id'],
                'new_quantity' => $product['quantity'] - $item['quantity']
            ];
        }
        // Actualizar la cantidad de productos en el inventario
        foreach ($updateProduct as $productUpdate) {
            $updatedResponse = Http::withToken($token)->timeout(10)->put(env('INVENTORY_SERVICE_URL') . '/products/' . $productUpdate['product_id'], [
                'quantity' => $productUpdate['new_quantity']
            ]);

            if ($updatedResponse->failed() || $updatedResponse->status() !== Response::HTTP_OK) {
                throw new \Exception($updatedResponse->json()['message'], $updatedResponse->status());
            }
        }

        $order = [
            'customer_name' => $data['customer_name'],
            'items' => $data['items'],
            'total_price' => $data['total_price'],
            'status' => $data['status'],
            'created_at' => now('America/Argentina/Buenos_Aires')->format('H:i d-m-Y'),
            'updated_at' => now('America/Argentina/Buenos_Aires')->format('H:i d-m-Y'),
        ];
        //Enviar correo 
        $emailResponse = Http::withToken($token)->timeout(20)->post(env('MAIL_SERVICE_URL') . '/email', [
            "fromAddress" => env('MAIL_FROM_ADDRESS'),
            "toAddress" => "kogob87332@jarars.com",
            "subject" => "Confirmacion de Nuevo Pedido # " . rand(1000, 9999),
            "contentBody" => "Se ha creado un nuevo pedido, gracias por su compra.",
            "order" => $order
        ])->throw();

        if ($emailResponse->failed() || $emailResponse->status() !== Response::HTTP_OK) {
            throw new \Exception($emailResponse->json()['message'], $emailResponse->status());
        }
        return Order::create($order);
    }

    public function getAllOrders()
    {
        $orders = Order::all();
        if ($orders->isEmpty()) {
            throw new \Exception('No orders found', Response::HTTP_NOT_FOUND);
        }
        return $orders;
    }
    
    public function getOrderById($id)
    {
        return Order::findOrFail($id);
    }

    public function updateOrder($data, $id)
    {
        $order = Order::findOrFail($id);
        return $order->update($data);
    }

    public function deleteOrder($id): bool
    {
        $order = Order::findOrFail($id);
        return $order->delete();
    }
}
