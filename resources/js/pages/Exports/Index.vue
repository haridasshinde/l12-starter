<script setup lang="ts">
import axios from 'axios'
import { ref, onMounted } from 'vue'
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/components/ui/sheet"
import { Button } from "@/components/ui/button"

interface ExportRecord {
    id: number
    file_name: string | null
    file_path: string | null
    status: 'pending' | 'processing' | 'completed' | 'failed'
    created_at: string
    updated_at: string
}

const exportsList = ref<ExportRecord[]>([])
const loading = ref(false)

async function fetchExports() {
    try {
        loading.value = true
        const res = await axios.get('/exports')
        exportsList.value = res.data.data
    } catch (err) {
        console.error("Fetch error:", err)
    } finally {
        loading.value = false
    }
}

onMounted(() => {
    fetchExports()
})

defineExpose({ fetchExports })
</script>

<template>
    <Sheet>
        <!-- Sidebar trigger -->
        <SheetTrigger as-child>
            <Button variant="outline">📂 Show Exports</Button>
        </SheetTrigger>

        <!-- Sidebar -->
        <SheetContent side="right" class="w-full sm:max-w-[700px] h-full">
            <SheetHeader class="flex items-center justify-between">
                <SheetTitle>User Exports</SheetTitle>
                <Button variant="secondary" size="sm" @click="fetchExports" :disabled="loading">
                    {{ loading ? "Refreshing..." : "↻ Refresh" }}
                </Button>
            </SheetHeader>

            <div class="mt-6">
                <table class="w-full border border-gray-300 text-sm">
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
                                <span v-if="exp.status === 'completed'" class="text-green-600 font-semibold">✔
                                    Completed</span>
                                <span v-else-if="exp.status === 'processing'"
                                    class="text-yellow-600 font-semibold">Processing...</span>
                                <span v-else-if="exp.status === 'pending'"
                                    class="text-gray-600 font-semibold">Pending</span>
                                <span v-else class="text-red-600 font-semibold">Failed</span>
                            </td>
                            <td class="border p-2">
                                <a v-if="exp.status === 'completed' && exp.file_path"
                                    :href="`/storage/${exp.file_path}`"
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
        </SheetContent>
    </Sheet>
</template>
