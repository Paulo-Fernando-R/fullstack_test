<script setup lang="ts">
import { ref } from "vue";

const text = ref("");
const selected = ref(null);
const checked = ref(true);

const { data, status, error, refresh, clear } = await useFetch(
    "http://127.0.0.1:8000/products/"
);
// console.log("data", data.value);

const router = useRouter();
function handleSearch() {
    console.log("text", text.value);
    console.log("selected", selected.value);
    console.log("checked", checked.value);
  /*  router.push({
        path: "/search",
        query: {
            text: text.value,
            selected: selected.value,
            checked: checked.value,
        },
    });*/


}
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
        <ProductsList :data="data.data" />
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
