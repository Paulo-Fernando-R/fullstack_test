<script setup lang="ts">
import { ref } from "vue";

const text = ref("");
const selected = ref(null);
const checked = ref(true);

const currentPage = ref(1);
const baseUrl = "http://127.0.0.1:8000/products";

const apiUrl = computed(() => {
    const params = new URLSearchParams();

    if (text.value) params.append("name", text.value);
    if (selected.value !== null) params.append("category", selected.value);
    if (checked.value !== null)
        params.append("with_image", checked.value.toString());
    //TODO VERIFICAR CATEGORIA NULL
    params.append("page", currentPage.value.toString());
    const finalUrl = `${baseUrl}?${params.toString()}`;
    console.log("finalUrl", finalUrl);
    return finalUrl;
});

const { data, status, error, refresh, clear } = await useFetch(apiUrl);

console.log("data", data.value);
function handlePageChange(url: string) {
    const urlObj = new URL(url);
    const page = urlObj.searchParams.get("page");
    if (page) currentPage.value = parseInt(page);

    // console.log("url", url);
}
function handleSearch() {
    currentPage.value = 1; // volta pra primeira página
}

const router = useRouter();
// function handleSearch() {
//     console.log("text", text.value);
//     console.log("selected", selected.value);
//     console.log("checked", checked.value);
//     /*  router.push({
//         path: "/search",
//         query: {
//             text: text.value,
//             selected: selected.value,
//             checked: checked.value,
//         },
//     });*/
// }
</script>

<template>
    <div class="container">
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
    /* all: unset; */
    width: 100%;
    height: 100dvh;
    background-color: var(--color-bg-primary);
}
</style>
