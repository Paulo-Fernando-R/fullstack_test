<script setup lang="ts">
import { ref } from "vue";
import type Product from "~/types/product";

const props = defineProps({
    data: {
        type: Array<Product>,
        default: () => ({
            data: [],
        }),
    },
});


</script>

<template>
    <div class="grid">
        <div class="list">
            <div class="card" v-for="e of props.data" :key="e.id">
                <img :src="e.image_url" />
                <p style="color: black">
                    {{ e.name }}
                </p>
                <p>{{ e.price }}</p>
                <button>Add to Cart</button>

                <NuxtLink :to="e.image_url"> Saiba mais </NuxtLink>
            </div>
        </div>
    </div>
</template>

<style scoped>
.grid {
    display: flex;
    justify-content: center;
    width: 100%;
}

.list {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    padding: 2rem 0;
    max-width: 1700px;
}

.card {
    width: 300px;
    height: 400px;
    background-color: var(--color-bg-secondary);
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 16px;
    padding: 16px;
    overflow: hidden;
}
.card img {
    width: 300px;
    height: 200px;

    object-fit: contain;

    border-radius: 8px;
}
.card p {
    color: var(--color-text-secondary);
    font-size: 0.9rem;
    font-weight: 600;
}
.card a {
    color: var(--color-text-primary);
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
}

.card button {
    background-color: var(--color-text-primary);
    color: var(--color-bg-primary);
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
}
</style>
