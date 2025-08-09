<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

import HeadingSmall from '@/components/HeadingSmall.vue';
import { type BreadcrumbItem } from '@/types';

import AppLayout from '@/layouts/AppLayout.vue';
import SettingsLayout from '@/layouts/settings/Layout.vue';
import { useI18n } from 'vue-i18n';
import ChangeLanguage from './ChangeLanguage.vue';

const { t } = useI18n();

const pageTitle = computed(() => t('Language settings'));
const pageDescription = computed(() => t("Update your account's language settings"));
const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: t('Language settings'),
        href: '/settings/language',
    },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="pageTitle" />
        <SettingsLayout>
            <div class="space-y-6">
                <HeadingSmall :title="t('Language settings')" :description="pageDescription" />
                <ChangeLanguage />
            </div>
        </SettingsLayout>
    </AppLayout>
</template>
