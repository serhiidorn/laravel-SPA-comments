import './bootstrap';
import { createApp } from 'vue';
import App from "./components/App.vue";
import {VueReCaptcha} from "vue-recaptcha-v3";
import 'viewerjs/dist/viewer.css'
import VueViewer from "v-viewer";

const app = createApp(App);

app.use(VueReCaptcha, {siteKey: import.meta.env.VITE_RECAPTCHA_SITE_KEY});
app.use(VueViewer);

app.mount('#app');
