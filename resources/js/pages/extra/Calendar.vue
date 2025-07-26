<script setup lang="ts">
import { CalendarDate, DateFormatter, getLocalTimeZone, parseDate, today } from '@internationalized/date'
import { CalendarIcon } from 'lucide-vue-next'
import { toDate } from 'reka-ui/date'
import { computed, ref } from 'vue'
import { cn } from '@/utils'
import { Button } from '@/components/ui/button'
import { Calendar } from '@/components/ui/calendar'
import {
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from '@/components/ui/form'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { toast } from 'vue-sonner'

const df = new DateFormatter('en-US', {
    dateStyle: 'long',
})

// form state
const dob = ref<string | undefined>(undefined)
const error = ref<string | null>(null)
const placeholder = ref()

// used to control calendar display
const value = computed({
    get: () => dob.value ? parseDate(dob.value) : undefined,
    set: val => {
        dob.value = val?.toString()
    },
})

const onSubmit = () => {
    if (!dob.value) {
        error.value = 'A date of birth is required.'
        return
    }

    error.value = null

    toast('The form has been submitted', {
        description: dob.value,
        action: {
            label: 'Undo',
            onClick: () => console.log(JSON.stringify({ dob: dob.value })),
        },
    })
}
</script>

<template>
    <form class="space-y-8" @submit.prevent="onSubmit">
        <FormField name="dob">
            <FormItem class="flex flex-col">
                <FormLabel>Date of birth</FormLabel>
                <Popover>
                    <PopoverTrigger as-child>
                        <FormControl>
                            <Button variant="outline" :class="cn(
                                'w-[240px] ps-3 text-start font-normal',
                                !value && 'text-muted-foreground',
                            )">
                                <span>{{ value ? df.format(toDate(value)) : "Pick a date" }}</span>
                                <CalendarIcon class="ms-auto h-4 w-4 opacity-50" />
                            </Button>
                            <input type="hidden" :value="dob" />
                        </FormControl>
                    </PopoverTrigger>
                    <PopoverContent class="w-auto p-0">
                        <Calendar v-model:placeholder="placeholder" :model-value="value" calendar-label="Date of birth"
                            initial-focus :min-value="new CalendarDate(1900, 1, 1)"
                            :max-value="today(getLocalTimeZone())" @update:model-value="(v) => {
                                dob = v ? v.toString() : undefined
                            }" />
                    </PopoverContent>
                </Popover>
                <FormDescription>
                    Your date of birth is used to calculate your age.
                </FormDescription>
                <FormMessage v-if="error" class="text-red-500 text-sm mt-1">
                    {{ error }}
                </FormMessage>
            </FormItem>
        </FormField>
        <Button type="submit">
            Submit
        </Button>
    </form>
</template>
