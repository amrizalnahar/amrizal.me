import './rsa-encryptor';

document.addEventListener('alpine:init', () => {
    window.Alpine.store('i18n', {
        locale: window.initialLocale || 'id',

        t(key) {
            const keys = key.split('.');
            let value = window.translations?.[this.locale];
            for (const k of keys) {
                if (value && typeof value === 'object' && value[k] !== undefined) {
                    value = value[k];
                } else {
                    // Fallback to Indonesian
                    value = window.translations?.['id'];
                    for (const fk of keys) {
                        if (value && typeof value === 'object' && value[fk] !== undefined) {
                            value = value[fk];
                        } else {
                            return key;
                        }
                    }
                    return value;
                }
            }
            return value ?? key;
        },

        setLocale(locale) {
            if (!['id', 'en'].includes(locale) || this.locale === locale) return;

            this.locale = locale;
            document.documentElement.lang = locale;
            localStorage.setItem('locale', locale);

            // Update all i18n-marked elements for instant feedback
            this.updateElements();

            // Notify other scripts
            window.dispatchEvent(new CustomEvent('locale-changed', { detail: locale }));

            // Persist to session then reload to re-render server-side bilingual content
            fetch('/locale', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({ locale })
            }).catch(() => {}).finally(() => {
                window.location.reload();
            });
        },

        updateElements() {
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.dataset.i18n;
                const val = this.t(key);
                if (val !== undefined) el.textContent = val;
            });
            document.querySelectorAll('[data-i18n-html]').forEach(el => {
                const key = el.dataset.i18nHtml;
                const val = this.t(key);
                if (val !== undefined) el.innerHTML = val;
            });
            document.querySelectorAll('[data-i18n-attr]').forEach(el => {
                const [attr, key] = el.dataset.i18nAttr.split(':');
                const val = this.t(key);
                if (val !== undefined && attr) el.setAttribute(attr, val);
            });
        }
    });

    // Restore locale from localStorage if different from server-rendered locale
    const stored = localStorage.getItem('locale');
    if (stored && stored !== window.initialLocale) {
        window.Alpine.store('i18n').setLocale(stored);
    }
});
