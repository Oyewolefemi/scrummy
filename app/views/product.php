<?php require_once '../app/views/layout/header.php'; ?>

<div class="relative w-full h-[320px] shrink-0">
    <div class="absolute inset-0 bg-gray-200">
        <img src="<?= e($product->image_url ?? '/assets/images/placeholder.jpg') ?>" class="h-full w-full object-cover" />
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
    
    <div class="absolute top-0 left-0 right-0 p-4 pt-12 flex justify-between items-center z-10">
        <a href="/menu" class="flex items-center justify-center w-10 h-10 rounded-full bg-white/20 backdrop-blur-md border border-white/20 text-white hover:bg-white/30 transition-colors">
            <span class="material-symbols-outlined text-[20px]">arrow_back_ios_new</span>
        </a>
    </div>
</div>

<form action="/cart/add" method="POST" class="relative -mt-6 rounded-t-3xl bg-background-light dark:bg-background-dark z-10 px-5 pt-8 flex flex-col gap-6 pb-32">
    <input type="hidden" name="product_id" value="<?= $product->id ?>">
    
    <div class="flex flex-col gap-2">
        <div class="flex justify-between items-start gap-4">
            <h1 class="text-3xl font-bold leading-tight text-text-main dark:text-white"><?= e($product->name) ?></h1>
            <span class="text-2xl font-bold text-primary whitespace-nowrap">₦<?= number_format($product->price) ?></span>
        </div>
        <div class="flex items-center gap-2 text-sm text-[#9a6c4c] dark:text-gray-400">
            <?php if($product->rating): ?>
            <div class="flex items-center text-primary">
                <span class="material-symbols-outlined text-[18px] fill-current">star</span>
                <span class="ml-1 font-semibold"><?= $product->rating ?></span>
            </div>
            <span>•</span>
            <?php endif; ?>
            <span><?= e($product->prep_time ?? '20-30') ?> min</span>
            <?php if($product->is_spicy): ?>
            <span>•</span>
            <span class="text-red-500 font-medium">Spicy</span>
            <?php endif; ?>
        </div>
    </div>

    <div>
        <p class="text-base font-normal leading-relaxed text-[#1b130d]/80 dark:text-gray-300">
            <?= e($product->description) ?>
        </p>
    </div>

    <div class="h-px w-full bg-[#e7d9cf] dark:bg-[#3d2b1f]"></div>

    <div class="flex flex-col gap-4 pt-2">
        <h2 class="text-lg font-bold text-text-main dark:text-white">Special Instructions</h2>
        <textarea name="notes" class="w-full rounded-xl border-[#e7d9cf] dark:border-[#3d2b1f] bg-gray-50 dark:bg-[#2c2016] p-4 text-base text-text-main dark:text-white placeholder:text-gray-400 focus:border-primary focus:ring-1 focus:ring-primary min-h-[100px] resize-none" placeholder="E.g. No onions, sauce on the side..."></textarea>
    </div>

    <div class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-[#2d231b] border-t border-gray-100 dark:border-gray-800 shadow-[0_-4px_20px_rgba(0,0,0,0.05)] px-4 pt-4 pb-8">
        <div class="mx-auto flex w-full max-w-md gap-4 items-center">
            <div class="flex items-center gap-3 bg-background-light dark:bg-background-dark rounded-lg p-1 border border-[#e7d9cf] dark:border-[#3d2b1f]">
                <button type="button" onclick="decrement()" class="w-10 h-10 flex items-center justify-center rounded-md text-text-main dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">remove</span>
                </button>
                <input type="number" name="quantity" id="qty" value="1" readonly class="text-lg font-bold w-8 text-center bg-transparent border-none focus:ring-0 text-text-main dark:text-white p-0">
                <button type="button" onclick="increment()" class="w-10 h-10 flex items-center justify-center rounded-md text-text-main dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                    <span class="material-symbols-outlined text-lg">add</span>
                </button>
            </div>
            
            <button type="submit" class="flex-1 bg-primary hover:bg-orange-600 active:scale-[0.98] transition-all text-white h-12 rounded-lg font-bold text-base uppercase tracking-wide flex items-center justify-center shadow-lg shadow-orange-500/20">
                Add to Order
            </button>
        </div>
    </div>
</form>

<script>
    function increment() {
        const el = document.getElementById('qty');
        el.value = parseInt(el.value) + 1;
    }
    function decrement() {
        const el = document.getElementById('qty');
        if (parseInt(el.value) > 1) el.value = parseInt(el.value) - 1;
    }
</script>

<?php require_once '../app/views/layout/footer.php'; ?>