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

import {
    Calendar,
    ChevronLeft,
    ChevronRight,
} from "lucide-vue-next"
import { RangeCalendarRoot, useDateFormatter } from "reka-ui"
import { createMonth, toDate } from "reka-ui/date"
import { ref, watch } from "vue"
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

/** Helpers: Date calculations */
const TZ = getLocalTimeZone()
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
function toCD(d: Date) {
    return fromDate(d, TZ) as unknown as CalendarDate
}
function addDays(d: Date, days: number) {
    const x = new Date(d)
    x.setDate(x.getDate() + days)
    return x
}
function firstDayOfMonth(d: Date) {
    return new Date(d.getFullYear(), d.getMonth(), 1)
}
function startOfWeekSunday(d: Date) {
    const day = d.getDay()
    return addDays(startOfDay(d), -day)
}

/** State */
const todayJS = new Date()
const todayCD = toCD(startOfDay(todayJS))

const value = ref<DateRange>({
    start: todayCD,
    end: todayCD,
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
        weekStartsOn: 0,
    }),
) as Ref<Grid<DateValue>>

const secondMonth = ref(
    createMonth({
        dateObj: secondMonthPlaceholder.value,
        locale: locale.value,
        fixedWeeks: true,
        weekStartsOn: 0,
    }),
) as Ref<Grid<DateValue>>

function updateMonth(reference: "first" | "second", months: number) {
    if (reference === "first") {
        placeholder.value = (placeholder.value as CalendarDate).add({ months })
    } else {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months })
    }
}

watch(placeholder, (_placeholder) => {
    firstMonth.value = createMonth({
        dateObj: _placeholder,
        weekStartsOn: 0,
        fixedWeeks: false,
        locale: locale.value,
    })
    if (isEqualMonth(secondMonthPlaceholder.value as CalendarDate, _placeholder as CalendarDate)) {
        secondMonthPlaceholder.value = (secondMonthPlaceholder.value as CalendarDate).add({ months: 1 })
    }
})
watch(secondMonthPlaceholder, (_secondMonthPlaceholder) => {
    secondMonth.value = createMonth({
        dateObj: _secondMonthPlaceholder,
        weekStartsOn: 0,
        fixedWeeks: false,
        locale: locale.value,
    })
    if (isEqualMonth(_secondMonthPlaceholder as CalendarDate, placeholder.value as CalendarDate))
        placeholder.value = (placeholder.value as CalendarDate).subtract({ months: 1 })
})

/** Presets */
type PresetKey = "today" | "yesterday" | "thisWeek" | "lastWeek" | "lastMonth" | "last3Months"

function setRange(startJS: Date, endJS: Date, preset: PresetKey | null) {
    const startCD = toCD(startOfDay(startJS))
    const endCD = toCD(startOfDay(endJS))
    value.value = { start: startCD, end: endCD }
    placeholder.value = value.value.start
    secondMonthPlaceholder.value = value.value.end
    activePreset.value = preset
}

function applyPreset(preset: PresetKey) {
    const now = new Date()

    if (preset === "today") return setRange(now, now, "today")
    if (preset === "yesterday") {
        const y = addDays(now, -1)
        return setRange(y, y, "yesterday")
    }
    if (preset === "thisWeek") {
        const start = startOfWeekSunday(now)
        return setRange(start, now, "thisWeek")
    }
    if (preset === "lastWeek") {
        const thisWeekStart = startOfWeekSunday(now)
        const lastWeekEnd = addDays(thisWeekStart, -1)
        const lastWeekStart = addDays(thisWeekStart, -7)
        return setRange(lastWeekStart, lastWeekEnd, "lastWeek")
    }
    if (preset === "lastMonth") {
        const firstThisMonth = firstDayOfMonth(now)
        const lastPrevMonth = addDays(firstThisMonth, -1)
        const firstPrevMonth = firstDayOfMonth(lastPrevMonth)
        return setRange(firstPrevMonth, lastPrevMonth, "lastMonth")
    }
    if (preset === "last3Months") {
        const firstThisMonth = firstDayOfMonth(now)
        const start = new Date(firstThisMonth.getFullYear(), firstThisMonth.getMonth() - 2, 1)
        return setRange(start, now, "last3Months")
    }
}

