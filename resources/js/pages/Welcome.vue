<template>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-white to-gray-100 dark:from-gray-900 dark:to-gray-800 px-6 py-12 overflow-hidden">
        <div class="max-w-7xl w-full flex flex-col-reverse lg:flex-row items-center gap-16">

            <!-- Left Content -->
            <div class="w-full lg:w-1/2 space-y-8 text-center lg:text-left animate-slide-fade">
                <span
                    class="inline-block px-3 py-1 text-sm font-semibold text-rose-800 bg-rose-100 rounded-full shadow-sm dark:text-rose-300 dark:bg-rose-900/30">
                    Restaurant Control Panel
                </span>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white leading-tight">
                    Manage Everything<br />
                    <span class="text-rose-600 dark:text-rose-400">From One Dashboard</span>
                </h1>

                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-xl mx-auto lg:mx-0">
                    Centralized system to handle menus, orders, tables, inventory, and staff. Track performance and make
                    informed decisions — anytime, anywhere.
                </p>

                <Link :href="route('login')"
                    class="inline-flex items-center gap-2 bg-rose-600 hover:bg-rose-700 focus:ring-4 focus:ring-rose-300 text-white px-6 py-3 rounded-xl text-base font-semibold shadow-lg transition-all duration-300 ease-in-out hover:scale-105 focus:outline-none">
                Login to Admin Panel
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                </Link>

                <!-- Key Metrics -->
                <div class="grid grid-cols-3 gap-6 mt-12 text-rose-800 font-semibold text-lg">
                    <div class="hover:scale-105 transition-transform">
                        <div class="text-2xl font-bold">3,200+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Orders Today</div>
                    </div>
                    <div class="hover:scale-105 transition-transform">
                        <div class="text-2xl font-bold">1,500</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Menu Items</div>
                    </div>
                    <div class="hover:scale-105 transition-transform">
                        <div class="text-2xl font-bold">120</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Branches</div>
                    </div>
                </div>
            </div>

            <!-- Right Illustration -->
            <div class="w-full lg:w-1/2 flex justify-center items-center animate-float">
                <img src="/images/backoffice-preview.png" alt="Restaurant Dashboard Preview"
                    class="w-full max-w-md rounded-3xl shadow-2xl ring-1 ring-rose-200 dark:ring-rose-700/40 transition-transform duration-700 hover:scale-105" />
            </div>
        </div>

        <!-- Footer -->
        <footer
            class="hidden sm:block absolute bottom-4 left-0 right-0 text-center text-sm text-gray-400 dark:text-gray-500">
            © 2025 TMBill Technologies — Restaurant Backoffice Platform
        </footer>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<style scoped>
@keyframes slide-fade {
    from {
        transform: translateY(30px);
        opacity: 0;
    }

    to {
        transform: translateY(0px);
        opacity: 1;
    }
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-6px);
    }
}

.animate-slide-fade {
    animation: slide-fade 0.8s ease-out both;
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>
