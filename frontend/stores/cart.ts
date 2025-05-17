import type { Product } from "@/types/product";
import { defineStore } from "pinia";


interface CartItem extends Product {
    quantity: number;
}

export const useCartStore = defineStore("cart", {
    state: () => ({
        items: [] as CartItem[],
    }),

    actions: {
        addToCart(product: Product) {
            const existing = this.items.find((p) => p.id === product.id);
            if (existing) {
                existing.quantity++;
            } else {
                this.items.push({ ...product, quantity: 1 });
            }
        },

        removeFromCart(productId: number) {
            this.items = this.items.filter((p) => p.id !== productId);
        },

        increaseQuantity(productId: number) {
            const item = this.items.find((p) => p.id === productId);
            if (item) item.quantity++;
        },

        decreaseQuantity(productId: number) {
            const item = this.items.find((p) => p.id === productId);
            if (item) {
                item.quantity--;
                if (item.quantity <= 0) this.removeFromCart(productId);
            }
        },

        clearCart() {
            this.items = [];
        },
    },

    persist: true,
});
