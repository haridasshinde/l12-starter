<script lang="ts">
import { defineComponent, PropType } from "vue";
import { Link as InertiaLink } from '@inertiajs/vue3';

interface LinkType {
    url: string | null;
    label: string;
    active: boolean;
}

interface Pagination {
    current_page: number;
    first_page_url: string;
    last_page_url: string;
    last_page: number;
    links: LinkType[];
}

export default defineComponent({
    name: "Pagination",
    components: { InertiaLink },   // <-- Register the Link component here
    props: {
        pagination: {
            type: Object as PropType<Pagination>,
            required: true,
        },
    },
});
</script>

<template>
    <nav class="mt-0 flex justify-center" aria-label="Pagination">
        <ul class="inline-flex border border-gray-300 rounded-md shadow-sm">

            <!-- First Page Button -->
            <li class="border-r border-gray-300">
                <InertiaLink v-if="pagination.current_page > 1" :href="pagination.first_page_url" preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-l"
                    aria-label="First Page">
                    First
                </InertiaLink>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-l"
                    aria-disabled="true">
                    First
                </span>
            </li>

            <!-- Page Number Links -->
            <li v-for="link in pagination.links" :key="link.label" class="border-r last:border-r-0 border-gray-300">
                <InertiaLink v-if="link.url" :href="link.url" preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1"
                    :class="link.active ? 'bg-blue-300 text-blue-400 cursor-default' : ''" aria-current="page">
                    <span v-html="link.label"></span>
                </InertiaLink>

                <span v-else v-html="link.label"
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none"
                    aria-disabled="true" />
            </li>

            <!-- Last Page Button -->
            <li class="border-l border-gray-300">
                <InertiaLink v-if="pagination.current_page < pagination.last_page" :href="pagination.last_page_url"
                    preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-r"
                    aria-label="Last Page">
                    Last
                </InertiaLink>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-r"
                    aria-disabled="true">
                    Last
                </span>
            </li>

        </ul>
    </nav>
</template>
