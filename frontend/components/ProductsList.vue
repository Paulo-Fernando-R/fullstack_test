<script setup lang="ts">
import { ref } from "vue";
import type Product from "~/types/product";

defineProps<{
    data: {
        data: {
            id: number;
            name: string;
            price: number;
            description: string;
            category: string;
            image_url: string;
        }[];
        links: {
            first: string;
            last: string;
            prev: string | null;
            next: string | null;
        };
        meta: {
            current_page: number;
            last_page: number;
            links: {
                url: string | null;
                label: string;
                active: boolean;
            }[];
        };
    };
}>();

const emit = defineEmits<{
    (e: "page-change", url: string): void;
}>();

function goToPage(url: string | null) {
    if (url) emit("page-change", url);
}
</script>

<template>
    <div class="grid">
        <div class="list">
            <div class="card" v-for="e of data.data" :key="e.id">
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

    <div class="pagination">
        <button
            v-for="link in data.meta.links"
            :key="link.label"
            :disabled="!link.url"
            :class="{ active: link.active }"
            @click="() => link.url && goToPage(link.url)"
            v-html="link.label"
        />
    </div>
</template>

<style scoped>
.grid {
    display: flex;
    justify-content: center;
    width: 100%;
    min-height: 100dvh;
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

.pagination {
    margin-top: 2rem;

    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
    align-items: flex-start;
    height: 100px;
}

.pagination button {
    padding: 0.5rem 1rem;
    border: none;
    background-color: #eee;
    cursor: pointer;
    border-radius: 6px;
    font-weight: bold;
}

.pagination button.active {
    background-color: #007bff;
    color: white;
}

.pagination button:disabled {
    cursor: not-allowed;
    opacity: 0.5;
}
</style>