/** Detect preset from current value (on reopen) */
function detectPresetFromValue(): PresetKey | null {
    if (!value.value?.start || !value.value?.end) return null
    const startJS = startOfDay(toDate(value.value.start))
    const endJS = startOfDay(toDate(value.value.end))
    const today = startOfDay(new Date())

    const isSame = (a: Date, b: Date) => a.getTime() === b.getTime()

    if (isSame(startJS, today) && isSame(endJS, today)) return "today"
    const yest = startOfDay(addDays(today, -1))
    if (isSame(startJS, yest) && isSame(endJS, yest)) return "yesterday"
    const thisWeekStart = startOfWeekSunday(today)
    if (isSame(startJS, thisWeekStart) && isSame(endJS, today)) return "thisWeek"
    const lastWeekStart = addDays(thisWeekStart, -7)
    const lastWeekEnd = addDays(thisWeekStart, -1)
    if (isSame(startJS, lastWeekStart) && isSame(endJS, lastWeekEnd)) return "lastWeek"
    const firstThisMonth = firstDayOfMonth(today)
    const lastPrevMonth = addDays(firstThisMonth, -1)
    const firstPrevMonth = firstDayOfMonth(lastPrevMonth)
    if (isSame(startJS, firstPrevMonth) && isSame(endJS, lastPrevMonth)) return "lastMonth"
    const threeMonthStart = new Date(firstThisMonth.getFullYear(), firstThisMonth.getMonth() - 2, 1)
    if (isSame(startJS, threeMonthStart) && isSame(endJS, today)) return "last3Months"

    return null
}

watch(value, (newVal) => {
    activePreset.value = detectPresetFromValue()
}, { immediate: true })
</script>

<template>
    <Popover @open-change="(isOpen) => { if (isOpen) activePreset.value = detectPresetFromValue() }">
        <PopoverTrigger as-child>
            <Button variant="outline" :class="cn(
                'w-[320px] justify-start text-left font-normal',
                !value && 'text-muted-foreground',
            )">
                <Calendar class="mr-2 h-4 w-4" />
                <template v-if="value?.start">
                    <template v-if="value?.end">
                        {{ formatter.custom(toDate(value.start), { dateStyle: 'medium' }) }}
                        -
                        {{ formatter.custom(toDate(value.end), { dateStyle: 'medium' }) }}
                    </template>
                    <template v-else>
                        {{ formatter.custom(toDate(value.start), { dateStyle: 'medium' }) }}
                    </template>
                </template>
                <template v-else>
                    Pick a date
                </template>
            </Button>
        </PopoverTrigger>

        <PopoverContent class="w-auto p-0">
            <div class="flex">
                <!-- Presets -->
                <div class="w-48 border-r p-3 space-y-2">
                    <div class="text-xs uppercase tracking-wide text-muted-foreground mb-2">Quick ranges</div>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'today' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('today')">Today</Button>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'yesterday' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('yesterday')">Yesterday</Button>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'thisWeek' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('thisWeek')">This Week</Button>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'lastWeek' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('lastWeek')">Last Week</Button>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'lastMonth' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('lastMonth')">Last Month</Button>
                    <Button variant="ghost" class="w-full justify-start"
                        :class="activePreset === 'last3Months' && 'bg-primary text-primary-foreground font-medium'"
                        @click="applyPreset('last3Months')">Last 3 Months</Button>
                    <div class="pt-1 text-xs text-muted-foreground">Or pick a custom range →</div>
                </div>

                <!-- Calendars -->
                <RangeCalendarRoot v-slot="{ weekDays }" v-model="value" v-model:placeholder="placeholder" class="p-3">
                    <div class="flex flex-col gap-y-4 mt-4 sm:flex-row sm:gap-x-4 sm:gap-y-0">
                        <!-- First Month -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <button
                                    :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                    @click="updateMonth('first', -1)">
                                    <ChevronLeft class="h-4 w-4" />
                                </button>
                                <div class="text-sm font-medium">
                                    {{ formatter.fullMonthAndYear(toDate(firstMonth.value)) }}
                                </div>
                                <button
                                    :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                    @click="updateMonth('first', 1)">
                                    <ChevronRight class="h-4 w-4" />
                                </button>
                            </div>
                            <RangeCalendarGrid>
                                <RangeCalendarGridHead>
                                    <RangeCalendarGridRow>
                                        <RangeCalendarHeadCell v-for="day in weekDays" :key="day" class="w-full">{{ day
                                        }}
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

                        <!-- Second Month -->
                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between">
                                <button
                                    :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                    @click="updateMonth('second', -1)">
                                    <ChevronLeft class="h-4 w-4" />
                                </button>
                                <div class="text-sm font-medium">
                                    {{ formatter.fullMonthAndYear(toDate(secondMonth.value)) }}
                                </div>
                                <button
                                    :class="cn(buttonVariants({ variant: 'outline' }), 'h-7 w-7 bg-transparent p-0 opacity-50 hover:opacity-100')"
                                    @click="updateMonth('second', 1)">
                                    <ChevronRight class="h-4 w-4" />
                                </button>
                            </div>
                            <RangeCalendarGrid>
                                <RangeCalendarGridHead>
                                    <RangeCalendarGridRow>
                                        <RangeCalendarHeadCell v-for="day in weekDays" :key="day" class="w-full">{{ day
                                        }}
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
