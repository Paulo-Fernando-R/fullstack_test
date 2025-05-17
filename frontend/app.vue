<script lang="ts" setup>
const { data, status, error, refresh, clear } = await useFetch(
    "http://127.0.0.1:8000/products/"
);
console.log("data", data.value);
</script>

<template>
    <Header />

    <main>
        <NuxtPage />
        <!-- <NuxtPage/>
        <div class="container">
            <div class="card" v-for="e of data.data" :key="e.id">
                <p style="color: black">
                    {{ e.name }}
                </p>

                <img :src="e.image_url" />
                <NuxtLink :to="e.image_url"> Saiba mais </NuxtLink>
            </div>
        </div> -->
    </main>
</template>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}
</style>
