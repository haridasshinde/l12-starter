<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Card, CardContent } from '@/components/ui/card'
import { Switch } from '@/components/ui/switch'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/components/ui/alert-dialog'
import { Button } from '@/components/ui/button'
import {
    DollarSign,
    Users,
    ShoppingCart,
    BarChart2,
    TrendingUp,
    ArrowDownCircle,
    Smile,
    RotateCcw
} from 'lucide-vue-next'
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
]



</script>

<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-4">
                <Card v-for="stat in stats" :key="stat.title" class="rounded-xl shadow-sm">
                    <CardContent class="px-3 flex justify-between items-star">
                        <div>
                            <p class="text-sm text-muted-foreground">{{ stat.title }}</p>
                            <h2 class="text-3xl font-bold text-black mt-1">{{ stat.value }}</h2>
                            <p class="text-xs text-muted-foreground mt-1">{{ stat.subtitle }}</p>
                        </div>
                        <component :is="stat.icon" class="w-5 h-5 text-muted-foreground mt-1" />
                    </CardContent>
                </Card>
            </div>
            <hr />
            <Switch />

            <hr />

            <AlertDialog>
                <AlertDialogTrigger as-child>
                    <Button class="w-32 h-8 text-sm">
                        Show Dialog
                    </Button>
                </AlertDialogTrigger>
                <AlertDialogContent>
                    <AlertDialogHeader>
                        <AlertDialogTitle>Are you absolutely sure?</AlertDialogTitle>
                        <AlertDialogDescription>
                            This action cannot be undone. This will permanently delete your
                            account and remove your data from our servers.
                        </AlertDialogDescription>
                    </AlertDialogHeader>
                    <AlertDialogFooter>
                        <AlertDialogCancel>Cancel</AlertDialogCancel>
                        <AlertDialogAction>Continue</AlertDialogAction>
                    </AlertDialogFooter>
                </AlertDialogContent>
            </AlertDialog>
        </div>
    </AppLayout>
</template>
