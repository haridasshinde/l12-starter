<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import ChangeLanguage from '../settings/ChangeLanguage.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import { computed } from 'vue';
import { useI18n } from 'vue-i18n';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
const { t } = useI18n()
const pageTitle = computed(() => t('Choose your language'))
const title = computed(() => t('Log in'))
const description = computed(() => t('Enter your email and password below to log in'))


</script>

<template>
    <AuthBase :title="title" :description="description">

        <Head :title="title" />

        <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col gap-6">
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">{{ t('Email address') }}</Label>
                    <Input id="email" type="email" required autofocus :tabindex="1" autocomplete="email"
                        v-model="form.email" placeholder="email@example.com" />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">{{ t('Password') }}</Label>
                        <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-sm"
                            :tabindex="5">
                            {{ t('Forgot password?') }}
                        </TextLink>
                    </div>
                    <Input id="password" type="password" required :tabindex="2" autocomplete="current-password"
                        v-model="form.password" placeholder="Password" />
                    <InputError :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>
                            {{ t('Remember me') }}
                        </span>
                    </Label>
                </div>

                <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                    <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                    {{ t('Log in') }}
                </Button>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                {{ t("Don't have an account?") }}
                <TextLink :href="route('register')" :tabindex="5">
                    {{ t('Sign up') }}
                </TextLink>
            </div>

        </form>
        <hr />
        <HeadingSmall :title="pageTitle" />
        <ChangeLanguage />
    </AuthBase>
</template>
