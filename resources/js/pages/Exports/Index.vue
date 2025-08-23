<script setup lang="ts">
import axios from 'axios'
import { ref, onMounted } from 'vue'

interface ExportRecord {
    id: number
    file_name: string | null
    file_path: string | null
    status: 'pending' | 'processing' | 'completed' | 'failed'
    created_at: string
    updated_at: string
}

const exportsList = ref<ExportRecord[]>([])

async function fetchExports() {
    try {
        const res = await axios.get('/exports') // use absolute path
        console.log("Refresh Export Data:", res.data)
        exportsList.value = res.data.data // must match controller response
    } catch (err) {
        console.error("Fetch error:", err)
    }
}

onMounted(() => {
    fetchExports()
})

// 👇 expose this function so parent can call it
defineExpose({
    fetchExports
})
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">User Exports</h1>

        <table class="mt-6 w-full border border-gray-300 text-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">File Name</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Download</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="exp in exportsList" :key="exp.id" class="hover:bg-gray-50">
                    <td class="border p-2">{{ exp.id }}</td>
                    <td class="border p-2">{{ exp.file_name || '-' }}</td>
                    <td class="border p-2">
                        <span v-if="exp.status === 'completed'" class="text-green-600 font-semibold">✔ Completed</span>
                        <span v-else-if="exp.status === 'processing'"
                            class="text-yellow-600 font-semibold">Processing...</span>
                        <span v-else-if="exp.status === 'pending'" class="text-gray-600 font-semibold">Pending</span>
                        <span v-else class="text-red-600 font-semibold">Failed</span>
                    </td>
                    <td class="border p-2">
                        <a v-if="exp.status === 'completed' && exp.file_path" :href="`/storage/${exp.file_path}`"
                            class="text-blue-500 underline hover:text-blue-700" download>
                            Download
                        </a>
                        <span v-else>-</span>
                    </td>
                </tr>
                <tr v-if="exportsList.length === 0">
                    <td colspan="4" class="text-center p-4 text-gray-500">No exports yet</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
