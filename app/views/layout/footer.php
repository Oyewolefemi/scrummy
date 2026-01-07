<?php if ($_SERVER['REQUEST_URI'] !== '/' && $_SERVER['REQUEST_URI'] !== '/index.php'): ?>
    <div class="fixed bottom-0 left-0 w-full p-4 bg-gradient-to-t from-background-light via-background-light to-transparent dark:from-background-dark dark:via-background-dark pointer-events-none z-50">
        <a href="/cart" class="pointer-events-auto w-full bg-primary hover:bg-orange-600 text-white h-14 rounded-xl shadow-lg shadow-primary/40 flex items-center justify-between px-6 transition-all transform active:scale-[0.98]">
            <div class="flex items-center gap-2">
                <div class="bg-white/20 size-8 rounded-full flex items-center justify-center font-bold text-sm">
                    <?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                </div>
                <span class="font-medium text-sm">items</span>
            </div>
            <span class="font-bold text-lg">View Cart</span>
        </a>
    </div>
    <?php endif; ?>

</body>
</html>