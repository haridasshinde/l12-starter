<script setup lang="ts">
import { Globe } from 'lucide-vue-next';
import { ref } from 'vue';
import { useI18n } from 'vue-i18n';

const { locale } = useI18n();

const languages = [
    { code: 'en', label: 'English' },
    { code: 'hi', label: 'Hindi' },
] as const;

const currentLocale = ref(locale.value);

// Persist and update language
function changeLanguage(code: string) {
    currentLocale.value = code;
    locale.value = code;
    localStorage.setItem('locale', code);
}
</script>

<template>
    <div class="inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800">
        <button
            v-for="{ code, label } in languages"
            :key="code"
            @click="changeLanguage(code)"
            :class="[
                'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                currentLocale === code
                    ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                    : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
            ]"
        >
            <Globe class="-ml-1 h-4 w-4" />
            <Transition name="fade" mode="out-in">
                <span class="ml-1.5 text-sm" :key="code">{{ label }}</span>
            </Transition>
        </button>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
