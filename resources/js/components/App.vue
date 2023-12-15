<script setup>
import CommentsPage from './CommentsPage.vue';
import AppLoader from "./AppLoader.vue";
</script>

<template>
    <div class="container h-100">
        <Suspense>
            <CommentsPage/>

            <template #fallback>
                <AppLoader />
            </template>
        </Suspense>
    </div>
</template>
