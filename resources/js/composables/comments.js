import useAlert from "./alert.js";

export default function useComments() {
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

    return {
        save
    };
}
