<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $product = $this->productService->createProduct($validatedData);
            return response()->json($product, Response::HTTP_CREATED);
        } catch (\Exception $e) {

            return response()->json(['message' => 'Ocurrió un error inesperado', 'error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index(): JsonResponse
    {
        $products = $this->productService->getAllProducts();
        return response()->json($products, Response::HTTP_OK);
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->productService->getProductById($id);
            return response()->json($product, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $this->productService->updateProduct($validatedData, $id);
            return response()->json(['message' => 'Producto actualizado correctamente'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);
            return response()->json(['message' => 'Producto eliminado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Producto no encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    public function search(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $products = $this->productService->searchProduct($name);
        return response()->json($products, Response::HTTP_OK);
    }
}
