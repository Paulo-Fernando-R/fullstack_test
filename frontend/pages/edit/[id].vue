<script setup lang="ts">
import { currencyFormat } from "@/utils/textFormat";

const runtime = useRuntimeConfig();
const route = useRoute();
const router = useRouter();
const toast = useToast();

const productId = route.params.id;
const apiUrl = `${runtime.public.baseApiUrl}/products/${productId}`;
const { data, error, pending } = await useFetch(apiUrl);
const loading = ref(false);

const form = ref({
    name: data.value.product.name,
    price: data.value.product.price,
    category: data.value.product.category,
    image_url: data.value.product.image_url,
    description: data.value.product.description,
});

function navigate() {
    router.replace("/products/" + productId);
}

async function handleSubmit() {
    loading.value = true;
    const { data, error } = await useFetch(apiUrl, {
        method: "PUT",
        body: form.value,
    });

    if (error.value) {
        toast.error({ title: "Error!", message: "Something went wrong." });
        return;
    }

    toast.success({
        title: "Success!",
        message: "Product updated successfully.",
    });

    loading.value = false;
    await new Promise((resolve) => setTimeout(resolve, 2000));

    navigate();
}
</script>

<template>
    <Loading v-if="loading" />
    <div class="container">
        <h1>Editar Produto</h1>

        <form @submit.prevent="handleSubmit">
            <div class="inputBox">
                <label for="name">name</label>
                <input v-model="form.name" id="name" type="text" />
            </div>

            <div class="inputBox">
                <label for="preco">Price</label>
                <input
                    v-model.number="form.price"
                    id="price"
                    type="number"
                    step="0.01"
                />
            </div>
            <div class="inputBox">
                <label for="category">Category</label>
                <input v-model="form.category" id="category" type="text" />
            </div>

            <div class="inputBox">
                <label for="imgUrl">imgUrl</label>
                <input v-model="form.image_url" id="imgUrl" type="url" />
            </div>

            <div class="inputBox">
                <label for="descricao">Description</label>
                <textarea
                    v-model="form.description"
                    id="description"
                ></textarea>
            </div>

            <button type="submit">Salvar</button>
        </form>

        <div v-if="mensagem">{{ mensagem }}</div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    gap: 20px;
    padding-top: 5rem;
}

form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 80%;
    max-width: 600px;
    align-items: center;

    .inputBox {
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 100%;
        max-width: 600px;

        label {
            font-size: 0.8rem;
            color: var(--color-text-secondary);
            margin-right: 0.5rem;
        }
    }

    input {
        padding: 8px 8px;
        border-radius: 8px;
        border: 1px solid var(--color-text-terciary);
        stroke: none;
        outline: none;
        font-size: 0.8rem;
        width: 100%;
        /* max-width: 300px; */
    }
    textarea {
        padding: 8px 8px;
        border-radius: 8px;
        border: 1px solid var(--color-text-terciary);
        stroke: none;
        outline: none;
        font-size: 0.8rem;
        width: 100%;

        height: 100px;
    }
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
}
</style>
