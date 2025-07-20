<script setup lang="ts">
import type { DateRange } from 'reka-ui'
import { getLocalTimeZone, today } from '@internationalized/date'
import { ref, computed } from 'vue'
import { RangeCalendar } from '@/components/ui/range-calendar'
import { Popover, PopoverTrigger, PopoverContent } from '@/components/ui/popover'
import { Button } from '@/components/ui/button'
import { CalendarIcon } from 'lucide-vue-next'
import { toDate } from 'reka-ui/date'

const tz = getLocalTimeZone()
const start = today(tz)
const end = start.add({ days: 7 })

const tempRange = ref<DateRange>({ start, end })
const appliedRange = ref<DateRange>({ start, end })

const startTime = ref('09:00')
const endTime = ref('18:00')

const formatted = computed(() => {
    const formatDateTime = (date: any, time: string) => {
        const [h, m] = time.split(':')
        const d = new Date(toDate(date))
        d.setHours(Number(h), Number(m))
        return d.toLocaleString('en-GB', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        })
    }

    return `${formatDateTime(appliedRange.value.start, startTime.value)} → ${formatDateTime(appliedRange.value.end, endTime.value)}`
})

const isOpen = ref(false)

function applyRange() {
    appliedRange.value = { ...tempRange.value }
    isOpen.value = false
}

function cancelRange() {
    tempRange.value = { ...appliedRange.value }
    isOpen.value = false
}
</script>
<template>
    <Popover v-model:open="isOpen">
        <PopoverTrigger as-child>
            <Button variant="outline" class="w-[360px] justify-start text-left font-normal">
                <CalendarIcon class="me-2 h-4 w-4" />
                <span>{{ formatted }}</span>
            </Button>
        </PopoverTrigger>

        <PopoverContent class="p-4 w-[680px] rounded-xl shadow-lg border bg-white space-y-4">
            <!-- Calendar -->
            <div class="rounded-lg border p-4">
                <RangeCalendar v-model="tempRange" :min-value="today(getLocalTimeZone())" :number-of-months="2"
                    class="w-full" />
            </div>

            <!-- Time Inputs -->
            <!-- Time Inputs -->
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-700">Start Time</label>
                    <input type="time" v-model="startTime"
                        class="border border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-md px-3 py-2 text-sm shadow-sm" />
                </div>
                <div class="flex flex-col space-y-1">
                    <label class="text-sm font-medium text-gray-700">End Time</label>
                    <input type="time" v-model="endTime"
                        class="border border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 rounded-md px-3 py-2 text-sm shadow-sm" />
                </div>
            </div>


            <!-- Buttons -->
            <div class="flex justify-end gap-3 pt-3 border-t mt-4">
                <Button variant="ghost" @click="cancelRange">Cancel</Button>
                <Button @click="applyRange">Apply</Button>
            </div>
        </PopoverContent>
    </Popover>
</template>
