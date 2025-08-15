<template>
    <div class="inline-flex items-center gap-2">
        <DropdownMenu>
            <DropdownMenuTrigger as-child>
                <Button variant="outline" class="min-w-56 justify-between">
                    <span class="truncate">{{ label }}</span>
                    <ChevronDown class="h-4 w-4 opacity-70" />
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent class="w-56 p-1">
                <DropdownMenuItem @select="applyPreset('today')">Today</DropdownMenuItem>
                <DropdownMenuItem @select="applyPreset('yesterday')">Yesterday</DropdownMenuItem>
                <DropdownMenuItem @select="applyPreset('last7')">Last 7 days</DropdownMenuItem>
                <DropdownMenuItem @select="applyPreset('last30')">Last 30 days</DropdownMenuItem>
                <DropdownMenuItem @select="applyPreset('thisMonth')">This month</DropdownMenuItem>
                <DropdownMenuItem @select="applyPreset('lastMonth')">Last month</DropdownMenuItem>
                <DropdownMenuSeparator />
                <!-- Custom Range opens a popover with date inputs -->
                <Popover v-model:open="customOpen">
                    <PopoverTrigger as-child>
                        <!-- as-child ensures the click goes to Popover, not DropdownMenu -->
                        <DropdownMenuItem @select.prevent>
                            Custom range…
                        </DropdownMenuItem>
                    </PopoverTrigger>
                    <PopoverContent align="start" class="w-80">
                        <div class="grid gap-3">
                            <div class="grid grid-cols-2 gap-3">
                                <div class="grid gap-1">
                                    <label class="text-xs text-muted-foreground">Start date</label>
                                    <Input type="date" v-model="custom.start" />
                                </div>
                                <div class="grid gap-1">
                                    <label class="text-xs text-muted-foreground">End date</label>
                                    <Input type="date" v-model="custom.end" />
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <Button variant="ghost" size="sm" @click="resetCustom">Clear</Button>
                                <div class="flex items-center gap-2">
                                    <Button variant="outline" size="sm" @click="customOpen = false">Cancel</Button>
                                    <Button size="sm" @click="applyCustom">Apply</Button>
                                </div>
                            </div>
                        </div>
                    </PopoverContent>
                </Popover>
            </DropdownMenuContent>
        </DropdownMenu>
    </div>
</template>

<script setup lang="ts">
import { computed, reactive, ref, watch } from 'vue'

// shadcn-vue components (install: npm i shadcn-vue @radix-icons/vue -D)
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu'
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover'
import { ChevronDown } from 'lucide-vue-next'

/**
 * v-model usage
 * <DateFilterDropdown v-model="range" />
 * where range is { start: string|Date, end: string|Date }
 */

type Range = { start: Date | null; end: Date | null }

const props = defineProps<{
    /** initial range (v-model) */
    modelValue?: { start?: string | Date | null; end?: string | Date | null }
    /** include time boundaries to full-day span */
    fullDay?: boolean
    /** date format for the label (YYYY-MM-DD by default) */
    format?: string
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', value: { start: Date | null; end: Date | null }): void
    (e: 'change', value: { start: Date | null; end: Date | null }): void
}>()

const state = reactive<Range>({ start: null, end: null })

// local state for custom range popover
const customOpen = ref(false)
// const custom = reactive<{ start: string | null; end: string | null }>({ start: null, end: null })
const custom = reactive<{ start?: string; end?: string }>({ start: undefined, end: undefined })

watch(
    () => props.modelValue,
    (val) => {
        if (val) {
            state.start = val.start ? toDate(val.start) : null
            state.end = val.end ? toDate(val.end) : null
            // sync custom inputs so they reflect external changes
            // custom.start = state.start ? toISODate(state.start) : null
            // custom.end = state.end ? toISODate(state.end) : null
            custom.start = state.start ? toISODate(state.start) : undefined
            custom.end = state.end ? toISODate(state.end) : undefined

        }
    },
    { immediate: true }
)

const label = computed(() => {
    if (!state.start && !state.end) return 'Select date range'
    const f = (d: Date | null) => (d ? formatDate(d, props.format) : '…')
    return `${f(state.start)} → ${f(state.end)}`
})

function applyPreset(kind: 'today' | 'yesterday' | 'last7' | 'last30' | 'thisMonth' | 'lastMonth') {
    const now = new Date()
    let start: Date, end: Date
    switch (kind) {
        case 'today':
            start = startOfDay(now)
            end = endOfDay(now)
            break
        case 'yesterday': {
            const y = addDays(startOfDay(now), -1)
            start = y
            end = endOfDay(y)
            break
        }
        case 'last7':
            end = endOfDay(now)
            start = addDays(end, -6)
            start = startOfDay(start)
            break
        case 'last30':
            end = endOfDay(now)
            start = addDays(end, -29)
            start = startOfDay(start)
            break
        case 'thisMonth': {
            const first = new Date(now.getFullYear(), now.getMonth(), 1)
            const last = endOfDay(new Date(now.getFullYear(), now.getMonth() + 1, 0))
            start = startOfDay(first)
            end = last
            break
        }
        case 'lastMonth': {
            const first = new Date(now.getFullYear(), now.getMonth() - 1, 1)
            const lastDay = new Date(now.getFullYear(), now.getMonth(), 0)
            start = startOfDay(first)
            end = endOfDay(lastDay)
            break
        }
    }
    setRange(start, end)
}

function applyCustom() {
    const s = custom.start ? new Date(custom.start) : null
    const e = custom.end ? new Date(custom.end) : null
    setRange(s, e)
    customOpen.value = false
}

function resetCustom() {
    custom.start = undefined
    custom.end = undefined
}


function setRange(start: Date | null, end: Date | null) {
    if (start && end && start > end) {
        // swap if user picked reversed
        ;[start, end] = [end, start]
    }
    if (props.fullDay) {
        if (start) start = startOfDay(start)
        if (end) end = endOfDay(end)
    }
    state.start = start
    state.end = end
    emit('update:modelValue', { start, end })
    emit('change', { start, end })
}

/* ---------------- utils ---------------- */
function startOfDay(d: Date) {
    const x = new Date(d)
    x.setHours(0, 0, 0, 0)
    return x
}
function endOfDay(d: Date) {
    const x = new Date(d)
    x.setHours(23, 59, 59, 999)
    return x
}
function addDays(d: Date, days: number) {
    const x = new Date(d)
    x.setDate(x.getDate() + days)
    return x
}
function toDate(v: string | Date) {
    return v instanceof Date ? v : new Date(v)
}
function toISODate(d: Date) {
    // yyyy-mm-dd for <input type="date">
    const m = String(d.getMonth() + 1).padStart(2, '0')
    const day = String(d.getDate()).padStart(2, '0')
    return `${d.getFullYear()}-${m}-${day}`
}
function formatDate(d: Date, fmt = 'YYYY-MM-DD') {
    // very light formatter for common tokens; replace with dayjs/date-fns if you prefer
    if (fmt === 'YYYY-MM-DD') {
        return toISODate(d)
    }
    // fallback to locale string
    return d.toLocaleDateString()
}
</script>

<style scoped>
/* Optional: tighten dropdown item height slightly */
[data-radix-dropdown-menu-content] .dropdown-menu__item {
    line-height: 1.2;
}
</style>
