import {reactive} from 'vue';

export const store = reactive({
    alertText: null,
    alertType: '',
    toasts: [],
})
