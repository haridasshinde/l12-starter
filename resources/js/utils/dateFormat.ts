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
