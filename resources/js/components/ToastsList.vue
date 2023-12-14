<script setup>
import {store} from '../stores/store.js';

function remove(index) {
    store.toasts.splice(index, 1);
}
</script>

<template>
    <TransitionGroup name="toasts" tag="div" class="toast-container position-fixed top-0 end-0 p-3">
        <div
            class="b-toast align-items-center text-bg-primary border-0" role="alert"
            v-for="(toast, index) in store.toasts" :key="toast.id"
        >
            <div class="d-flex">
                <div class="toast-body">
                    {{ toast.body }}
                </div>
                <button
                    type="button" class="btn-close btn-close-white me-2 m-auto"
                    @click="remove(index)"
                ></button>
            </div>
        </div>
    </TransitionGroup>
</template>

<style scoped>
.toasts-enter-active {
    transition: all 0.25s ease;
}
.toasts-leave-active {
    transition: all 0.25s linear;
}

.toasts-enter-from{
    opacity: 0;
    transform: translateX(40px);
}
.toasts-leave-to {
    opacity: 0;
    transform: translateY(-40px);
}

.b-toast {
    --bs-toast-zindex: 1090;
    --bs-toast-padding-x: 0.75rem;
    --bs-toast-padding-y: 0.5rem;
    --bs-toast-spacing: 1.5rem;
    --bs-toast-max-width: 250px;
    --bs-toast-font-size: 0.875rem;
    --bs-toast-color: ;
    --bs-toast-bg: rgba(255, 255, 255, 0.85);
    --bs-toast-border-width: 1px;
    --bs-toast-border-color: var(--bs-border-color-translucent);
    --bs-toast-border-radius: 0.375rem;
    --bs-toast-box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    --bs-toast-header-color: #6c757d;
    --bs-toast-header-bg: rgba(255, 255, 255, 0.85);
    --bs-toast-header-border-color: rgba(0, 0, 0, 0.05);
    width: var(--bs-toast-max-width);
    max-width: 100%;
    font-size: var(--bs-toast-font-size);
    color: var(--bs-toast-color);
    pointer-events: auto;
    background-color: var(--bs-toast-bg);
    background-clip: padding-box;
    border: var(--bs-toast-border-width) solid var(--bs-toast-border-color);
    box-shadow: var(--bs-toast-box-shadow);
    border-radius: var(--bs-toast-border-radius);
}
</style>