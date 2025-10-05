<script lang="ts">
import { defineComponent, PropType } from "vue";
import { Link as InertiaLink } from "@inertiajs/vue3";

interface LinkType {
    url: string | null;
    label: string;
    active: boolean;
}

interface Pagination {
    path: string;
    current_page: number;
    first_page_url: string;
    last_page_url: string;
    last_page: number;
    links: LinkType[];
}

export default defineComponent({
    name: "Pagination",
    components: { InertiaLink },
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

            <!-- First Page -->
            <li class="border-r border-gray-300">
                <InertiaLink v-if="pagination.current_page > 1" method="post" :href="pagination.path"
                    :data="{ page: 1 }" as="button" preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-l">
                    First
                </InertiaLink>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-l">
                    First
                </span>
            </li>

            <!-- Page Numbers -->
            <li v-for="link in pagination.links" :key="link.label" class="border-r last:border-r-0 border-gray-300">
                <InertiaLink v-if="link.url" method="post" :href="pagination.path"
                    :data="{ page: parseInt(link.label) || null }" as="button" preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1"
                    :class="link.active ? 'bg-blue-300 text-blue-400 cursor-default' : ''">
                    <span v-html="link.label"></span>
                </InertiaLink>

                <span v-else v-html="link.label"
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none" />
            </li>

            <!-- Last Page -->
            <li class="border-l border-gray-300">
                <InertiaLink v-if="pagination.current_page < pagination.last_page" method="post" :href="pagination.path"
                    :data="{ page: pagination.last_page }" as="button" preserve-scroll
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-r">
                    Last
                </InertiaLink>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-r">
                    Last
                </span>
            </li>

        </ul>
    </nav>
</template>
