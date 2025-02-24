<?php
namespace App\Services;

use App\Models\Product;
use App\Interfaces\ProductServiceInterface;



class ProductService implements ProductServiceInterface
{
    public function createProduct($data): Product
    {
        return Product::create($data);
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function updateProduct($data, $id)
    {
        $product = Product::find($id);
        return $product->update($data);
    }

    public function deleteProduct($id): bool
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function searchProduct(string $name)
    {
        return Product::where('name', 'like', "%$name%")->get();
    }
}
