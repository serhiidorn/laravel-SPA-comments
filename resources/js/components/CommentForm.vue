<script setup>
import {QuillEditor} from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {ref, watch} from 'vue';
import {configure, defineRule, Field as VeeField, Form as VeeForm} from 'vee-validate';
import {alpha_num, email as emailRule, ext, max, mimes, required, size, url} from '@vee-validate/rules';
import {localize} from '@vee-validate/i18n';
import useComments from "../composables/comments.js";

const props = defineProps({
    parent_id: {
        type: Number,
    },
});

const {save} = useComments();

defineRule('required', required);
defineRule('email', emailRule);
defineRule('alpha_num', alpha_num);
defineRule('url', url);
defineRule('mimes', mimes);
defineRule('size', size);
defineRule('ext', ext);
defineRule('max', max);

configure({
    generateMessage: localize('en', {
        messages: {
            required: 'This field is required.',
            alpha_num: 'This field must only contain letters and numbers.',
            email: 'This field must be a valid email address.',
            url: 'This field must be a valid URL.',
            max: 'This field must not be greater than 0:{length} characters.',
            size: 'File must not be greater than 0:{size} kilobytes.',
            mimes: 'Not allowed file\'s format.',
            ext: 'Not allowed file\'s format.',
        },
    }),
});

const emits = defineEmits(['create-comment']);

const isSubmitting = ref(false);
const text = ref('');

watch(text, (newValue) => {
    if (newValue === '<p><br></p>') {
        text.value = '';
    }
});

async function submit(values) {
    isSubmitting.value = true;

    const comment = {
        ...values,
        parent_id: props.parent_id,
    };

    await save(comment);

    isSubmitting.value = false;

    emits('create-comment');
}
</script>

<template>
    <div class="row p-2">
        <div class="col-lg-8">
            <div class="card bg-light">
                <div class="card-body py-2">
                    <VeeForm @submit="submit" v-slot="{errors, values}">
                        <div>
                            <div class="input-group mb-3">
                                <label for="username" class="visually-hidden">Username</label>
                                <VeeField
                                    type="text"
                                    class="form-control fs-5"
                                    :class="{'is-invalid': errors.username }"
                                    name="username"
                                    id="username"
                                    placeholder="Username"
                                    rules="required|alpha_num|max:255"
                                />
                                <span class="invalid-feedback" role="alert">
                                    {{ errors.username }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="visually-hidden">Email address</label>
                                <VeeField
                                    type="email"
                                    class="form-control fs-5"
                                    :class="{'is-invalid': errors.email }"
                                    name="email"
                                    id="email"
                                    placeholder="email@example.com"
                                    rules="required|email|max:255"
                                />
                                <span class="invalid-feedback" role="alert">
                                    {{ errors.email }}
                                </span>
                            </div>

                            <div class="mb-3">
                                <label for="homepage" class="visually-hidden">Your vanity URL</label>
                                <div class="input-group">
                                    <span class="input-group-text fs-5">https://example.com/</span>
                                    <VeeField
                                        type="url"
                                        class="form-control fs-5"
                                        :class="{'is-invalid': errors.homepage }"
                                        name="homepage"
                                        id="homepage"
                                        rules="url|max:255"
                                    />
                                    <span class="invalid-feedback" role="alert">
                                        {{ errors.homepage }}
                                    </span>
                                </div>
                                <div class="form-text ms-2 text-success fs-6">Your vanity URL</div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <VeeField
                                        type="file"
                                        class="form-control fs-5"
                                        :class="{'is-invalid': errors.image}"
                                        name="image"
                                        id="image"
                                        accept=".jpg, .jpeg, .png, .gif"
                                        rules="size:8192|mimes:image/jpg,image/jpeg,image/png,image/gif"
                                    />
                                    <label for="image" class="input-group-text">UPLOAD IMAGE</label>
                                    <span class="invalid-feedback fs-6 ms-2" role="alert">
                                        {{ errors.image }}
                                    </span>
                                </div>
                                <div class="form-text ms-2 text-success fs-6">
                                    allowed formats JGP,JPEG,GIF,PNG must be less than 8MB
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <VeeField
                                        type="file"
                                        class="form-control fs-5"
                                        :class="{'is-invalid': errors.file}"
                                        name="file"
                                        id="file"
                                        accept=".txt"
                                        rules="size:100|ext:txt"
                                    />
                                    <label for="file" class="input-group-text">UPLOAD FILE</label>
                                    <span class="invalid-feedback fs-6 ms-2" role="alert">
                                        {{ errors.file }}
                                    </span>
                                </div>
                                <div class="form-text ms-2 text-success fs-6">
                                    allowed format TXT must be less than 100KB
                                </div>
                            </div>

                            <VeeField type="hidden" name="text" v-model="text" rules="required"/>

                            <div
                                class="mt-3"
                                :class="{'border border-danger': errors.text }"
                            >
                                <QuillEditor
                                    v-model:content="text"
                                    placeholder="Compose an epic..."
                                    :toolbar="['bold', 'italic', 'code', 'link']"
                                    content="html"
                                    content-type="html"
                                />
                            </div>
                            <span class="text-danger fs-6" role="alert">
                                    {{ errors.text }}
                            </span>
                        </div>
                        <footer class="card-footer bg-transparent border-0 text-end">
                            <button
                                type="submit"
                                class="btn btn-primary"
                                :disabled="isSubmitting"
                            >
                                <span v-show="! isSubmitting" class="fs-5">Submit</span>
                                <span v-show="isSubmitting">
                                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                                    <span role="status" class="fs-5">Saving...</span>
                                </span>
                            </button>
                        </footer>
                    </VeeForm>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
::-webkit-input-placeholder {
    font-size: 17px;
}

:-ms-input-placeholder {
    font-size: 17px;
}

.ql-editor {
    min-height: 6rem;
    font-size: 1rem;
}
</style>
