<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import Pagination from '../extra/Pagination.vue';
import { ref, watch } from 'vue';
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import {
    Sheet,
    SheetClose,
    SheetContent,
    SheetDescription,
    SheetFooter,
    SheetHeader,
    SheetTitle,
} from "@/components/ui/sheet";

import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from "@/components/ui/select";
import { Download, Plus, SlidersHorizontal } from 'lucide-vue-next';
import Swal from 'sweetalert2'
import { formatDateTime } from "@/utils/dateFormat";
import DateFilterDropdown from '@/components/DateFilterDropdown.vue';
import { format, toDate } from 'date-fns';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'User Management', href: '/users' },
];

interface User {
    id: number;
    name: string;
    email: string;
    created_at: string;
    updated_at: string;  // optional
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface UsersProp {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    from: number | null;
    to: number | null;
    first_page_url: string;
    last_page_url: string;
    links: PaginationLink[];
    data: User[];
}

const props = defineProps<{ users: UsersProp }>();

// Sheet control
const isSheetOpen = ref(false);
const isFullDay = ref(false);
const emptyUser = { id: 0, name: '', email: '', created_at: '', updated_at: '' }
const selectedUser = ref<User>({ ...emptyUser })

function openEditSheet(user: User) {
    selectedUser.value = { ...user }; // shallow copy so changes are local
    isSheetOpen.value = true;
}

function saveChanges() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save the changes?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, save it!',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform your save logic here
            console.log("Saving user data", selectedUser.value);
            Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: 'User data has been saved successfully.',
                timer: 2000,
                showConfirmButton: false,
            });

            isSheetOpen.value = false;
            Object.assign(selectedUser, {
                ...emptyUser
            })
        }
    });

}
function cancelEdit() {
    isSheetOpen.value = false;
}

const range = ref<{ start: Date | null, end: Date | null, startMilis: number | null }>({ start: null, end: null, startMilis: null })

watch(range, (val) => {
    if (!val) return

    const { start, end, startMilis } = val

    const formattedStart = start ? format(toDate(start), "yyyy-MM-dd HH:mm:ss") : null
    const formattedEnd = end ? format(toDate(end), "yyyy-MM-dd HH:mm:ss") : null

    console.log("📅 Parent got new range:", { start: formattedStart, end: formattedEnd, startMilis })
})
</script>

<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="relative overflow-x-auto rounded-lg">

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
                            <Download />
                            Export
                        </Button>

                        <Button>
                            <Plus />

                            Add User
                        </Button>
                    </div>
                </div>
                <table class="min-w-full text-sm text-left text-gray-600 dark:text-gray-300">
                    <thead
                        class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-400 uppercase text-xs tracking-wide">
                        <tr>
                            <th scope="col" class="p-3">#</th>
                            <th scope="col" class="px-5 py-1">Name</th>
                            <th scope="col" class="px-5 py-1">Email</th>
                            <th scope="col" class="px-5 py-1">Registered At</th>
                            <th scope="col" class="px-5 py-1">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(user, index) in props.users.data" :key="user.id"
                            class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
                            :class="index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-900' : ''">
                            <td class="w-12 p-3 font-medium text-gray-800 dark:text-gray-200">
                                {{ index + 1 }}
                            </td>
                            <th scope="row"
                                class="px-5 py-2 font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                {{ user.name }}
                            </th>
                            <td class="px-5 py-2">{{ user.email }}</td>
                            <td class="px-5 py-2">{{ formatDateTime(user.created_at) }}</td>
                            <td class="px-5 py-2">
                                <Button variant="outline" @click="openEditSheet(user)">
                                    Edit
                                </Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <Pagination :pagination="props.users" />

            <!-- Edit Sheet -->
            <Sheet v-model:open="isSheetOpen">
                <SheetContent>
                    <SheetHeader>
                        <SheetTitle>Edit profile</SheetTitle>
                        <SheetDescription>
                            Make changes to your profile here. Click save when you're done.
                        </SheetDescription>
                    </SheetHeader>

                    <form @submit.prevent="saveChanges" class="grid gap-4 py-4 px-4">
                        <div class="grid grid-cols-4 items-center gap-4">
                            <Label for="name" class="text-right">Name</Label>
                            <Input id="name" v-model="selectedUser.name" class="col-span-3" required />
                        </div>
                        <div class="grid grid-cols-4 items-center gap-4">
                            <Label for="email" class="text-right">Email</Label>
                            <Input id="email" type="email" v-model="selectedUser.email" class="col-span-3" required />
                        </div>

                        <SheetFooter class="flex justify-end gap-2">
                            <SheetClose asChild>
                                <Button type="button" variant="outline" @click="cancelEdit">
                                    Cancel
                                </Button>
                            </SheetClose>
                            <SheetClose asChild>
                                <Button type="submit">
                                    Save changes
                                </Button>
                            </SheetClose>
                        </SheetFooter>
                    </form>
                </SheetContent>
            </Sheet>
        </div>
    </AppLayout>
</template>
