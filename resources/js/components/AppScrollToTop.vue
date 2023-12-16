<script setup>
import {ref} from 'vue';
import {useDebounceFn} from '@vueuse/core';

const scrollButton = ref(null);

window.addEventListener("scroll", useDebounceFn(() => {
    if (window.scrollY > 500) {
        scrollButton.value.style.display = 'block';
    } else {
        scrollButton.value.style.display = 'none';
    }
}));

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>

<template>
    <button
        type="button"
        class="btn btn-success btn-floating opacity-50"
        style="display: none"
        id="btn-back-to-top"
        ref="scrollButton"
        @click="scrollToTop"
    >
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-up-circle"
             viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707z"/>
        </svg>
    </button>
</template>

<style scoped>
#btn-back-to-top {
    position: fixed;
    bottom: 85px;
    right: 15px;
}
</style>