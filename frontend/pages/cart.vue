<script setup lang="ts">
import { currencyFormat } from "@/utils/textFormat";

const toast = useToast();
const cart = useCartStore();

function remove(id: number) {
    cart.removeFromCart(id);
    toast.info({
        title: "Info",
        message: "Product removed from cart successfully",
    });
}

function decreaseQuantity(id: number) {
    if (cart.items.find((item) => item.id === id)?.quantity === 1) {
        remove(id);
        return;
    }
    cart.decreaseQuantity(id);
}
//console.log(cart.items);
</script>

<template>
    <div class="container">
        <h1>My Cart</h1>
        <div class="list">
            <div class="item" v-for="item in cart.items" :key="item.id">
                <img :src="item.image_url" alt="" />
                <div class="productInfo">
                    <p>{{ item.name }}</p>
                    <p class="price">
                        {{ currencyFormat(item.price) }}
                    </p>
                    <p>Quntity: {{ item.quantity }}</p>
                     <p class="price">
                    Total:
                    {{ currencyFormat(item.price * item.quantity) }}
                </p>
                </div>

                <div class="buttons">
                    <button class="quantity" @click="decreaseQuantity(item.id)">
                        -
                    </button>
                    <button
                        class="quantity"
                        @click="cart.increaseQuantity(item.id)"
                    >
                        +
                    </button>
                    <button @click="remove(item.id)">Remove</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: start;
    width: 100%;
    min-height: 100vh;
    padding-top: 5rem;
    gap: 2rem;
}

.list {
    width: 80%;
    max-width: 1400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    gap: 16px;
}

@media (width <= 600px) {
    .list {
        width: 100%;
        padding: 0 1rem;
    }
}

.item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    background-color: var(--color-bg-secondary);
    padding: 1rem;
    border-radius: 8px;
    width: 100%;

    img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        border-radius: 8px;
          mix-blend-mode: multiply;
    }

    p {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-text-secondary);
        line-height: .9rem;
    }
    button {
        background-color: var(--color-text-primary);
        color: var(--color-bg-primary);
        border: none;
        padding: 4px 8px;
        height: 24px;

        border-radius: 4px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 500;
    }
    .price {
        font-size: 1rem;
        font-weight: 800;
        color: var(--color-text-primary);
    }

    @media (width <= 600px) {
        img {
            width: 60px;
            height: 60px;
        }
        p {
            font-size: 0.7rem;
        }
        .price {
            font-size: 0.9rem;
        }
        button {
            font-size: 0.7rem;

        }
    }
}



.productInfo {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: start;
    gap: 10px;
    flex: 1;
    word-wrap: break-word;
}

.buttons {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 8px;
    flex: 1;

    .quantity {
        width: 24px;
        display: flex;
        justify-content: center;
        align-items: center;

    }
}

@media (width <= 600px) {
   .buttons{
        flex-direction: column;
        gap: 4px;

        .quantity {
            width: 20px;
            height: 20px;
        }
    }
    .productInfo{
        width: 50%;
        flex: 2;
    }


}
</style>
