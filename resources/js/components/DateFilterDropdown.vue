<script setup lang="ts">
/**
 * Optimized Date Range Component (Vue 3 + reka-ui RangeCalendar + date-fns)
 * Improvements: Performance, maintainability, type safety, and UX
 */

import { ref, computed, watch, shallowRef } from "vue"
import type { Ref } from "vue"
import type { DateValue } from "@internationalized/date"
import { CalendarDate, isEqualMonth } from "@internationalized/date"

import { RangeCalendarRoot, useDateFormatter } from "reka-ui"
import { createMonth, toDate } from "reka-ui/date"
import type { Grid } from "reka-ui/date"
import type { DateRange } from "reka-ui"

import { Button, buttonVariants } from "@/components/ui/button"
import { Popover, PopoverTrigger, PopoverContent } from "@/components/ui/popover"
import {
    RangeCalendarCell,
    RangeCalendarCellTrigger,
    RangeCalendarGrid,
    RangeCalendarGridBody,
    RangeCalendarGridHead,
    RangeCalendarGridRow,
    RangeCalendarHeadCell,
} from "@/components/ui/range-calendar"

import { Calendar, ChevronLeft, ChevronRight } from "lucide-vue-next"
import { cn } from "@/utils"

// date-fns - only import what we need
import {
    isSameDay,
    startOfWeek,
    endOfWeek,
    startOfMonth,
    endOfMonth,
    subDays,
    subWeeks,
    subMonths,
} from "date-fns"

/* -------------------- Constants -------------------- */
const WEEK_START = 0 as const // Sunday
const LOCALE = "en-US" as const

/* -------------------- Types -------------------- */
type PresetKey = "today" | "yesterday" | "thisWeek" | "lastWeek" | "lastMonth" | "last3Months"

interface PresetConfig {
    label: string
    key: PresetKey
    getRange: () => { start: Date; end: Date }
}

/* -------------------- Utility Functions -------------------- */
const dateUtils = {
    /** Convert JS Date to CalendarDate */
    toCalendarDate: (date: Date): CalendarDate =>
        new CalendarDate(date.getFullYear(), date.getMonth() + 1, date.getDate()),

    /** Convert CalendarDate to JS Date */
    toJSDate: (calendarDate: DateValue): Date => toDate(calendarDate),

    /** Check if two dates are the same day */
    isSameDay: (date1: Date, date2: Date): boolean => isSameDay(date1, date2),
}

/* -------------------- Preset Configuration -------------------- */
const presetConfigs: PresetConfig[] = [
    {
        label: "Today",
        key: "today",
        getRange: () => {
            const now = new Date()
            return { start: now, end: now }
        }
    },
    {
        label: "Yesterday",
        key: "yesterday",
        getRange: () => {
            const yesterday = subDays(new Date(), 1)
            return { start: yesterday, end: yesterday }
        }
    },
    {
        label: "This Week",
        key: "thisWeek",
        getRange: () => {
            const now = new Date()
            const start = startOfWeek(now, { weekStartsOn: WEEK_START })
            return { start, end: now }
        }
    },
    {
        label: "Last Week",
        key: "lastWeek",
        getRange: () => {
            const lastWeek = subWeeks(new Date(), 1)
            const start = startOfWeek(lastWeek, { weekStartsOn: WEEK_START })
            const end = endOfWeek(lastWeek, { weekStartsOn: WEEK_START })
            return { start, end }
        }
    },
    {
        label: "Last Month",
        key: "lastMonth",
        getRange: () => {
            const lastMonth = subMonths(new Date(), 1)
            const start = startOfMonth(lastMonth)
            const end = endOfMonth(lastMonth)
            return { start, end }
        }
    },
    {
        label: "Last 3 Months",
        key: "last3Months",
        getRange: () => {
            const now = new Date()
            const start = startOfMonth(subMonths(now, 2))
            return { start, end: now }
        }
    }
]

/* -------------------- Reactive State -------------------- */
const today = new Date()
const initialDate = dateUtils.toCalendarDate(today)

// Use shallowRef for better performance with large objects
const value = ref<DateRange>({
    start: initialDate,
    end: initialDate,
}) as Ref<DateRange>

// Temporary state for draft selection
const tempValue = ref<DateRange>({
    start: initialDate,
    end: initialDate,
}) as Ref<DateRange>

const isOpen = ref(false)

const placeholder = ref(tempValue.value.start) as Ref<DateValue>
const secondMonthPlaceholder = ref(tempValue.value.end) as Ref<DateValue>
const activePreset = ref<PresetKey | null>("today")

// Use shallowRef for calendar grids since they're complex objects that don't need deep reactivity
const firstMonth = shallowRef<Grid<DateValue>>(
    createMonth({
        dateObj: placeholder.value,
        locale: LOCALE,
        fixedWeeks: false,
        weekStartsOn: WEEK_START,
    })
)

