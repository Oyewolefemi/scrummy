<?php require_once '../app/views/layout/header.php'; ?>

<div class="relative flex h-screen w-full flex-col overflow-hidden bg-background-light dark:bg-background-dark">
    <div class="relative h-[55%] w-full flex-shrink-0">
        <div class="absolute inset-0 h-full w-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=2069&auto=format&fit=crop');"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-transparent to-black/10"></div>
        
        <div class="absolute top-0 left-0 right-0 pt-14 flex justify-center z-10">
            <div class="bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md p-3 rounded-full shadow-lg">
                <span class="material-symbols-outlined text-primary text-[32px] leading-none">restaurant_menu</span>
            </div>
        </div>
    </div>

    <div class="relative -mt-10 flex flex-1 flex-col rounded-t-3xl bg-background-light dark:bg-background-dark px-6 shadow-[0_-8px_30px_rgba(0,0,0,0.08)] z-10">
        <div class="mx-auto mt-3 h-1.5 w-12 rounded-full bg-gray-200 dark:bg-gray-700"></div>
        
        <div class="flex flex-1 flex-col justify-between pb-safe pt-6">
            <div class="flex flex-col items-center text-center space-y-3">
                <h1 class="text-3xl font-bold tracking-tight text-[#1b130d] dark:text-white leading-tight">
                    Taste the best <br/><span class="text-primary">food in Abeokuta</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400 text-base font-medium max-w-[280px] leading-relaxed">
                    Order your favorite meals from Scrummy Nummy.
                </p>
            </div>

            <div class="w-full flex flex-col gap-3 mt-4 mb-8">
                <a href="/menu" class="group relative flex w-full cursor-pointer items-center justify-center overflow-hidden rounded-xl h-14 bg-primary text-white text-[17px] font-bold leading-normal tracking-[0.015em] transition-transform active:scale-[0.98] shadow-lg shadow-primary/20 hover:bg-orange-600">
                    <span class="truncate">Order Now</span>
                </a>
                
                <a href="/admin/login" class="flex items-center justify-center gap-1 py-2 px-4 rounded-lg bg-transparent text-gray-500 dark:text-gray-400 hover:text-primary transition-colors text-sm font-semibold tracking-wide">
                    <span>Manager Login</span>
                    <span class="material-symbols-outlined text-[18px]">lock</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layout/footer.php'; ?>