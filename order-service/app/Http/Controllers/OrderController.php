<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Interfaces\OrderServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(CreateOrderRequest $request): JsonResponse
    {
        try {
            $token = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $token);
            $validatedRequest = $request->validated();

            $order = $this->orderService->createOrder($validatedRequest, $token);
            return response()->json([
                'message' => 'Orden enviada con exito',
                'orden' => $order
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocurrió un error inesperado', 
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function index(): JsonResponse
    {
        try {
            $order = $this->orderService->getAllOrders();
            return response()->json($order, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error inesperado', 'error' => $e->getMessage()], $e->getCode());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $order = $this->orderService->getOrderById($id);
            return response()->json($order, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado', 'error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $this->orderService->updateOrder($request, $id);
            return response()->json(['message' => 'Producto actualizado correctamente'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado', 'error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->orderService->deleteOrder($id);
            return response()->json(['message' => 'Producto eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado', 'error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
