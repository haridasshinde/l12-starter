<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const name = page.props.name;

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <!-- Left Panel - Light color scheme with soft gradients -->
        <div
            class="relative hidden h-full flex-col overflow-hidden bg-gradient-to-br from-blue-100 via-indigo-50 to-purple-100 p-10 text-gray-800 lg:flex dark:border-r"
        >
            <!-- Background decorative elements -->
            <div class="absolute inset-0 opacity-20">
                <div class="animate-pulse-slow absolute top-20 left-20 h-72 w-72 rounded-full bg-blue-200 blur-3xl"></div>
                <div class="animate-float absolute right-20 bottom-20 h-96 w-96 rounded-full bg-purple-200 blur-3xl"></div>
            </div>

            <!-- Header with improved spacing -->
            <Link
                :href="route('home')"
                class="group relative z-20 mb-8 flex items-center text-lg font-medium transition-all duration-300 hover:scale-105"
            >
                <AppLogoIcon class="mr-3 size-10 fill-current text-blue-600 transition-transform duration-300 group-hover:rotate-12" />
                <span class="text-xl font-bold text-gray-800">{{ name }}</span>
            </Link>

            <!-- Main content with better typography and spacing -->
            <div class="relative z-10 flex flex-1 flex-col justify-center space-y-12 text-center lg:text-left">
                <div class="animate-slide-fade">
                    <div
                        class="animate-bounce-subtle mb-3 inline-flex items-center rounded-full border border-blue-200 bg-white/80 px-4 py-2 text-sm font-medium backdrop-blur-sm"
                    >
                        <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span class="text-gray-700">Trusted by 12,000+ restaurants worldwide</span>
                    </div>

                    <h1 class="mb-6 text-5xl leading-tight font-bold text-gray-800 md:text-6xl">
                        Restaurant Control Panel
                        <br />
                        <span class="animate-gradient bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text text-transparent">
                            Simplified Operations
                        </span>
                    </h1>

                    <p class="mx-auto max-w-2xl text-xl leading-relaxed text-gray-600 lg:mx-0">
                        Streamline your restaurant operations with our comprehensive platform. From inventory management to analytics, everything you
                        need in one powerful dashboard.
                    </p>
                </div>

                <!-- Enhanced metrics grid with light colors -->
                <div class="mt-2 grid grid-cols-2 gap-6 lg:grid-cols-3">
                    <!-- Restaurants -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-blue-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-blue-400 to-blue-500 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 9l1-5h16l1 5M4 10v10h16V10M9 21V12h6v9"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="animate-count-up mb-2 text-3xl font-bold text-gray-800">12,000+</div>
                            <div class="text-sm text-gray-600">Active Restaurants</div>
                        </div>
                    </div>

                    <!-- Countries -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-purple-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-purple-400 to-purple-500 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2 text-3xl font-bold text-gray-800">50+</div>
                            <div class="text-sm text-gray-600">Countries Served</div>
                        </div>
                    </div>

                    <!-- Orders -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-emerald-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-500 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v0a2 2 0 002 2h2m0 0v8a2 2 0 002 2h2a2 2 0 002-2V9a2 2 0 00-2-2H9m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2 text-3xl font-bold text-gray-800">1M+</div>
                            <div class="text-sm text-gray-600">Daily Orders</div>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-indigo-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-indigo-400 to-indigo-500 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2 text-3xl font-bold text-gray-800">24/7</div>
                            <div class="text-sm text-gray-600">Support Available</div>
                        </div>
                    </div>

                    <!-- Uptime -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-amber-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-amber-400 to-orange-400 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2 text-3xl font-bold text-gray-800">99.99%</div>
                            <div class="text-sm text-gray-600">System Uptime</div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="group cursor-pointer">
                        <div
                            class="rounded-2xl border border-teal-200 bg-white/80 p-6 backdrop-blur-sm transition-all duration-300 hover:scale-105 hover:bg-white/90 hover:shadow-xl"
                        >
                            <div class="mb-4 flex justify-center">
                                <div
                                    class="rounded-xl bg-gradient-to-br from-teal-400 to-cyan-500 p-3 transition-transform duration-300 group-hover:scale-110"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-white"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.582-3.756z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="mb-2 text-3xl font-bold text-gray-800">100%</div>
                            <div class="text-sm text-gray-600">Secure & Compliant</div>
                        </div>
                    </div>
                </div>

                <!-- Feature highlights -->
                <div class="animate-slide-up mt-12">
                    <div class="flex flex-wrap justify-center gap-4 lg:justify-start">
                        <div class="flex items-center rounded-full border border-blue-200 bg-white/80 px-4 py-2 text-sm font-medium backdrop-blur-sm">
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span class="text-gray-700">Real-time Analytics</span>
                        </div>
                        <div
                            class="flex items-center rounded-full border border-purple-200 bg-white/80 px-4 py-2 text-sm font-medium backdrop-blur-sm"
                        >
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span class="text-gray-700">Inventory Management</span>
                        </div>
                        <div
                            class="flex items-center rounded-full border border-emerald-200 bg-white/80 px-4 py-2 text-sm font-medium backdrop-blur-sm"
                        >
                            <svg class="mr-2 h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <span class="text-gray-700">Multi-location Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Clean light background -->
        <div class="flex min-h-screen items-center justify-center bg-white lg:p-8 dark:bg-gray-900">
            <div class="animate-slide-in-right mx-auto flex w-full flex-col justify-center space-y-8 sm:w-[400px]">
                <!-- Enhanced header section -->
                <div class="flex flex-col space-y-4 text-center">
                    <div
                        class="animate-bounce-subtle mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-400 to-indigo-500 shadow-lg"
                    >
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                            />
                        </svg>
                    </div>

                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white" v-if="title">
                        {{ title }}
                    </h1>

                    <p class="text-base leading-relaxed text-gray-600 dark:text-gray-400" v-if="description">
                        {{ description }}
                    </p>
                </div>

                <!-- Form container with enhanced styling -->
                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-8 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <slot />
                </div>

                <!-- Additional info section -->
                <div class="space-y-4 text-center">
                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                        <svg class="h-4 w-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span>Your data is protected with enterprise-grade security</span>
                    </div>

                    <div class="flex items-center justify-center space-x-6 text-xs text-gray-400">
                        <!-- <span>SOC 2 Compliant</span>
                        <span>•</span>
                        <span>GDPR Ready</span> -->
                        <span>•</span>
                        <span>256-bit Encryption</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Enhanced animations */
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

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }

    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-10px);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounceSubtle {
    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-4px);
    }
}

@keyframes pulseGlow {
    0%,
    100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }

    50% {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.5);
    }
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }

    50% {
        background-position: 100% 50%;
    }

    100% {
        background-position: 0% 50%;
    }
}

@keyframes pulseSlow {
    0%,
    100% {
        opacity: 0.2;
    }

    50% {
        opacity: 0.3;
    }
}

/* Animation classes */
.animate-slide-fade {
    animation: slideFade 0.8s ease-out;
}

.animate-slide-in-right {
    animation: slideInRight 0.6s ease-out;
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-slide-up {
    animation: slideUp 1s ease-out 0.3s both;
}

.animate-bounce-subtle {
    animation: bounceSubtle 3s ease-in-out infinite;
}

.animate-pulse-glow {
    animation: pulseGlow 2s ease-in-out infinite;
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

.animate-pulse-slow {
    animation: pulseSlow 4s ease-in-out infinite;
}

/* Responsive improvements */
@media (max-width: 1024px) {
    .animate-slide-fade h1 {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .animate-slide-fade h1 {
        font-size: 2rem;
        line-height: 1.2;
    }

    .animate-slide-fade p {
        font-size: 1rem;
    }
}
</style>
