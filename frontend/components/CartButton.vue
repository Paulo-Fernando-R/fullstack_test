<script setup lang="ts">
import type { Product } from "../types/product";

const toast = useToast();
const props = defineProps({
    product: {
        type: Object as () => Product,
        required: true,
    },
});

const cart = useCartStore();

function handleClick() {
    //  console.log(props.product);
    cart.addToCart(props.product);
    toast.success({
        title: "Success!",
        message: "Product added to cart successfully.",
    });
}
</script>

<template>
    <button @click.stop="handleClick">Add to Cart</button>
</template>

<style scoped>
button {
    background-color: var(--color-text-primary);
    color: var(--color-bg-primary);
    border: none;
    padding: 8px 16px;
    width: 100%;
    height: 50px;
    max-width: 200px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
}
</style>
