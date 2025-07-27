import { createI18n } from 'vue-i18n';

// Load locale messages dynamically
function loadLocaleMessages() {
    const locales = import.meta.glob('./locales/*.json', { eager: true });
    const messages: Record<string, any> = {};

    for (const path in locales) {
        const matched = path.match(/([A-Za-z0-9-_]+)\.json$/);
        if (matched && matched[1]) {
            messages[matched[1]] = (locales[path] as any).default;
        }
    }

    return messages;
}
const savedLocale = localStorage.getItem('locale') || 'en';
const i18n = createI18n({
    legacy: false, // composition API mode
    locale: savedLocale,
    fallbackLocale: 'en',
    messages: loadLocaleMessages(),
});

export default i18n;
