<?php

function view($view, $data = []) {
    // Extract array keys as variables (e.g., ['products' => $p] becomes $products)
    extract($data);

    $viewFile = "../app/views/{$view}.php";

    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        die("View does not exist: " . $viewFile);
    }
}

function asset($path) {
    // Simple helper for public assets
    return "/assets/" . ltrim($path, '/');
}

// Escaping helper for security
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}