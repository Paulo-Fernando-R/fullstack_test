<script lang="ts" setup>
const { data, status, error, refresh, clear } = await useFetch(
    "http://127.0.0.1:8000/products/"
);
console.log("data", data.value);
</script>

<template>
    <div class="container">
        <div class="card" v-for="e of data.data" :key="e.id">

            <p style="color: black;">
                {{ e.name  }}
            </p>

            <img :src="e.image_url">
            <NuxtLink :to="e.image_url">
                Saiba mais
            </NuxtLink>
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    gap: 10px;

}
.card{
    background-color: red;
    width: 200px;
    height: 200px;
}

img{
    width: 100px;
    height: 100px;
}
.title {
    font-size: 2rem;
    margin-bottom: 1rem;
}
.description {
    font-size: 1.2rem;
    margin-bottom: 2rem;
}
.button {
    padding: 1rem 2rem;
    font-size: 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.button:hover {
    background-color: #0056b3;
}
.button:disabled {
    background-color: #007bff;
    cursor: not-allowed;
}
.button:disabled:hover {
    background-color: #007bff;
}
.error {
    color: red;
    font-size: 1.2rem;
    margin-top: 1rem;
}
</style>
