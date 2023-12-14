<script setup>
import {store} from '../stores/store.js';

function hide() {
    store.alertText = null;
}
</script>

<template>
    <div
        class="alert alert-dismissible fade show position-absolute top-0 end-0 position-fixed z-1 mt-4 me-4"
        :class="store.alertType"
        role="alert"
        v-show="store.alertText"
    >
        {{ store.alertText }}
        <button type="button" class="btn-close" aria-label="Close" @click="hide"></button>
    </div>
</template>