<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import Pagination from '../extra/Pagination.vue'
import { ref, watch } from 'vue'
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import {
    Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue,
} from "@/components/ui/select"
import { Download, Plus, SlidersHorizontal } from 'lucide-vue-next'
import { formatDateTime } from "@/utils/dateFormat"
import DateFilterDropdown from '@/components/DateFilterDropdown.vue'
import { format, toDate } from 'date-fns'
import type { BreadcrumbItem } from '@/types'
import type { UsersProp } from '@/types/user'
import UserEditSheet from './UserEditSheet.vue'
import { useUserSheet } from '@/composables/useUserSheet'

const breadcrumbs: BreadcrumbItem[] = [{ title: 'User Management', href: '/users' }]
const props = defineProps<{ users: UsersProp }>()

const { isSheetOpen, selectedUser, openEditSheet, cancelEdit, saveChanges } = useUserSheet()
const isFullDay = ref(false)
const range = ref<{ start: Date | null, end: Date | null }>({ start: null, end: null })

watch(range, (val) => {
    if (!val) return
    console.log("📅 Parent got new range:", {
        start: val.start ? format(toDate(val.start), "yyyy-MM-dd HH:mm:ss") : null,
        end: val.end ? format(toDate(val.end), "yyyy-MM-dd HH:mm:ss") : null,
    })
})
</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="relative overflow-x-auto rounded-lg">
                <!-- Toolbar -->
                <div class="flex items-center justify-between py-3">
                    <div class="flex items-center gap-3">
                        <DateFilterDropdown v-model="range" :fullDay="isFullDay" />
                        <Button variant="outline" @click="openEditSheet(selectedUser)">
                            <SlidersHorizontal /> Filter
                        </Button>
                        <div class="flex">
                            <Select>
                                <SelectTrigger class="w-[140px] rounded-r-none border-r-0">
                                    <SelectValue placeholder="Search field" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectItem value="name">Name</SelectItem>
                                        <SelectItem value="email">Email</SelectItem>
                                        <SelectItem value="phone">Phone</SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <Input type="text" placeholder="Search" class="w-[200px] rounded-l-none" />
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <Button variant="outline" size="sm">
                            <Download /> Export
                        </Button>
                        <Button>
                            <Plus /> Add User
                        </Button>
                    </div>
                </div>

                <!-- Table -->
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 uppercase text-xs tracking-wide">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="px-5 py-1">Name</th>
                            <th class="px-5 py-1">Email</th>
                            <th class="px-5 py-1">Registered At</th>
                            <th class="px-5 py-1">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in props.users.data" :key="user.id"
                            class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
                            :class="index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-900' : ''">
                            <td class="w-12 p-3 font-medium">{{ index + 1 }}</td>
                            <td class="px-5 py-2 font-semibold whitespace-nowrap">{{ user.name }}</td>
                            <td class="px-5 py-2">{{ user.email }}</td>
                            <td class="px-5 py-2">{{ formatDateTime(user.created_at) }}</td>
                            <td class="px-5 py-2">
                                <Button variant="outline" @click="openEditSheet(user)">Edit</Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <Pagination :pagination="props.users" />

            <!-- User Edit Sheet -->
            <UserEditSheet v-model:open="isSheetOpen" :user="selectedUser" @save="saveChanges" @cancel="cancelEdit" />

        </div>
    </AppLayout>
</template>
