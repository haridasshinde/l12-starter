// composables/useExportNotifications.ts
import axios from 'axios';
import { onMounted, onUnmounted, ref } from 'vue';

export function useExportNotifications(pollIntervalMs = 5000) {
    const exportsList = ref<any[]>([]);
    const loading = ref(false);
    const messages = ref<string[]>([]);
    const notifiedExports = new Set<number>();
    let intervalId: number | null = null;

    const fetchExports = async () => {
        try {
            loading.value = true;

            const res = await axios.get('/exports', {
                params: { today: true },
            });

            const newExports = res.data.data;

            newExports.forEach((exp: any) => {
                const existingIndex = exportsList.value.findIndex((e) => e.id === exp.id);

                if (existingIndex > -1) {
                    // Update existing record
                    exportsList.value[existingIndex] = exp;
                } else {
                    // Add new record
                    exportsList.value.push(exp);
                }

                // Notify only if it just changed to completed
                if (exp.status === 'completed' && !notifiedExports.has(exp.id)) {
                    messages.value.push(`✅ Export ${exp.file_name} completed!`);
                    notifiedExports.add(exp.id);

                    // Auto-hide after 5 seconds
                    setTimeout(() => {
                        messages.value = messages.value.filter((msg) => !msg.includes(exp.file_name || ''));
                    }, 5000);
                }
            });

            // Optional: sort by newest first
            exportsList.value.sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime());
        } catch (err) {
            console.error('Fetch error:', err);
        } finally {
            loading.value = false;
        }
    };

    const startPolling = () => {
        if (intervalId) return;
        fetchExports();
        intervalId = window.setInterval(fetchExports, pollIntervalMs);
    };

    const stopPolling = () => {
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    };

    onMounted(startPolling);
    onUnmounted(stopPolling);

    return { exportsList, loading, messages, fetchExports };
}