const secondMonth = shallowRef<Grid<DateValue>>(
    createMonth({
        dateObj: secondMonthPlaceholder.value,
        locale: LOCALE,
        fixedWeeks: false,
        weekStartsOn: WEEK_START,
    })
)

const formatter = useDateFormatter(LOCALE)

/* -------------------- Computed Properties -------------------- */
const displayText = computed(() => {
    if (!value.value?.start) return "Pick a date"

    const startText = formatter.custom(dateUtils.toJSDate(value.value.start), { dateStyle: 'medium' })

    if (!value.value.end) return startText

    const endText = formatter.custom(dateUtils.toJSDate(value.value.end), { dateStyle: 'medium' })
    return `${startText} - ${endText}`
})

const buttonClasses = computed(() =>
    cn('w-[320px] justify-start text-left font-normal', !value.value && 'text-muted-foreground')
)

/* -------------------- Core Functions -------------------- */
function updateCalendarMonth(reference: "first" | "second", months: number): void {
    if (reference === "first") {
        placeholder.value = (placeholder.value as CalendarDate).add({ months })
    } else {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months })
    }
}

function setTempDateRange(startJS: Date, endJS: Date, preset: PresetKey | null = null): void {
    const newRange = {
        start: dateUtils.toCalendarDate(startJS),
        end: dateUtils.toCalendarDate(endJS)
    }

    tempValue.value = newRange
    placeholder.value = newRange.start
    secondMonthPlaceholder.value = newRange.end
    activePreset.value = preset
}

function applyChanges(): void {
    value.value = { ...tempValue.value }
    isOpen.value = false
}

function cancelChanges(): void {
    // Reset temp values to current values
    tempValue.value = { ...value.value }
    placeholder.value = tempValue.value.start!
    secondMonthPlaceholder.value = tempValue.value.end!
    activePreset.value = detectActivePreset()
    isOpen.value = false
}

function onOpenChange(open: boolean): void {
    isOpen.value = open
    if (open) {
        // Initialize temp values when opening
        tempValue.value = { ...value.value }
        placeholder.value = tempValue.value.start!
        secondMonthPlaceholder.value = tempValue.value.end!
        activePreset.value = detectActivePreset()
    }
}

function applyPreset(preset: PresetKey): void {
    const config = presetConfigs.find(p => p.key === preset)
    if (!config) return

    const { start, end } = config.getRange()
    setTempDateRange(start, end, preset)
}

/* -------------------- Preset Detection -------------------- */
function detectActivePreset(): PresetKey | null {
    if (!tempValue.value?.start || !tempValue.value?.end) return null

    const startJS = dateUtils.toJSDate(tempValue.value.start)
    const endJS = dateUtils.toJSDate(tempValue.value.end)

    // Find matching preset by comparing with current ranges
    for (const config of presetConfigs) {
        const { start: presetStart, end: presetEnd } = config.getRange()
        if (dateUtils.isSameDay(startJS, presetStart) && dateUtils.isSameDay(endJS, presetEnd)) {
            return config.key
        }
    }

    return null
}

/* -------------------- Watchers -------------------- */
// Optimize watchers to prevent unnecessary recalculations
watch(placeholder, (newPlaceholder) => {
    firstMonth.value = createMonth({
        dateObj: newPlaceholder,
        weekStartsOn: WEEK_START,
        fixedWeeks: false,
        locale: LOCALE,
    })

    // Prevent months from overlapping
    if (isEqualMonth(secondMonthPlaceholder.value as CalendarDate, newPlaceholder as CalendarDate)) {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months: 1 })
    }
}, { flush: 'post' })

watch(secondMonthPlaceholder, (newSecondPlaceholder) => {
    secondMonth.value = createMonth({
        dateObj: newSecondPlaceholder,
        weekStartsOn: WEEK_START,
        fixedWeeks: false,
        locale: LOCALE,
    })

    // Prevent months from overlapping
    if (isEqualMonth(newSecondPlaceholder as CalendarDate, placeholder.value as CalendarDate)) {
        placeholder.value = (placeholder.value as CalendarDate).subtract({ months: 1 })
    }
}, { flush: 'post' })

// Watch for preset detection
watch(
    tempValue,
    () => {
        activePreset.value = detectActivePreset()
    },
    { immediate: true, deep: true }
)
</script>

