<script setup lang="ts">
import { currencyFormat } from "@/utils/textFormat";
import { productSchema } from "@/validation/productSchema";
import { ValidationError } from "yup";

const runtime = useRuntimeConfig();

const router = useRouter();
const toast = useToast();

const apiUrl = `${runtime.public.baseApiUrl}/products`;
const loading = ref(false);

const form = ref({
    name: "",
    price: "",
    category: "",
    image_url: "",
    description: "",
});
const errors = ref<Record<string, string>>({});

async function validateForm(): Promise<boolean> {
    try {
        await productSchema.validate(form.value, { abortEarly: false });
        errors.value = {};
        return true;
    } catch (err) {
        if (err instanceof ValidationError) {
            const errorMap: Record<string, string> = {};
            err.inner.forEach((e) => {
                if (e.path) errorMap[e.path] = e.message;
            });
            errors.value = errorMap;
        }
        return false;
    }
}

async function handleSubmit() {
    const isValid = await validateForm();

    if (!isValid) {
        toast.error({
            title: "Erro",
            message: "Verifique os campos inválidos.",
        });
        return;
    }

    loading.value = true;
    const { data, error } = await useFetch(apiUrl, {
        method: "POST",
        body: form.value,
    });

    if (error.value) {
        toast.error({ title: "Error!", message: "Something went wrong." });
        loading.value = false;
        return;
    }

    toast.success({
        title: "Success!",
        message: "Product updated successfully.",
    });

    loading.value = false;
    await new Promise((resolve) => setTimeout(resolve, 2000));
}
</script>

<template>
    <Loading v-if="loading" />
    <div class="container">
        <h1>Create Product</h1>

        <form @submit.prevent="handleSubmit">
            <div class="inputBox">
                <label for="name">name</label>
                <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    placeholder="Enter name"
                />
                <span class="error" v-if="errors.name">{{ errors.name }}</span>
            </div>

            <div class="inputBox">
                <CurrencyInput
                    v-model="form.price"
                    label="Price"
                    id="price"
                    name="price"
                    placeholder="Enter price"
                />
                <span class="error" v-if="errors.price">{{
                    errors.price
                }}</span>
            </div>

            <div class="inputBox">
                <label for="category">Category</label>
                <input
                    v-model="form.category"
                    id="category"
                    type="text"
                    placeholder="Enter category"
                />
                <span class="error" v-if="errors.category">{{
                    errors.category
                }}</span>
            </div>

            <div class="inputBox">
                <label for="imgUrl">Image Url</label>
                <input
                    v-model="form.image_url"
                    id="imgUrl"
                    type="url"
                    placeholder="Enter Image Url"
                />
                <span class="error" v-if="errors.image_url">{{
                    errors.image_url
                }}</span>
            </div>

            <div class="inputBox">
                <label for="descricao">Description</label>
                <textarea
                    v-model="form.description"
                    id="description"
                    placeholder="Enter description"
                ></textarea>
                <span class="error" v-if="errors.description">{{
                    errors.description
                }}</span>
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
    .error {
        color: red;
        font-size: 0.75rem;
    }
}
@media (max-width: 600px) {
    .container {
        padding-top: 8rem;
    }
}
</style>
