import { format, parseISO } from 'date-fns';

/**
 * Format date (only date part)
 */
export function formatDate(date: string | Date, pattern = 'dd MMM yyyy') {
    if (!date) return '';
    const d = typeof date === 'string' ? parseISO(date) : date;
    return format(d, pattern); // e.g. "17 Aug 2025"
}

/**
 * Format date with time
 */
export function formatDateTime(date: string | Date, pattern = 'dd MMM yyyy, hh:mm a') {
    if (!date) return '';
    const d = typeof date === 'string' ? parseISO(date) : date;
    return format(d, pattern); // e.g. "17 Aug 2025, 10:30 AM"
}

export function getTimeDiffString(start: string, end: string): string {
    const diffMs = new Date(end).getTime() - new Date(start).getTime();
    const totalSeconds = Math.floor(diffMs / 1000);

    if (totalSeconds < 60) {
        return `${totalSeconds} second${totalSeconds !== 1 ? 's' : ''}`;
    }

    const totalMinutes = Math.floor(totalSeconds / 60);
    if (totalMinutes < 60) {
        return `${totalMinutes} minute${totalMinutes !== 1 ? 's' : ''}`;
    }

    const totalHours = Math.floor(totalMinutes / 60);
    return `${totalHours} hour${totalHours !== 1 ? 's' : ''}`;
}
