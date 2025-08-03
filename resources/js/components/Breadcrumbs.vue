<script setup lang="ts">
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu';
import { Link } from '@inertiajs/vue3';
import { ChevronDown } from 'lucide-vue-next';
import { ref } from 'vue';

interface BreadcrumbItem {
    title: string;
    href?: string;
    subItems?: BreadcrumbItem[];
}

defineProps<{
    breadcrumbs: BreadcrumbItem[];
}>();

const open = ref(false);
</script>

<template>
    <Breadcrumb>
        <BreadcrumbList>
            <template v-for="(item, index) in breadcrumbs" :key="index">
                <BreadcrumbItem>
                    <template v-if="index === breadcrumbs.length - 1">
                        <BreadcrumbPage>{{ item.title }}</BreadcrumbPage>
                    </template>
                    <template v-else-if="item.subItems">
                        <DropdownMenu>
                            <DropdownMenuTrigger class="flex items-center gap-1">
                                {{ item.title }}
                                <ChevronDown class="h-4 w-4 transition-transform duration-300" :class="{ 'rotate-180': open }" />
                            </DropdownMenuTrigger>

                            <Transition
                                enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 scale-95"
                                enter-to-class="opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 scale-100"
                                leave-to-class="opacity-0 scale-95"
                            >
                                <DropdownMenuContent align="start" v-show="open" ref="contentRef" class="origin-top-left">
                                    <template v-for="(subItem, subIndex) in item.subItems" :key="subIndex">
                                        <DropdownMenuItem>
                                            <Link :href="subItem.href ?? '#'">
                                                {{ subItem.title }}
                                            </Link>
                                        </DropdownMenuItem>
                                    </template>
                                </DropdownMenuContent>
                            </Transition>
                        </DropdownMenu>
                    </template>

                    <template v-else>
                        <BreadcrumbLink as-child>
                            <Link :href="item.href ?? '#'">
                                {{ item.title }}
                            </Link>
                        </BreadcrumbLink>
                    </template>
                </BreadcrumbItem>
                <BreadcrumbSeparator v-if="index !== breadcrumbs.length - 1" />
            </template>
        </BreadcrumbList>
    </Breadcrumb>
</template>
