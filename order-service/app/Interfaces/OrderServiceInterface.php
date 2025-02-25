<?php

namespace App\Interfaces;

interface OrderServiceInterface
{
    public function createOrder($data, $token);
    public function getAllOrders();
    public function getOrderById($id);
    public function updateOrder($data, $id);
    public function deleteOrder($id);
}