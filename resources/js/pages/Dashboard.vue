<script setup lang="ts">
import { Card, CardContent } from '@/components/ui/card';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

import { ArrowDownCircle, BarChart2, DollarSign, RotateCcw, ShoppingCart, Smile, TrendingUp, Users } from 'lucide-vue-next';
import 'vue-sonner/style.css';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const stats = [
    {
        title: 'Total Revenue',
        value: '$45,231.89',
        subtitle: '+20.1% from last month',
        icon: DollarSign,
    },
    {
        title: 'New Users',
        value: '1,289',
        subtitle: '+4.5% from last week',
        icon: Users,
    },
    {
        title: 'Orders',
        value: '3,124',
        subtitle: '+8.7% this month',
        icon: ShoppingCart,
    },
    {
        title: 'Revenue Growth',
        value: '12.4%',
        subtitle: 'Compared to last quarter',
        icon: TrendingUp,
    },
    {
        title: 'Active Sessions',
        value: '8,234',
        subtitle: 'Live users now',
        icon: BarChart2,
    },
    {
        title: 'Bounce Rate',
        value: '38.7%',
        subtitle: 'Down from 42.3%',
        icon: ArrowDownCircle,
    },
    {
        title: 'Satisfaction',
        value: '96%',
        subtitle: 'Customer feedback score',
        icon: Smile,
    },
    {
        title: 'Refunds',
        value: '53',
        subtitle: 'This month',
        icon: RotateCcw,
    },
];

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-4">
                <Card v-for="stat in stats" :key="stat.title" class="rounded-xl shadow-sm">
                    <CardContent class="items-star flex justify-between px-3">
                        <div>
                            <p class="text-sm text-muted-foreground">{{ stat.title }}</p>
                            <h2 class="mt-1 text-3xl font-bold text-black">{{ stat.value }}</h2>
                            <p class="mt-1 text-xs text-muted-foreground">{{ stat.subtitle }}</p>
                        </div>
                        <component :is="stat.icon" class="mt-1 h-5 w-5 text-muted-foreground" />
                    </CardContent>
                </Card>
            </div>
        </div>
    </AppLayout>
</template>
