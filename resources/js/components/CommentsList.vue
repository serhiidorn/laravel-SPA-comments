<script setup>
import useDayJs from '../composables/dayjs.js';
import CommentForm from './CommentForm.vue';
import {reactive} from 'vue';

defineProps({
    comments: {
        required: true,
        type: Array,
    },
});

defineEmits(['create-comment']);

const activeMap = reactive({});

const toggleForm = (index) => {
    activeMap[index] = !activeMap[index];
};

const {diffForHumans} = useDayJs();

function downloadFile(file) {
    window.location = '/download/?file=' + file;
}
</script>

<template>
    <div
        class="comment-box"
        v-if="comments.length"
        v-for="comment in comments"
        :key="comment.id"
    >
        <article class="card bg-light mt-3">
            <header class="card-header border-0 bg-transparent d-flex align-items-center">
                <div class="d-flex align-items-center flex-grow-1 justify-content-between">
                    <div>
                        <a class="fw-semibold text-decoration-none">{{ comment.username }}</a>
                        <span class="ms-3 small text-muted">{{ diffForHumans(comment.published_at) }}</span>
                    </div>
                    <a class="fw-semibold text-decoration-none">{{ comment.email }}</a>
                </div>
            </header>
            <div class="card-body py-2 px-3 fs-5" v-html="comment.text"></div>

            <div class="d-flex flex-column">
                <viewer v-if="comment.image" class="p-2">
                    <img :src="`storage/${comment.image}`" alt="" class="mw-100" style="cursor: pointer;">
                </viewer>

                <a href="" v-if="comment.file" class="flex flex-column p-2" @click.prevent="downloadFile(comment.file)">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="48"
                             width="48" version="1.1" id="Layer_1" viewBox="0 0 512 512" xml:space="preserve">
                        <path style="fill:#E2E5E7;"
                              d="M128,0c-17.6,0-32,14.4-32,32v448c0,17.6,14.4,32,32,32h320c17.6,0,32-14.4,32-32V128L352,0H128z"/>
                            <path style="fill:#B0B7BD;" d="M384,128h96L352,0v96C352,113.6,366.4,128,384,128z"/>
                            <polygon style="fill:#CAD1D8;" points="480,224 384,128 480,128 "/>
                            <path style="fill:#576D7E;"
                                  d="M416,416c0,8.8-7.2,16-16,16H48c-8.8,0-16-7.2-16-16V256c0-8.8,7.2-16,16-16h352c8.8,0,16,7.2,16,16  V416z"/>
                            <g>
                        <path style="fill:#FFFFFF;"
                              d="M132.784,311.472H110.4c-11.136,0-11.136-16.368,0-16.368h60.512c11.392,0,11.392,16.368,0,16.368   h-21.248v64.592c0,11.12-16.896,11.392-16.896,0v-64.592H132.784z"/>
                                <path style="fill:#FFFFFF;"
                                      d="M224.416,326.176l22.272-27.888c6.656-8.688,19.568,2.432,12.288,10.752   c-7.68,9.088-15.728,18.944-23.424,29.024l26.112,32.496c7.024,9.6-7.04,18.816-13.952,9.344l-23.536-30.192l-23.152,30.832   c-6.528,9.328-20.992-1.152-13.68-9.856l25.696-32.624c-8.048-10.096-15.856-19.936-23.664-29.024   c-8.064-9.6,6.912-19.44,12.784-10.48L224.416,326.176z"/>
                                <path style="fill:#FFFFFF;"
                                      d="M298.288,311.472H275.92c-11.136,0-11.136-16.368,0-16.368h60.496c11.392,0,11.392,16.368,0,16.368   h-21.232v64.592c0,11.12-16.896,11.392-16.896,0V311.472z"/>
                            </g>
                            <path style="fill:#CAD1D8;"
                                  d="M400,432H96v16h304c8.8,0,16-7.2,16-16v-16C416,424.8,408.8,432,400,432z"/>
                        </svg>
                    </div>

                    Download File
                </a>
            </div>

            <footer class="card-footer bg-white border-0 py-1">
                <button
                    type="button"
                    class="btn btn-link text-decoration-none float-end"
                    @click="toggleForm(comment.id)"
                >
                    Reply
                </button>
            </footer>

            <Transition name="fade">
                <CommentForm
                    v-if="!! activeMap[comment.id]"
                    :parent_id="comment.id"
                    @createComment="$emit('create-comment')"
                    :key="comment.id"
                />
            </Transition>
        </article>
        <CommentsList
            v-if="comment.replies.length"
            :comments="comment.replies"
            :key="comment.id"
        />
    </div>

    <div v-else>
        No comments yet.
    </div>
</template>

<style scoped>
.comment-box > .comment-box {
    margin-left: 3rem;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>