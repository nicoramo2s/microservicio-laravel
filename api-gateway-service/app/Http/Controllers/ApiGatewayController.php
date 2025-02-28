<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ApiGatewayController extends Controller
{
    public function handleRequest(Request $request, $service, $path = null)
    {
        // Mapeo de servicios a URLs
        $services = [
            'auth' => env('AUTH_SERVICE_URL'),
            'products' => env('INVENTORY_SERVICE_URL'),
            'orders' => env('ORDERS_SERVICE_URL'),
        ];

        // Verificar si el servicio existe
        if (!array_key_exists($service, $services)) {
            return response()->json(['error' => 'Service not found'], Response::HTTP_NOT_FOUND);
        }

        // Construir la URL de destino
        $targetUrl = $services[$service];
        if ($path) {
            $targetUrl .= "/{$path}";
        }
        
        // Obtener todos los parámetros de la petición
        $parameters = $request->all();

        // Obtener headers que quieras pasar
        $relevantHeaders = [];

        // Filtrar solo los headers relevantes
        foreach (['Authorization', 'Accept', 'Content-Type'] as $header) {
            if ($request->header($header)) {
                $relevantHeaders[$header] = $request->header($header);
            }
        }
        try {
            // Hacer la petición al servicio correspondiente
            $method = strtolower($request->method());
            $response = Http::withHeaders($relevantHeaders);

            // Ejecutar el método HTTP correspondiente
            if ($method === 'get') {
                $response = $response->get($targetUrl, $parameters);
            } elseif ($method === 'post') {
                $response = $response->post($targetUrl, $parameters);
            } elseif ($method === 'put') {
                $response = $response->put($targetUrl, $parameters);
            } elseif ($method === 'patch') {
                $response = $response->patch($targetUrl, $parameters);
            } elseif ($method === 'delete') {
                $response = $response->delete($targetUrl, $parameters);
            }

            // Devolver la respuesta del servicio
            return response()->json(
                $response->json(),
                $response->status()
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Service unavailable',
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
