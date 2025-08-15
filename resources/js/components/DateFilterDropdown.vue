<script setup lang="ts">
import type { DateValue } from "@internationalized/date"
import type { DateRange } from "reka-ui"
import type { Grid } from "reka-ui/date"
import type { Ref } from "vue"

import {
    CalendarDate,
    isEqualMonth,
    fromDate,
    getLocalTimeZone,
} from "@internationalized/date"

import { ref, watch } from "vue"

import {
    Calendar,
    ChevronLeft,
    ChevronRight,
} from "lucide-vue-next"

import { RangeCalendarRoot, useDateFormatter } from "reka-ui"
import { createMonth, toDate } from "reka-ui/date"

import { cn } from "@/utils"
import { Button, buttonVariants } from "@/components/ui/button"
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover"
import {
    RangeCalendarCell,
    RangeCalendarCellTrigger,
    RangeCalendarGrid,
    RangeCalendarGridBody,
    RangeCalendarGridHead,
    RangeCalendarGridRow,
    RangeCalendarHeadCell,
} from "@/components/ui/range-calendar"

// date-fns (only what's needed)
import {
    startOfDay,
    startOfWeek,
    endOfWeek,
    startOfMonth,
    endOfMonth,
    subDays,
    subWeeks,
    subMonths,
} from "date-fns"

/* -------------------- State -------------------- */
type PresetKey = "today" | "yesterday" | "thisWeek" | "lastWeek" | "lastMonth" | "last3Months"

const TZ = getLocalTimeZone()
const WEEK_START = 0 // Sunday to match your calendar config

const todayJS = new Date()

const value = ref<DateRange>({
    start: fromDate(startOfDay(todayJS), TZ) as unknown as CalendarDate,
    end: fromDate(startOfDay(todayJS), TZ) as unknown as CalendarDate,
})

const activePreset = ref<null | PresetKey>("today")

const locale = ref("en-US")
const formatter = useDateFormatter(locale.value)

const placeholder = ref(value.value.start) as Ref<DateValue>
const secondMonthPlaceholder = ref(value.value.end) as Ref<DateValue>

const firstMonth = ref(
    createMonth({
        dateObj: placeholder.value,
        locale: locale.value,
        fixedWeeks: true,
        weekStartsOn: WEEK_START,
    }),
) as Ref<Grid<DateValue>>

const secondMonth = ref(
    createMonth({
        dateObj: secondMonthPlaceholder.value,
        locale: locale.value,
        fixedWeeks: true,
        weekStartsOn: WEEK_START,
    }),
) as Ref<Grid<DateValue>>

/* -------------------- Month Nav -------------------- */
function updateMonth(reference: "first" | "second", months: number) {
    if (reference === "first") {
        placeholder.value = (placeholder.value as CalendarDate).add({ months })
    } else {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months })
    }
}

watch(placeholder, (_p) => {
    firstMonth.value = createMonth({
        dateObj: _p,
        weekStartsOn: WEEK_START,
        fixedWeeks: false,
        locale: locale.value,
    })
    if (isEqualMonth(secondMonthPlaceholder.value as CalendarDate, _p as CalendarDate)) {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months: 1 })
    }
})

watch(secondMonthPlaceholder, (_s) => {
    secondMonth.value = createMonth({
        dateObj: _s,
        weekStartsOn: WEEK_START,
        fixedWeeks: false,
        locale: locale.value,
    })
    if (isEqualMonth(_s as CalendarDate, placeholder.value as CalendarDate)) {
        placeholder.value = (placeholder.value as CalendarDate).subtract({ months: 1 })
    }
})

/* -------------------- Quick Ranges -------------------- */
function toCD(d: Date) {
    return fromDate(startOfDay(d), TZ) as unknown as CalendarDate
}
function setRange(startJS: Date, endJS: Date, preset: PresetKey | null) {
    value.value = { start: toCD(startJS), end: toCD(endJS) }
    placeholder.value = value.value.start
    secondMonthPlaceholder.value = value.value.end
    activePreset.value = preset
}

function applyPreset(preset: PresetKey) {
    const now = new Date()
    switch (preset) {
        case "today": {
            setRange(now, now, "today")
            break
        }
        case "yesterday": {
            const y = subDays(now, 1)
            setRange(y, y, "yesterday")
            break
        }
        case "thisWeek": {
            const start = startOfWeek(now, { weekStartsOn: WEEK_START })
            // end = today (to-date)
            setRange(start, now, "thisWeek")
            break
        }
        case "lastWeek": {
            const start = startOfWeek(subWeeks(now, 1), { weekStartsOn: WEEK_START })
            const end = endOfWeek(subWeeks(now, 1), { weekStartsOn: WEEK_START })
            setRange(start, end, "lastWeek")
            break
        }
        case "lastMonth": {
            const start = startOfMonth(subMonths(now, 1))
            const end = endOfMonth(subMonths(now, 1))
            setRange(start, end, "lastMonth")
            break
        }
        case "last3Months": {
            // from first day of the month two months ago → today (to-date)
            const start = startOfMonth(subMonths(now, 2))
            setRange(start, now, "last3Months")
            break
        }
    }
}

