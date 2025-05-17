<template>
    <div class="loadingContainer">
        <span class="circle">
            <span class="center"> </span>
        </span>
        <!-- <h1>Loading...</h1> -->
    </div>
</template>

<style scoped>
.loadingContainer {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100dvh;
    background-color: var(--color-bg-terciary);
    z-index: 10001;
    position: absolute;

    .circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(
            45deg,
            var(--color-bg-terciary),
            var(--color-text-primary)
        );

        animation: rotate 2s linear infinite;

        display: flex;
        justify-content: center;
        align-items: center;

        .center {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background-color: var(--color-bg-secondary);
        }
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
