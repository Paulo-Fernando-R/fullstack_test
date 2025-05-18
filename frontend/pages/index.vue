<script setup lang="ts">
import { ref } from "vue";

const runtime = useRuntimeConfig();
const baseUrl = runtime.public.baseApiUrl;

const text = ref("");
const debouncedText = ref("");
const selected = ref("");
const checked = ref(true);
const currentPage = ref(1);

let debounceTimeout: ReturnType<typeof setTimeout>;
watch(text, (newVal) => {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        debouncedText.value = newVal;
        currentPage.value = 1;
    }, 500);
});

const apiUrl = computed(() => {
    const params = new URLSearchParams();
    if (debouncedText.value) params.append("name", debouncedText.value);
    //  if (text.value) params.append("name", text.value);
    if (selected.value !== null) params.append("category", selected.value);
    if (checked.value !== null)
        params.append("with_image", checked.value.toString());

    params.append("page", currentPage.value.toString());
    const finalUrl = `${baseUrl}/products?${params.toString()}`;
    return finalUrl;
});

const { data, status, error, pending } = await useFetch(apiUrl);

function handlePageChange(url: string) {
    const urlObj = new URL(url);
    const page = urlObj.searchParams.get("page");
    if (page) currentPage.value = parseInt(page);
}

function handleSearch() {
    currentPage.value = 1;
}
</script>

<template>
    <div class="container">
        <Loading v-if="pending" />
        <HomeBanner />
        <FilterBar
            v-model:text="text"
            v-model:checked="checked"
            v-model:selected="selected"
            @keyup="handleSearch"
        />

        <ProductsList
            v-if="data"
            :data="data"
            @page-change="handlePageChange"
        />
    </div>
</template>

<style scoped>
.container {
    width: 100%;
    height: 100dvh;
    background-color: var(--color-bg-primary);
}
</style>
