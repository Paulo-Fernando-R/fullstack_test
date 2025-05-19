<!-- components/Header.vue -->

<script setup lang="ts">
const cart = useCartStore();

const qtd = computed(() => {
    return cart.items.length;
});
</script>
<template>
    <div class="header">
        <NuxtLink to="/" class="link">
            <h1 class="text-xl font-bold">Ecommerce</h1>
        </NuxtLink>

        <NuxtLink to="/create" class="create">
            <h1 class="text-xl font-bold">
                Create Product <strong>(i)</strong>
            </h1>
            <span>
                (This option has no context. It is only used to perform crud
                operations.)</span
            >
        </NuxtLink>

        <nav>
            <NuxtLink to="/cart" class="link">
                <Icon name="ic:baseline-shopping-cart" size="1.7rem" />
                <span class="badge">{{ qtd }}</span>
            </NuxtLink>
        </nav>
    </div>
</template>

<style scoped>
.header {
    background-color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    position: fixed;
    z-index: 1000;
    width: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 0 0 1rem 1rem;
}
h1 {
    font-size: 1.1rem;
    font-weight: semibold;
    color: var(--color-text-secondary);
}
.link {
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: semibold;
    position: relative;
    color: var(--color-text-secondary);

    .badge {
        color: var(--color-bg-primary);
        font-weight: 400;
        font-size: 0.8rem;
        position: absolute;
        top: -17px;
        right: -8px;
        background-color: var(--color-primary);
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}

.create {
    text-decoration: underline var(--color-text-secondary);
    position: relative;
    display: flex;
    align-items: center;

    h1 {
        font-size: 0.8rem;
        font-weight: semibold;
        color: var(--color-text-secondary);
    }

    flex-direction: column;
    span {
        display: none;
        font-size: 0.7rem;
    }
}

.create:hover {
    span {
        display: block;
        font-size: 0.7rem;
        color: var(--color-text-secondary);
        font-weight: 400;
        text-align: center;
        position: absolute;
        top: 30px;
        border-radius: 8px;
        padding: 8px;
        background-color: var(--color-bg-primary);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        width: 200px;
        strong {
            font-size: 0.5rem;
        }
    }
}
</style>