/* -------------------- Detection (keeps highlight on reopen) -------------------- */
function detectPresetFromValue(): PresetKey | null {
    if (!value.value?.start || !value.value?.end) return null

    const startJS = startOfDay(toDate(value.value.start))
    const endJS = startOfDay(toDate(value.value.end))
    const today = startOfDay(new Date())

    const eq = (a: Date, b: Date) => a.getTime() === b.getTime()

    // Today / Yesterday
    if (eq(startJS, today) && eq(endJS, today)) return "today"
    const y = subDays(today, 1)
    if (eq(startJS, y) && eq(endJS, y)) return "yesterday"

    // This Week (startOfWeek -> today)
    const thisWeekStart = startOfWeek(today, { weekStartsOn: WEEK_START })
    if (eq(startJS, thisWeekStart) && eq(endJS, today)) return "thisWeek"

    // Last Week (full week)
    const lastWeekStart = startOfWeek(subWeeks(today, 1), { weekStartsOn: WEEK_START })
    const lastWeekEnd = endOfWeek(subWeeks(today, 1), { weekStartsOn: WEEK_START })
    if (eq(startJS, lastWeekStart) && eq(endJS, lastWeekEnd)) return "lastWeek"

    // Last Month (full month)
    const lastMonthStart = startOfMonth(subMonths(today, 1))
    const lastMonthEnd = endOfMonth(subMonths(today, 1))
    if (eq(startJS, lastMonthStart) && eq(endJS, lastMonthEnd)) return "lastMonth"

    // Last 3 Months (to-date)
    const threeMonthStart = startOfMonth(subMonths(today, 2))
    if (eq(startJS, threeMonthStart) && eq(endJS, today)) return "last3Months"

    return null
}

// Keep activePreset in sync always (mount + any change)
watch(
    value,
    () => {
        activePreset.value = detectPresetFromValue()
    },
    { immediate: true, deep: true },
)
</script>

<template>
    <Popover>
        <PopoverTrigger as-child>
            <Button variant="outline"
                :class="cn('w-[320px] justify-start text-left font-normal', !value && 'text-muted-foreground')">
                <Calendar class="mr-2 h-4 w-4" />
                <template v-if="value?.start">
                    <template v-if="value?.end">
                        {{
                            formatter.custom(toDate(value.start), { dateStyle: 'medium' })
                        }}
                        -
                        {{
                            formatter.custom(toDate(value.end), { dateStyle: 'medium' })
                        }}
                    </template>
                    <template v-else>
                        {{ formatter.custom(toDate(value.start), { dateStyle: 'medium' }) }}
                    </template>
                </template>
                <template v-else> Pick a date </template>
            </Button>
        </PopoverTrigger>

        <PopoverContent class="w-auto p-0">
            <div class="flex">
                <!-- Quick ranges -->
                <div class="w-48 border-r p-3 space-y-2">
                    <div class="text-xs uppercase tracking-wide text-muted-foreground mb-2">Quick ranges</div>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'today' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('today')">
                        Today
                    </Button>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'yesterday' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('yesterday')">
                        Yesterday
                    </Button>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'thisWeek' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('thisWeek')">
                        This Week
                    </Button>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'lastWeek' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('lastWeek')">
                        Last Week
                    </Button>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'lastMonth' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('lastMonth')">
                        Last Month
                    </Button>

                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'last3Months' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('last3Months')">
                        Last 3 Months
                    </Button>

                    <div class="pt-1 text-xs text-muted-foreground">Or pick a custom range →</div>
                </div>

                <!-- Calendars -->
                <RangeCalendarRoot v-slot="{ weekDays }" v-model="value" v-model:placeholder="placeholder" class="p-3">
                    <div class="flex flex-col gap-y-4 mt-4 sm:flex-row sm:gap-x-4 sm:gap-y-0">
                        <!-- First month -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <button :class="cn(
                                    buttonVariants({ variant: 'outline' }),
                                    'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100',
                                )" @click="updateMonth('first', -1)">
                                    <ChevronLeft class="h-4 w-4" />
                                </button>
                                <div class="text-sm font-medium">
                                    {{ formatter.fullMonthAndYear(toDate(firstMonth.value)) }}
                                </div>
                                <button :class="cn(
                                    buttonVariants({ variant: 'outline' }),
                                    'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100',
                                )" @click="updateMonth('first', 1)">
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
                                        :key="`weekDate-${index}`" class="mt-2 w-full">
                                        <RangeCalendarCell v-for="weekDate in weekDates" :key="weekDate.toString()"
                                            :date="weekDate">
                                            <RangeCalendarCellTrigger :day="weekDate" :month="firstMonth.value" />
                                        </RangeCalendarCell>
                                    </RangeCalendarGridRow>
                                </RangeCalendarGridBody>
                            </RangeCalendarGrid>
                        </div>

                        <!-- Second month -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <button :class="cn(
                                    buttonVariants({ variant: 'outline' }),
                                    'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100',
                                )" @click="updateMonth('second', -1)">
                                    <ChevronLeft class="h-4 w-4" />
                                </button>
                                <div class="text-sm font-medium">
                                    {{ formatter.fullMonthAndYear(toDate(secondMonth.value)) }}
                                </div>
                                <button :class="cn(
                                    buttonVariants({ variant: 'outline' }),
                                    'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100',
                                )" @click="updateMonth('second', 1)">
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
                                        :key="`weekDate-${index}`" class="mt-2 w-full">
                                        <RangeCalendarCell v-for="weekDate in weekDates" :key="weekDate.toString()"
                                            :date="weekDate">
                                            <RangeCalendarCellTrigger :day="weekDate" :month="secondMonth.value" />
                                        </RangeCalendarCell>
                                    </RangeCalendarGridRow>
                                </RangeCalendarGridBody>
                            </RangeCalendarGrid>
                        </div>
                    </div>
                </RangeCalendarRoot>
            </div>
        </PopoverContent>
    </Popover>
</template>
