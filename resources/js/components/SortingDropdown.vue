<script setup>
const emits = defineEmits(['sort']);

function sortBy(value) {
    emits('sort', value);
}
</script>

<template>
    <div class="row">
        <div class="col">
            <div class="mt-3 float-end">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" @click.prevent="sortBy('username')">Username</a></li>
                    <li><a class="dropdown-item" href="#" @click.prevent="sortBy('email')">Email</a></li>
                    <li><a class="dropdown-item" href="#" @click.prevent="sortBy('newest')">Newest</a></li>
                    <li><a class="dropdown-item" href="#" @click.prevent="sortBy('oldest')">Oldest</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
.dropdown-item:hover {
    background: #e8eaf1;
}
</style>
