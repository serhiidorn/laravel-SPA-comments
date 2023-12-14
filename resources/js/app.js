import './bootstrap';
import { createApp } from 'vue';
import App from "./components/App.vue";
import {VueReCaptcha} from "vue-recaptcha-v3";

const app = createApp(App);

app.use(VueReCaptcha, {siteKey: import.meta.env.VITE_RECAPTCHA_SITE_KEY})
app.mount('#app');
