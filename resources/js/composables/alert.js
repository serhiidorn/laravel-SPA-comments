import {store} from '../stores/store.js';

export default function useAlert(message, type) {
    store.alertText = message;
    store.alertType = 'alert-' + type;
}