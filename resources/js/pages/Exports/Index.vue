<script setup lang="ts">
import { router } from '@inertiajs/vue3'

interface ExportRecord {
    id: number
    file_name: string | null
    file_path: string | null
    status: 'pending' | 'processing' | 'completed' | 'failed'
    created_at: string
    updated_at: string
}

const props = defineProps<{
    exports: ExportRecord[]
}>()

function startExport() {
    router.post('/exports')
}
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">User Exports</h1>

        <button @click="startExport" class="bg-blue-600 text-white px-4 py-2 rounded">
            Start New Export
        </button>

        <table class="mt-6 w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">File Name</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Download</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="exp in props.exports" :key="exp.id">
                    <td class="border p-2">{{ exp.id }}</td>
                    <td class="border p-2">{{ exp.file_name || '-' }}</td>
                    <td class="border p-2">
                        <span v-if="exp.status === 'completed'" class="text-green-600">✔ Completed</span>
                        <span v-else-if="exp.status === 'processing'" class="text-yellow-600">Processing...</span>
                        <span v-else-if="exp.status === 'pending'" class="text-gray-600">Pending</span>
                        <span v-else class="text-red-600">Failed</span>
                    </td>
                    <td class="border p-2">
                        <a v-if="exp.status === 'completed'" :href="`/storage/${exp.file_path}`"
                            class="text-blue-500 underline" download>
                            Download
                        </a>
                        <span v-else>-</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
