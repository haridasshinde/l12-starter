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
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'

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
import { Toaster, toast } from 'vue-sonner'
import 'vue-sonner/style.css'
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

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from '@/components/ui/sheet'

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
            <Button class="w-32 h-8 text-sm" variant="outline" @click="() => {
                toast('Event has been created', {
                    description: 'Sunday, December 03, 2023 at 9:00 AM',
                    action: {
                        label: 'Undo',
                        onClick: () => console.log('Undo'),
                    },
                })
            }">
                Add to calendar
            </Button>
            <hr />



            <Toaster />
            <Button class="w-32 h-8 text-sm" @click="() => toast('My first toast')">
                Give me a toast
            </Button>

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

            <div class="grid grid-cols-2 gap-2">
                <Sheet>
                    <SheetTrigger as-child>
                        <Button variant="outline" class="w-32 h-8 text-sm">
                            Open Left Sidebar
                        </Button>
                    </SheetTrigger>
                    <SheetContent>
                        <SheetHeader>
                            <SheetTitle>Edit profile</SheetTitle>
                            <SheetDescription>
                                Make changes to your profile here. Click save when you're done.
                            </SheetDescription>
                        </SheetHeader>

                        <div class="grid gap-4 py-4 p-2">
                            <div class="grid grid-cols-4 items-center gap-4">
                                <Label for="name" class="text-right">
                                    Name
                                </Label>
                                <Input id="name" value="Pedro Duarte" class="col-span-3" />
                            </div>
                            <div class="grid grid-cols-4 items-center gap-4">
                                <Label for="username" class="text-right">
                                    Username
                                </Label>
                                <Input id="username" value="@peduarte" class="col-span-3" />
                            </div>
                        </div>
                        <SheetFooter>
                            <SheetClose as-child>
                                <Button type="submit">
                                    Save changes
                                </Button>
                            </SheetClose>
                        </SheetFooter>
                    </SheetContent>
                </Sheet>
            </div>

            <Select>
                <SelectTrigger class="w-[180px]">
                    <SelectValue placeholder="Select a fruit" />
                </SelectTrigger>
                <SelectContent>
                    <SelectGroup>
                        <SelectLabel>Fruits</SelectLabel>
                        <SelectItem value="apple">
                            Apple
                        </SelectItem>
                        <SelectItem value="banana">
                            Banana
                        </SelectItem>
                        <SelectItem value="blueberry">
                            Blueberry
                        </SelectItem>
                        <SelectItem value="grapes">
                            Grapes
                        </SelectItem>
                        <SelectItem value="pineapple">
                            Pineapple
                        </SelectItem>
                    </SelectGroup>
                </SelectContent>
            </Select>
        </div>
    </AppLayout>
</template>
