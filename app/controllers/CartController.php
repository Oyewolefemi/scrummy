<?php

class CartController {
    
    public function index() {
        // View Cart
        $cart = Session::get('cart') ?? [];
        $total = 0;
        
        // Calculate total
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        view('cart', ['cartItems' => $cart, 'total' => $total]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            $notes = $_POST['notes'] ?? '';

            // Fetch product details to store name/price in session
            // (Avoids querying DB on every cart view)
            $db = Database::getInstance();
            $product = $db->query("SELECT * FROM products WHERE id = :id")->bind(':id', $productId)->single();

            if ($product) {
                $cart = Session::get('cart') ?? [];
                
                // Use a unique key for product + notes combination or just product ID
                // Simple version: Key is Product ID (merging duplicates)
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantity;
                    // Overwrite notes if new ones provided, or append? Let's keep simple.
                    if(!empty($notes)) $cart[$productId]['notes'] = $notes;
                } else {
                    $cart[$productId] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->image_url,
                        'quantity' => $quantity,
                        'notes' => $notes
                    ];
                }

                Session::set('cart', $cart);
            }
        }

        header('Location: /menu'); // Redirect back to menu or cart
        exit;
    }

    public function remove() {
        // Logic to remove item
    }
}