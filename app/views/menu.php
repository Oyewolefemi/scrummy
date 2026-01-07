<?php require_once '../app/views/layout/header.php'; ?>

<div class="sticky top-0 z-50 bg-background-light dark:bg-background-dark/95 backdrop-blur-sm border-b border-stone-200 dark:border-stone-800 transition-colors duration-200">
    <div class="flex items-center p-4 pb-2 justify-between">
        <a href="/" class="flex size-10 shrink-0 items-center justify-center rounded-full hover:bg-stone-200 dark:hover:bg-stone-800 transition-colors text-stone-900 dark:text-white">
            <span class="material-symbols-outlined text-2xl">arrow_back</span>
        </a>
        <h2 class="text-stone-900 dark:text-white text-lg font-bold leading-tight tracking-[-0.015em] flex-1 text-center">Scrummy Nummy</h2>
        <div class="flex w-10 items-center justify-end"></div>
    </div>
</div>

<div class="flex flex-col w-full pb-24 overflow-x-hidden">
    
    <div class="px-4 py-2 space-y-4">
        <h1 class="text-stone-900 dark:text-white tracking-tight text-[28px] font-bold leading-tight text-left pt-2">
            What are you craving?
        </h1>
    </div>

    <div class="sticky top-[60px] z-40 bg-background-light dark:bg-background-dark py-3 pl-4 border-b border-stone-100 dark:border-stone-800/50 shadow-sm">
        <div class="flex gap-3 overflow-x-auto no-scrollbar pr-4">
            <a href="#popular" class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary text-white px-4 shadow-md shadow-primary/20 transition-transform active:scale-95">
                <span class="material-symbols-outlined text-[18px]">local_fire_department</span>
                <span class="text-sm font-bold">Popular</span>
            </a>
            <?php foreach($categories as $cat): ?>
            <a href="#cat-<?= $cat->id ?>" class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-neutral-light dark:bg-neutral-dark text-stone-600 dark:text-stone-300 px-4 hover:bg-stone-200 dark:hover:bg-stone-700 transition-colors active:scale-95">
                <span class="text-sm font-medium"><?= e($cat->name) ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if(!empty($popular)): ?>
    <div id="popular" class="mt-4 px-4 scroll-mt-32">
        <div class="flex justify-between items-center mb-3">
            <h3 class="text-lg font-bold text-stone-900 dark:text-white">Popular Now</h3>
        </div>
        <div class="flex gap-4 overflow-x-auto no-scrollbar pb-4 -mx-4 px-4 snap-x">
            <?php foreach($popular as $popItem): ?>
            <div class="snap-center shrink-0 w-[240px] bg-surface-light dark:bg-surface-dark rounded-xl overflow-hidden shadow-sm border border-stone-100 dark:border-stone-800 flex flex-col">
                <div class="h-32 w-full bg-stone-200 relative">
                    <img src="<?= e($popItem->image_url ?? '/assets/images/placeholder.jpg') ?>" class="h-full w-full object-cover" />
                    <div class="absolute top-2 left-2 bg-white/90 dark:bg-black/80 backdrop-blur text-xs font-bold px-2 py-1 rounded-md text-stone-900 dark:text-white shadow-sm flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px] text-primary">star</span> <?= $popItem->rating ?>
                    </div>
                </div>
                <div class="p-3 flex flex-col flex-1">
                    <h4 class="font-bold text-stone-900 dark:text-white truncate"><?= e($popItem->name) ?></h4>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="font-bold text-lg text-primary">₦<?= number_format($popItem->price) ?></span>
                        <a href="/item?id=<?= $popItem->id ?>" class="size-8 rounded-full bg-primary text-white flex items-center justify-center shadow-md shadow-primary/30 active:scale-90 transition-transform">
                            <span class="material-symbols-outlined text-[18px]">add</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php foreach($categories as $cat): ?>
    <div id="cat-<?= $cat->id ?>" class="mt-2 px-4 scroll-mt-32">
        <h3 class="text-lg font-bold text-stone-900 dark:text-white mb-4"><?= e($cat->name) ?></h3>
        <div class="space-y-4">
            <?php 
            // Filter products for this category
            $catProducts = array_filter($products, fn($p) => $p->category_id == $cat->id);
            foreach($catProducts as $prod): 
            ?>
            <a href="/item?id=<?= $prod->id ?>" class="flex gap-4 bg-surface-light dark:bg-surface-dark p-3 rounded-xl shadow-sm border border-stone-100 dark:border-stone-800 hover:border-primary/30 transition-colors cursor-pointer group">
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-bold text-stone-900 dark:text-white group-hover:text-primary transition-colors"><?= e($prod->name) ?></h4>
                            <?php if($prod->is_spicy): ?>
                            <span class="text-red-500 material-symbols-outlined text-[16px]">whatshot</span>
                            <?php endif; ?>
                        </div>
                        <p class="text-sm text-stone-500 dark:text-stone-400 mt-1 line-clamp-2 leading-relaxed"><?= e($prod->description) ?></p>
                    </div>
                    <div class="mt-3 font-bold text-primary text-lg">₦<?= number_format($prod->price) ?></div>
                </div>
                <div class="relative w-28 h-28 shrink-0">
                    <img src="<?= e($prod->image_url ?? '/assets/images/placeholder.jpg') ?>" class="w-full h-full object-cover rounded-lg" />
                    <button class="absolute -bottom-2 -right-2 size-9 bg-white dark:bg-stone-700 text-stone-900 dark:text-white rounded-full shadow-md flex items-center justify-center border border-stone-100 dark:border-stone-600 active:bg-primary active:text-white active:border-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                    </button>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>

</div>

<?php require_once '../app/views/layout/footer.php'; ?>