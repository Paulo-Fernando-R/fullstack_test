<script setup lang="ts">
import { currencyFormat } from "@/utils/textFormat";

const runtime = useRuntimeConfig();
const route = useRoute();

const productId = route.params.id;
const apiUrl = `${runtime.public.baseApiUrl}/products/${productId}`;

const { data, error, pending } = await useFetch(apiUrl);
</script>

<template>
    <div class="container">
        <Loading v-if="pending" />
        <div class="imageBox">
            <img :src="data.product.image_url" alt="" />
        </div>

        <div class="productBox">
            <div class="productInfo">
                <h1>{{ data.product.name }}</h1>
                <p>{{ data.product.description }}</p>
                <span>Category: {{ data.product.category }}</span>
            </div>

            <h2>{{ currencyFormat(data.product.price) }}</h2>
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

@media (width <= 600px) {
    .container {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 1rem;
        padding-top: 4.5rem;
    }
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
        object-fit: contain;
        border-radius: 8px;
    }
}

@media (width <= 600px) {
    .imageBox {
        max-width: 80%;
        padding: 0;
        margin: 0;
        img {
            width: 80%;
        }
    }
}

.productBox {
    width: 50%;
    height: 400px;
    max-width: 600px;
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
        color: var(--color-text-primary);
    }
}

@media (width <= 600px) {
    .productBox {
        width: 100%;
        height: fit-content;
        height: auto;
        padding: 0;
        margin: 0;
        align-items: center;
        gap: 24px;
        .productInfo {
            gap: 8px;
            h1 {
                font-size: 1.5rem;
                text-align: center;
            }
            p {
                text-align: center;
            }
            span {
                text-align: center;
                width: 100%;
            }
        }

        h2 {
           font-weight: 800;
            text-align: center;
        }
    }
}
</style>
