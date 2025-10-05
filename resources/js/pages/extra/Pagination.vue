<script lang="ts">
import { defineComponent, PropType } from "vue";

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
    props: {
        pagination: {
            type: Object as PropType<Pagination>,
            required: true,
        },
    },
    emits: ["page-changed"], // <-- emit event
    methods: {
        handlePageChange(page: number) {
            if (page !== this.pagination.current_page) {
                this.$emit("page-changed", page)
            }
        },
    },
});
</script>


<template>
    <nav class="mt-0 flex justify-center" aria-label="Pagination">
        <ul class="inline-flex border border-gray-300 rounded-md shadow-sm">

            <!-- First Page -->
            <li class="border-r border-gray-300">
                <button v-if="pagination.current_page > 1" @click="handlePageChange(1)"
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-l">
                    First
                </button>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-l">
                    First
                </span>
            </li>

            <!-- Page Numbers -->
            <li v-for="link in pagination.links" :key="link.label" class="border-r last:border-r-0 border-gray-300">
                <button v-if="link.url" @click="handlePageChange(parseInt(link.label) || 1)"
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1"
                    :class="link.active ? 'bg-blue-300 text-blue-400 cursor-default' : ''">
                    <span v-html="link.label"></span>
                </button>
                <span v-else v-html="link.label"
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none" />
            </li>

            <!-- Last Page -->
            <li class="border-l border-gray-300">
                <button v-if="pagination.current_page < pagination.last_page"
                    @click="handlePageChange(pagination.last_page)"
                    class="block px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-1 rounded-r">
                    Last
                </button>
                <span v-else
                    class="block px-4 py-2 text-sm font-medium text-gray-400 cursor-not-allowed select-none rounded-r">
                    Last
                </span>
            </li>

        </ul>
    </nav>
</template>
