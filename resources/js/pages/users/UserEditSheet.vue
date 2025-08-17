<script setup lang="ts">
import {
    Sheet, SheetContent, SheetHeader, SheetTitle, SheetDescription, SheetFooter, SheetClose
} from "@/components/ui/sheet"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Button } from "@/components/ui/button"
import type { User } from "@/types/user"
import { ref, watch } from "vue"

// ✅ two-way binding for open
const open = defineModel<boolean>('open')

const props = defineProps<{ user: User }>()
const emit = defineEmits<{
    (e: "save", user: User): void
    (e: "cancel"): void
}>()

// ✅ make a local copy of the user
const localUser = ref<User>({ ...props.user })

// keep local copy in sync when prop changes
watch(() => props.user, (val) => {
    localUser.value = { ...val }
}, { deep: true })
</script>

<template>
    <Sheet v-model:open="open">
        <SheetContent>
            <SheetHeader>
                <SheetTitle>Edit profile</SheetTitle>
                <SheetDescription>Make changes to your profile here. Click save when you're done.</SheetDescription>
            </SheetHeader>

            <form @submit.prevent="emit('save', localUser)" class="grid gap-4 py-4 px-4">
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="name" class="text-right">Name</Label>
                    <Input id="name" v-model="localUser.name" class="col-span-3" required />
                </div>
                <div class="grid grid-cols-4 items-center gap-4">
                    <Label for="email" class="text-right">Email</Label>
                    <Input id="email" type="email" v-model="localUser.email" class="col-span-3" required />
                </div>

                <SheetFooter class="flex justify-end gap-2">
                    <SheetClose asChild>
                        <Button type="button" variant="outline" @click="emit('cancel')">Cancel</Button>
                    </SheetClose>
                    <SheetClose asChild>
                        <Button type="submit">Save changes</Button>
                    </SheetClose>
                </SheetFooter>
            </form>
        </SheetContent>
    </Sheet>
</template>
