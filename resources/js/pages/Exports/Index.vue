<script setup lang="ts">
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/components/ui/sheet"
import { Button } from "@/components/ui/button"
import { Card, CardHeader, CardTitle, CardContent } from "@/components/ui/card"
import { Table, TableHeader, TableRow, TableHead, TableBody, TableCell } from "@/components/ui/table"
import { Badge } from "@/components/ui/badge"
import { formatDateTime, getTimeDiffString } from '@/utils/dateFormat'
import { useExportNotifications } from '@/utils/useExportNotifications'

const { exportsList, messages } = useExportNotifications(5000)
</script>

<template>
    <Sheet>
        <SheetTrigger as-child>
            <Button variant="outline" class="flex items-center gap-2">
                📂 Show Exports
            </Button>
        </SheetTrigger>

        <SheetContent side="right" class="w-full sm:max-w-[850px] h-full flex flex-col">
            <SheetHeader class="relative border-b pb-3">
                <div class="flex items-center justify-between pr-10">
                    <SheetTitle class="text-lg font-semibold">User Exports</SheetTitle>
                    <!-- <Button variant="secondary" size="sm" @click="fetchExports" :disabled="loading"
                        class="flex items-center gap-1">
                        <RefreshCw class="w-4 h-4" :class="{ 'animate-spin': loading }" />
                        <span>{{ loading ? "Refreshing..." : "Refresh" }}</span>
                    </Button> -->
                </div>
            </SheetHeader>

            <!-- Notifications -->
            <div v-for="msg in messages" :key="msg" class="bg-green-100 text-green-700 p-2 mb-2 rounded">
                {{ msg }}
            </div>

            <!-- Exports Table -->
            <Card class="flex-1 m-2 shadow-md rounded-2xl">
                <CardHeader class="pb-2">
                    <CardTitle class="text-base">Exports List</CardTitle>
                </CardHeader>
                <CardContent class="overflow-auto max-h-[calc(100vh-180px)]">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[60px]">ID</TableHead>
                                <TableHead>File Name</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>Created At</TableHead>
                                <TableHead>Updated At</TableHead>
                                <TableHead>Duration</TableHead>
                                <TableHead class="text-right">Download</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="exp in exportsList" :key="exp.id">
                                <TableCell>{{ exp.id }}</TableCell>
                                <TableCell>{{ exp.file_name || '-' }}</TableCell>
                                <TableCell>
                                    <Badge v-if="exp.status === 'completed'">Completed</Badge>
                                    <Badge v-else-if="exp.status === 'processing'" variant="secondary">Processing
                                    </Badge>
                                    <Badge v-else-if="exp.status === 'pending'" variant="outline">Pending</Badge>
                                    <Badge v-else variant="destructive">Failed</Badge>
                                </TableCell>
                                <TableCell>{{ formatDateTime(exp.created_at) }}</TableCell>
                                <TableCell>{{ formatDateTime(exp.updated_at) }}</TableCell>
                                <TableCell>{{ getTimeDiffString(exp.created_at, exp.updated_at) }}</TableCell>
                                <TableCell class="text-right">
                                    <Button v-if="exp.status === 'completed' && exp.file_path" as-child variant="link"
                                        class="px-0 text-blue-600">
                                        <a :href="`/storage/${exp.file_path}`" download>Download</a>
                                    </Button>
                                    <span v-else class="text-gray-400">—</span>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="exportsList.length === 0">
                                <TableCell colspan="7" class="text-center py-6 text-gray-500">No exports yet</TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>
        </SheetContent>
    </Sheet>
</template>
