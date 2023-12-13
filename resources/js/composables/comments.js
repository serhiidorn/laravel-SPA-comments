export default function useComments() {
    async function save(comment) {
        try {
            await axios.post('/api/comments', comment, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
        } catch ({response}) {
        }
    }

    return {
        save
    };
}
