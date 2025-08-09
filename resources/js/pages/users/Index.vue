<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue'
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Users',
        href: '/users',
    },
];

interface User {
    id: number
    name: string
    email: string
}

interface Pagination {
    current_page: number      // current page number
    last_page: number         // last page number (total pages)
    per_page: number          // number of items per page
    total: number             // total number of items across all pages
    from: number | null       // index of first item on current page (null if no items)
    to: number | null         // index of last item on current page (null if no items)
    links: Array<{
        url: string | null      // url of page or null if not clickable
        label: string           // page label, e.g. "1", "2", "Next"
        active: boolean         // true if this is the current page
    }>
}
interface UsersProp {
    data: User[]
    current_page: number
    last_page: number
    // optionally add other pagination meta fields
}

const { users } = defineProps<{ users: UsersProp }>()

</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <h1>User Management</h1>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600"
                        v-for="(user, index) in users.data" :key="index">
                        <td class="w-4 p-4">
                            {{ index + 1 }}
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        </div>
    </AppLayout>
</template>
