import Vue from 'vue';
import VueI18n from 'vue-i18n';

Vue.use(VueI18n);
const locale = document.getElementsByTagName('html')[0].getAttribute('lang');

const i18n = new VueI18n({
    locale: locale,
    messages: {
        [locale]: require(`../lang/${locale}.json`)
    },
    silentTranslationWarn: true
});

export default i18n;
