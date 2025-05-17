<template>
    <div class="imgBox">
        <img src="../assets/images/shop.png" alt="" />
        <div class="textBox">
            <h1>Products</h1>
        </div>
    </div>
</template>

<style scoped>
.imgBox {
    width: 100%;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;

    img {
        width: 100vw;
        min-height: 200px;
        max-height: 250px;
        object-fit: cover;
    }
}

.textBox {
    position: absolute;
    top: 0px;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 2rem;

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--color-text-secondary);
    }
}
</style>
