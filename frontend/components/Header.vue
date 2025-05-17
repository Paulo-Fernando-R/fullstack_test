<!-- components/Header.vue -->
<template>
    <div class="header">
        <h1 class="text-xl font-bold">Ecommerce</h1>
        <nav>
            <NuxtLink to="/" class="link">
                <Icon name="ic:baseline-shopping-cart" size="1.5rem"
            /></NuxtLink>
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

    color: var(--color-text-secondary);
}
</style>
