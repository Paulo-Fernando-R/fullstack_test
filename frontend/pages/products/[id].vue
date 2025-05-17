<script setup lang="ts">
const route = useRoute();
const productId = route.params.id;

const apiUrl = `http://127.0.0.1:8000/products/${productId}`;
const { data, status, error, refresh, clear } = await useFetch(apiUrl);
console.log("data", data.value);
</script>

<template>
    <div class="container">
        <div class="imageBox">
            <img :src="data.product.image_url" alt="" />
        </div>

        <div class="productBox">
            <div class="productInfo">
                <h1>{{ data.product.name }}</h1>
                <p>{{ data.product.description }}</p>
                <span>Category: {{ data.product.category }}</span>
            </div>

            <h2>{{ data.product.price }}</h2>
            <CartButton :product="data.product" />
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    max-width: 1700px;
    padding: 2rem;
    margin: auto;
    gap: 2rem;
}
.imageBox {
    max-width: 50%;
    /* height: 100%; */
    padding: 1rem;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 24px;

    background-color: var(--color-bg-secondary);
    img {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: 8px;
    }
}

.productBox {
    width: 50%;
    height: 400px;
    max-width: 600px;
    /* height: 100%; */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: start;
    gap: px;

    .productInfo {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: start;
        gap: 24px;

        h1 {
            font-size: 2rem;
            color: var(--color-text-secondary);
        }
        p {
            font-size: 0.8rem;
            color: var(--color-text-secondary);
            max-width: 400px;
            line-height: 1.5;
            font-weight: 600;
        }

        span {
            font-size: 0.8rem;
            color: var(--color-text-secondary);
            font-weight: 800;
        }
    }

    h2 {
        font-size: 1.4rem;
        color: var(--color-primary);
    }
}
</style>
