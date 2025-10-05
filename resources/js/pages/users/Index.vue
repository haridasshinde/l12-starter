<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, router } from '@inertiajs/vue3'
import Pagination from '../extra/Pagination.vue'
import { onMounted, ref, watch } from 'vue'
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import {
    Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue,
} from "@/components/ui/select"
import { Download, Plus, Info, Search, Trash, UserRoundPen } from 'lucide-vue-next'
import { formatDateTime } from "@/utils/dateFormat"
import DateFilterDropdown from '@/components/DateFilterDropdown.vue'
import { format, toDate } from 'date-fns'
import type { BreadcrumbItem } from '@/types'
import type { UsersProp } from '@/types/user'
import UserEditSheet from './UserEditSheet.vue'
import ExportsIndex from '../Exports/Index.vue'
import { useUserSheet } from '@/composables/useUserSheet'
import Avatar from '@/components/ui/avatar/Avatar.vue'
import AvatarFallback from '@/components/ui/avatar/AvatarFallback.vue'
import AvatarImage from '@/components/ui/avatar/AvatarImage.vue'

const breadcrumbs: BreadcrumbItem[] = [{ title: 'User Management', href: '/users' }]
const props = defineProps<{ users: UsersProp }>()
let mounted = false;
const { isSheetOpen, selectedUser, openEditSheet, cancelEdit, saveChanges, newUserCreate, isEditUser, deleteUser } = useUserSheet()
const isFullDay = ref(true)
const today = new Date()

const range = ref<{ start: Date | null; end: Date | null }>({
    start: today,
    end: today,
})

const searchField = ref("name");
const search = ref("");

const applyFilters = (page?: number) => {
    // Prepare date range in a consistent format
    const startDate = range.value.start
        ? format(toDate(range.value.start), 'yyyy-MM-dd HH:mm:ss')
        : null

    const endDate = range.value.end
        ? format(toDate(range.value.end), 'yyyy-MM-dd HH:mm:ss')
        : null

    // Build payload
    const payload = {
        page: page ?? 1, // default to page 1 if undefined
        start: startDate,
        end: endDate,
        target: searchField.value || null,
        q: search.value || null,
    }

    // Make POST request with Inertia
    router.post('/users', payload, {
        preserveState: true,  // keeps component state like filters
        preserveScroll: true, // keeps scroll position
    },)
}


const getUserInitials = (name: string) => {
    if (!name) return 'NA';
    const names = name.split(' ');
    const initials = names.map(n => n[0].toUpperCase()).join('');
    return initials.slice(0, 2); // max 2 letters
}

const message = ref<string | null>(null)

function showMessage(text: string) {
    message.value = text
    setTimeout(() => {
        message.value = null
    }, 3000) // auto close after 3 seconds
}

const exportsComp = ref<InstanceType<typeof ExportsIndex> | null>(null)
function startExport() {
    message.value = null

    router.post('/exports', {}, {
        onSuccess: () => {
            showMessage("✅ Export started successfully!");
            if (exportsComp.value) {
                exportsComp.value.fetchExports() // 👈 call child function
            }
        },
        onError: () => {
            showMessage("❌ Something went wrong while starting the export.")
        }
    })
}

watch(range, (val) => {
    if (!mounted) return;
    if (!val) return
    applyFilters();
})

watch(() => search.value, (val) => {
    if (!val) {
        applyFilters()
    }
})



onMounted(() => {
    mounted = true
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
                        <!-- <Button variant="outline" @click="openEditSheet(selectedUser)">
                            <SlidersHorizontal /> Filter
                        </Button> -->
                        <div class="flex items-center">
                            <Select v-model="searchField">
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

                            <Input type="text" placeholder="Search" v-model="search"
                                class="w-[200px] rounded-none border-r-0" />

                            <!-- Search Button -->
                            <Button variant="outline"
                                class="flex items-center gap-2 px-4 rounded-l-none rounded-r-md transition-colors duration-200 hover:bg-blue-50disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed disabled:hover:bg-gray-200"
                                :disabled="!search" @click.prevent="applyFilters">
                                <Search :class="!search ? 'text-gray-400' : 'text-blue-500'" />
                                Search
                            </Button>
                        </div>

                    </div>
                    <div class="flex items-center gap-2">
                        <Button variant="outline" size="sm" @click="startExport">
                            <Download /> Export
                        </Button>
                        <!-- Export Button -->
                        <ExportsIndex ref="exportsComp" />
                        <Button @click="newUserCreate">
                            <Plus /> Add User
                        </Button>
                    </div>
                </div>
                <!-- Feedback Message -->
                <transition name="fade">
                    <div v-if="message" class="mt-4 p-2 rounded text-sm"
                        :class="message.includes('✅') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'">
                        {{ message }}
                    </div>
                </transition>
                <!-- Table -->
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 uppercase text-xs tracking-wide">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="px-5 py-1">Name</th>
                            <th class="px-5 py-1">Photo</th>
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
                            <td class="px-5 py-2">
                                <Avatar>
                                    <AvatarImage :src="user.avatar ?? ''" :alt="user.name || 'User Avatar'" />
                                    <AvatarFallback>
                                        {{ getUserInitials(user.name) }}
                                    </AvatarFallback>
                                </Avatar>
                            </td>
                            <td class="px-5 py-2">{{ user.email }}</td>
                            <td class="px-5 py-2">{{ formatDateTime(user.created_at) }}</td>
                            <td class="px-5 py-2 flex gap-2">
                                <Button variant="outline" @click="openEditSheet(user)">
                                    <UserRoundPen /> Edit
                                </Button>
                                <Button variant="destructive" @click="deleteUser(user)">
                                    <Trash />
                                    Delete
                                </Button>
                            </td>
                        </tr>
                        <tr v-if="!props.users.data.length">
                            <td class="px-5 py-2 text-center" colspan="5">
                                <div class="flex items-center justify-center gap-2 text-gray-500">
                                    <Info class="w-4 h-4" />
                                    <span>No records found</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <Pagination :pagination="props.users" v-if="props.users.data.length" @page-changed="applyFilters" />
            <!-- User Edit Sheet -->
            <UserEditSheet v-model:open="isSheetOpen" :isEditUser="isEditUser" :user="selectedUser" @save="saveChanges"
                @cancel="cancelEdit" />


        </div>
    </AppLayout>
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