<template>
    <Popover v-model:open="isOpen" @update:open="onOpenChange">
        <PopoverTrigger as-child>
            <Button variant="outline" :class="buttonClasses">
                <Calendar class="mr-2 h-4 w-4" />
                {{ displayText }}
            </Button>
        </PopoverTrigger>

        <PopoverContent class="w-auto p-0">
            <div class="flex flex-col">
                <div class="flex">
                    <!-- Quick Ranges Sidebar -->
                    <div class="w-48 border-r p-3 space-y-2">
                        <div class="text-xs uppercase tracking-wide text-muted-foreground mb-2">
                            Quick ranges
                        </div>

                        <Button v-for="preset in presetConfigs" :key="preset.key" variant="ghost"
                            class="w-full justify-start"
                            :class="activePreset === preset.key && 'bg-primary text-primary-foreground font-medium'"
                            @click="applyPreset(preset.key)">
                            {{ preset.label }}
                        </Button>

                        <div class="pt-1 text-xs text-muted-foreground">
                            Or pick a custom range →
                        </div>
                    </div>

                    <!-- Dual Calendar View -->
                    <RangeCalendarRoot v-slot="{ weekDays }" v-model="tempValue" v-model:placeholder="placeholder"
                        class="p-3">
                        <div class="flex flex-col gap-y-4 mt-4 sm:flex-row sm:gap-x-4 sm:gap-y-0">
                            <!-- First Month -->
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <button
                                        :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                        @click="updateCalendarMonth('first', -1)" aria-label="Previous month">
                                        <ChevronLeft class="h-4 w-4" />
                                    </button>

                                    <div class="text-sm font-medium">
                                        {{ formatter.fullMonthAndYear(toDate(firstMonth.value)) }}
                                    </div>

                                    <button
                                        :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                        @click="updateCalendarMonth('first', 1)" aria-label="Next month">
                                        <ChevronRight class="h-4 w-4" />
                                    </button>
                                </div>

                                <RangeCalendarGrid>
                                    <RangeCalendarGridHead>
                                        <RangeCalendarGridRow>
                                            <RangeCalendarHeadCell v-for="day in weekDays" :key="day" class="w-full">
                                                {{ day }}
                                            </RangeCalendarHeadCell>
                                        </RangeCalendarGridRow>
                                    </RangeCalendarGridHead>
                                    <RangeCalendarGridBody>
                                        <RangeCalendarGridRow v-for="(weekDates, index) in firstMonth.rows"
                                            :key="`first-week-${index}`" class="mt-2 w-full">
                                            <RangeCalendarCell v-for="weekDate in weekDates"
                                                :key="`first-${weekDate.toString()}`" :date="weekDate">
                                                <RangeCalendarCellTrigger :day="weekDate" :month="firstMonth.value" />
                                            </RangeCalendarCell>
                                        </RangeCalendarGridRow>
                                    </RangeCalendarGridBody>
                                </RangeCalendarGrid>
                            </div>

                            <!-- Second Month -->
                            <div class="flex flex-col gap-4">
                                <div class="flex items-center justify-between">
                                    <button
                                        :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                        @click="updateCalendarMonth('second', -1)" aria-label="Previous month">
                                        <ChevronLeft class="h-4 w-4" />
                                    </button>

                                    <div class="text-sm font-medium">
                                        {{ formatter.fullMonthAndYear(toDate(secondMonth.value)) }}
                                    </div>

                                    <button
                                        :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                        @click="updateCalendarMonth('second', 1)" aria-label="Next month">
                                        <ChevronRight class="h-4 w-4" />
                                    </button>
                                </div>

                                <RangeCalendarGrid>
                                    <RangeCalendarGridHead>
                                        <RangeCalendarGridRow>
                                            <RangeCalendarHeadCell v-for="day in weekDays" :key="day" class="w-full">
                                                {{ day }}
                                            </RangeCalendarHeadCell>
                                        </RangeCalendarGridRow>
                                    </RangeCalendarGridHead>
                                    <RangeCalendarGridBody>
                                        <RangeCalendarGridRow v-for="(weekDates, index) in secondMonth.rows"
                                            :key="`second-week-${index}`" class="mt-2 w-full">
                                            <RangeCalendarCell v-for="weekDate in weekDates"
                                                :key="`second-${weekDate.toString()}`" :date="weekDate">
                                                <RangeCalendarCellTrigger :day="weekDate" :month="secondMonth.value" />
                                            </RangeCalendarCell>
                                        </RangeCalendarGridRow>
                                    </RangeCalendarGridBody>
                                </RangeCalendarGrid>
                            </div>
                        </div>
                    </RangeCalendarRoot>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-2 p-3 border-t bg-muted/20">
                    <Button variant="outline" size="sm" @click="cancelChanges">
                        Cancel
                    </Button>
                    <Button size="sm" @click="applyChanges" :disabled="!tempValue?.start || !tempValue?.end">
                        Apply
                    </Button>
                </div>
            </div>
        </PopoverContent>
    </Popover>
</template>
