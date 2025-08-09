<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Users', href: '/users' },
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
    links: PaginationLink[];
    data: User[];
}

const props = defineProps<{ users: UsersProp }>();
</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="flex h-full flex-1 flex-col gap-6 overflow-x-auto p-6 bg-white dark:bg-gray-900 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">User Management</h1>

            <div class="relative overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 uppercase text-xs tracking-wide">
                        <tr>
                            <th scope="col" class="p-4">#</th>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(user, index) in props.users.data" :key="user.id"
                            class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
                            :class="index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-900' : ''">
                            <td class="w-12 p-4 font-medium text-gray-800 dark:text-gray-200">{{ index + 1 }}</td>
                            <th scope="row"
                                class="px-6 py-4 font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                {{ user.name }}
                            </th>
                            <td class="px-6 py-4">{{ user.email }}</td>
                            <td class="px-6 py-4">
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
            <nav class="mt-4" aria-label="Pagination">
                <ul class="inline-flex -space-x-px rounded-md shadow-sm">
                    <li v-for="link in users.links" :key="link.label">
                        <Link v-if="link.url" :href="link.url"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            :class="{ 'bg-blue-600 text-white border-blue-600': link.active }" preserve-scroll>
                        <span v-html="link.label"></span>
                        </Link>

                        <span v-else v-html="link.label"
                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-gray-100 text-gray-400 cursor-default" />
                    </li>

                </ul>
            </nav>

        </div>
    </AppLayout>
</template>
