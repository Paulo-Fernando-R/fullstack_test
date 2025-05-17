<script setup lang="ts">
import { ref } from "vue";
const text = ref("");
const select = ref("");
const checked = ref(true);
const data = ["teste1", "teste2", "teste3", "teste4", "teste5"];
</script>

<template>
    <div class="container">
        <HomeBanner />
        <FilterBar />
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
