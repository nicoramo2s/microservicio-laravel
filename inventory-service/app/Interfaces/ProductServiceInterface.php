<?php

namespace App\Interfaces;

interface ProductServiceInterface
{
    public function createProduct($data);
    public function getAllProducts();
    public function getProductById($id);
    public function updateProduct($data, $id);
    public function deleteProduct($id);
    public function searchProduct(string $name);
}