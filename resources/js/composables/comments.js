import useAlert from "./alert.js";
import {ref} from "vue";

export default function useComments() {
    const comments = ref([]);
    const paginatedData = ref({});

    async function save(comment) {
        try {
            await axios.post('/api/comments', comment, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
        } catch ({response}) {
            if (response.status === 422) {
                useAlert(response.data.message, 'danger');
            }
        }
    }

    async function fetchComments(page, sort) {
        const {data} = await axios.get('/api/comments', {
            params: {
                page,
                sort,
            }
        });

        comments.value = data.data;
        paginatedData.value = data;
    }

    return {
        save,
        fetchComments,
        comments,
        paginatedData,
    };
}
