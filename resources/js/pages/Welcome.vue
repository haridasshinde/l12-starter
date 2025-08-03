<template>
    <div
        class="flex min-h-screen items-center justify-center overflow-hidden bg-gradient-to-br from-white to-gray-100 px-4 py-12 dark:from-gray-900 dark:to-gray-800"
    >
        <div class="mx-auto grid w-full max-w-7xl items-center gap-16 lg:grid-cols-2">
            <!-- Left: Intro & Metrics -->
            <div class="animate-slide-fade space-y-8 text-center lg:text-left">
                <h1 class="text-4xl leading-tight font-bold text-gray-900 md:text-5xl dark:text-white">
                    Restaurant Control Panel - Manage Everything<br />
                    <span class="text-rose-600 dark:text-rose-400">From One Dashboard</span>
                </h1>
                <p class="mx-auto max-w-xl text-lg text-gray-600 lg:mx-0 dark:text-gray-300">
                    A powerful and scalable platform designed to streamline operations, enhance visibility, and support decision-making across your
                    restaurant chain — whether you're managing as an Admin, Store Manager.
                </p>
                <div class="flex justify-center gap-4 lg:justify-start">
                    <Link
                        :href="route('login')"
                        class="inline-flex items-center rounded-xl bg-rose-600 px-6 py-3 font-medium text-white transition duration-300 hover:bg-rose-700"
                    >
                        Login Now
                    </Link>
                </div>

                <!-- Metrics -->
                <div class="mt-12 grid grid-cols-1 gap-6 text-lg font-semibold text-rose-800 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Restaurants -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Building Storefront -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M3 9l1-5h16l1 5M4 10v10h16V10M9 21V12h6v9"
                                />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">12,000+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Restaurants use our platform</div>
                    </div>

                    <!-- Countries -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Globe -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9z"
                                />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.05 12h19.9M12 2.05v19.9" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">50+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Countries with active clients</div>
                    </div>

                    <!-- Trusted Brands -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Shield Check -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M12 3l8 4v5c0 5.25-3.67 9.74-8 11-4.33-1.26-8-5.75-8-11V7l8-4z"
                                />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">12,000+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Trusted by global brands worldwide</div>
                    </div>

                    <!-- Support -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Clock -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6l4 2" />
                                <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5" fill="none" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">24x7</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Support across all timezones</div>
                    </div>

                    <!-- Orders -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Receipt -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M9 3v1m6-1v1M4 7h16M5 7v14a2 2 0 002 2h10a2 2 0 002-2V7m-3 4h-6m0 4h6"
                                />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">1M+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Orders processed daily</div>
                    </div>

                    <!-- Uptime -->
                    <div class="space-y-2 text-center transition-transform hover:scale-105">
                        <div class="flex justify-center text-rose-600 dark:text-rose-400">
                            <!-- Heroicon: Signal -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.5"
                                    d="M4 16h.01M8 12h.01M12 8h.01M16 4h.01M20 2h.01"
                                />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">99.99%</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">System uptime</div>
                    </div>
                </div>
            </div>

            <!-- Right: Preview + Snapshot -->
            <div class="animate-float flex w-full flex-col items-center gap-8">
                <img
                    src="/images/backoffice-preview.png"
                    alt="Restaurant Dashboard Preview"
                    class="animate-slide-up w-full max-w-md rounded-3xl shadow-2xl ring-1 ring-rose-200 transition-transform duration-700 hover:scale-105 dark:ring-rose-700/40"
                />

                <!-- Animated Snapshot -->
                <div class="animate-slide-up w-full max-w-md rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
                    <h2 class="mb-4 text-xl font-bold text-rose-600 dark:text-rose-400">📊 Live Performance Snapshot</h2>
                    <div class="grid grid-cols-1 gap-6 text-center sm:grid-cols-3">
                        <div>
                            <div class="flex h-24 w-full items-end justify-center gap-1">
                                <div class="animate-bar1 w-3 rounded-t-lg bg-rose-500"></div>
                                <div class="animate-bar2 w-3 rounded-t-lg bg-rose-400"></div>
                                <div class="animate-bar3 w-3 rounded-t-lg bg-rose-300"></div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Order Volume</p>
                        </div>
                        <div>
                            <div class="flex h-24 w-full items-end justify-center gap-1">
                                <div class="animate-bar2 w-3 rounded-t-lg bg-yellow-500"></div>
                                <div class="animate-bar1 w-3 rounded-t-lg bg-yellow-400"></div>
                                <div class="animate-bar3 w-3 rounded-t-lg bg-yellow-300"></div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Kitchen Load</p>
                        </div>
                        <div>
                            <div class="flex h-24 w-full items-end justify-center gap-1">
                                <div class="animate-bar3 w-3 rounded-t-lg bg-green-500"></div>
                                <div class="animate-bar2 w-3 rounded-t-lg bg-green-400"></div>
                                <div class="animate-bar1 w-3 rounded-t-lg bg-green-300"></div>
                            </div>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Customer Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
</script>

<style scoped>
@keyframes slideFade {
    from {
        opacity: 0;
        transform: translateY(40px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-fade {
    animation: slideFade 1s ease-out;
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-6px);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(80px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-slide-up {
    animation: slideUp 1.2s ease-out;
}

/* Bar graph animations */
@keyframes bar1 {
    0%,
    100% {
        height: 40%;
    }

    50% {
        height: 80%;
    }
}

@keyframes bar2 {
    0%,
    100% {
        height: 60%;
    }

    50% {
        height: 90%;
    }
}

@keyframes bar3 {
    0%,
    100% {
        height: 80%;
    }

    50% {
        height: 50%;
    }
}

.animate-bar1 {
    animation: bar1 2s infinite ease-in-out;
}

.animate-bar2 {
    animation: bar2 2s infinite ease-in-out;
}

.animate-bar3 {
    animation: bar3 2s infinite ease-in-out;
}
</style>
