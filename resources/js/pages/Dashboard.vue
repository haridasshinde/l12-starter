<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import { DollarSign, ShoppingCart, TrendingUp, Users } from 'lucide-vue-next';
import 'vue-sonner/style.css';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const groupedStats = [
    {
        label: 'Desktop POS (Offline)',
        stats: [
            {
                title: 'Registration',
                value: '$45,231.89',
                subtitle: '+20.1% from last month',
                icon: DollarSign,
            },
            {
                title: 'Activation',
                value: '1,289',
                subtitle: '+4.5% from last week',
                icon: Users,
            },
            {
                title: 'Feedbacks',
                value: '$45,231.89',
                subtitle: '+20.1% from last month',
                icon: DollarSign,
            },
            {
                title: 'History',
                value: '1,289',
                subtitle: '+4.5% from last week',
                icon: Users,
            },
        ],
    },
    {
        label: 'Captain App (Offline)',
        stats: [
            {
                title: 'Registration',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
            {
                title: 'Activation',
                value: '12.4%',
                subtitle: 'Compared to last quarter',
                icon: TrendingUp,
            },
            {
                title: 'Trial',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
        ],
    },
    {
        label: 'Kitchen APP (Offline)',
        stats: [
            {
                title: 'Registration',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
            {
                title: 'Activation',
                value: '12.4%',
                subtitle: 'Compared to last quarter',
                icon: TrendingUp,
            },
            {
                title: 'Trial',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
        ],
    },
    {
        label: 'Atlantic POS (Desktop & Mobile)',
        stats: [
            {
                title: 'Activated Master Users',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
            {
                title: 'Activated Outlets',
                value: '12.4%',
                subtitle: 'Compared to last quarter',
                icon: TrendingUp,
            },
            {
                title: 'Demo Requests',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
        ],
    },
    {
        label: 'Enquiry',
        stats: [
            {
                title: 'Campain Enquiry',
                value: '3,124',
                subtitle: '+8.7% this month',
                icon: ShoppingCart,
            },
            {
                title: 'Quick Enquiry',
                value: '12.4%',
                subtitle: 'Compared to last quarter',
                icon: TrendingUp,
            },
        ],
    },
]
</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div v-for="group in groupedStats" :key="group.label" class="space-y-2">
                <!-- Group Label -->
                <h2 class="text-lg font-semibold text-gray-700">{{ group.label }}</h2>

                <!-- Stats Cards -->
                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                    <Card v-for="stat in group.stats" :key="stat.title"
                        class="rounded-xl shadow-sm transition-all duration-300 ease-in-out hover:shadow-lg hover:scale-105">
                        <CardContent class="flex items-start justify-between py-0">
                            <div>
                                <p class="text-sm text-muted-foreground">{{ stat.title }}</p>
                                <h4 class="mt-1 font-bold text-black">
                                    {{ stat.value }}
                                </h4>
                                <p class="mt-1 text-xs text-muted-foreground">
                                    {{ stat.subtitle }}
                                </p>
                            </div>
                            <component :is="stat.icon" class="mt-1 h-5 w-5 text-muted-foreground" />
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>



    </AppLayout>
</template>
