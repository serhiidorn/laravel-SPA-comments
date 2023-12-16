<script setup>
import CommentForm from "./CommentForm.vue";
import AppAlertMessage from "./AppAlertMessage.vue";
import ToastsList from "./ToastsList.vue";
import {store} from "../stores/store.js";
import CommentsList from "./CommentsList.vue";
import useComments from "../composables/comments.js";
import {Bootstrap5Pagination} from 'laravel-vue-pagination';
import {ref} from "vue";
import AppScrollToTop from "./AppScrollToTop.vue";
import SortingDropdown from "./SortingDropdown.vue";

const sortBy = ref(null);
const pageNum = ref(1);
const {comments, paginatedData, fetchComments} = useComments();

Echo.channel('comments').listen('CommentCreated', async e => {
    await fetchComments(pageNum.value, sortBy.value);

    if (store.toasts.length === 3) {
        store.toasts.shift();
    }

    store.toasts.push({
        id: e.comment.id,
        body: e.comment.username + ' published a new comment!'
    });

    setTimeout(() => {
        store.toasts.shift();
    }, 8000);
});

async function pageChanged(page) {
    pageNum.value = page;

    await fetchComments(pageNum.value, sortBy.value);
}

async function applySort(value) {
    sortBy.value = value;

    await fetchComments(pageNum.value, sortBy.value)
}

await fetchComments(pageNum.value, sortBy.value);
</script>

<template>
    <AppAlertMessage />
    <ToastsList />
    <div class="py-3 py-md-5 container">
        <CommentForm />

        <SortingDropdown @sort="applySort"/>
        <CommentsList :comments="comments"/>

        <div class="mt-2 mt-md-3">
            <Bootstrap5Pagination :data="paginatedData" @paginationChangePage="pageChanged"/>
        </div>
    </div>
    <AppScrollToTop />
</template>
