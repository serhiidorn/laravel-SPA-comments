<script setup>
import CommentForm from "./CommentForm.vue";
import AppAlertMessage from "./AppAlertMessage.vue";
import ToastsList from "./ToastsList.vue";
import {store} from "../stores/store.js";
import CommentsList from "./CommentsList.vue";
import useComments from "../composables/comments.js";

const {comments, fetchComments} = useComments();

Echo.channel('comments').listen('CommentCreated', async e => {
    await fetchComments();

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

await fetchComments();
</script>

<template>
    <AppAlertMessage />
    <ToastsList />
    <div class="py-3 py-md-5 container">
        <CommentForm />

        <CommentsList :comments="comments"/>
    </div>
</template>
