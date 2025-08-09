<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Pagination from '../extra/Pagination.vue';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'User Management', href: '/users' },
];

interface User {
    id: number;
    name: string;
    email: string;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface UsersProp {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    first_page_url: string;
    last_page_url: string;
    links: PaginationLink[];
    data: User[];
}

const props = defineProps<{ users: UsersProp }>();

</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">


            <div class="relative overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 uppercase text-xs tracking-wide">
                        <tr>
                            <th scope="col" class="p-3">#</th>
                            <th scope="col" class="px-5 py-1">Name</th>
                            <th scope="col" class="px-5 py-1">Email</th>
                            <th scope="col" class="px-5 py-1">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(user, index) in props.users.data" :key="user.id"
                            class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
                            :class="index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-900' : ''">
                            <td class="w-12 p-3 font-medium text-gray-800 dark:text-gray-200">{{ index + 1 }}</td>
                            <th scope="row"
                                class="px-5 py-2 font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                {{ user.name }}
                            </th>
                            <td class="px-5 py-2">{{ user.email }}</td>
                            <td class="px-5 py-2">
                                <a href="#"
                                    class="inline-block px-3 py-1 text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900 rounded-md font-medium hover:bg-blue-200 dark:hover:bg-blue-800 transition">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- Pagination -->
            <Pagination :pagination="users" />
        </div>
    </AppLayout>
</template>
