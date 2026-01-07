<?php

class OrderController {

    public function index() {
        // Landing Page (Welcome)
        view('home');
    }

    public function menu() {
        $db = Database::getInstance();

        // Fetch Categories
        $categories = $db->query("SELECT * FROM categories ORDER BY id ASC")->resultSet();

        // Fetch Products
        // Grouping logic will happen in the View for simplicity in this One-Shot
        $products = $db->query("SELECT * FROM products ORDER BY is_popular DESC, name ASC")->resultSet();

        // Separate Popular items
        $popular = array_filter($products, fn($p) => $p->is_popular == 1);

        view('menu', [
            'categories' => $categories,
            'products' => $products,
            'popular' => $popular
        ]);
    }

    public function item() {
        if (!isset($_GET['id'])) {
            header('Location: /menu');
            exit;
        }

        $id = (int)$_GET['id'];
        $db = Database::getInstance();
        
        $product = $db->query("SELECT * FROM products WHERE id = :id")
                      ->bind(':id', $id)
                      ->single();

        if (!$product) {
            header('Location: /menu');
            exit;
        }

        view('product', ['product' => $product]);
    }

    public function checkout() {
        // Placeholder for checkout
        view('checkout');
    }
    
    public function process() {
        // Placeholder for POST handling
    }
}