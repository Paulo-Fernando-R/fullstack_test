<script setup lang="ts">
import { ref } from "vue";

const runtime = useRuntimeConfig();
const baseUrl = `${runtime.public.baseApiUrl}/products/categories`;

const text = defineModel("text");
const selected = defineModel("selected");
const checked = defineModel("checked");
const emits = defineEmits(["keyup"]);

const { data, status, error } = await useFetch(baseUrl);

const handleSearch = () => {
    emits("keyup");
};
</script>

<template>
    <div class="filterBox">
        <input
            v-model="text"
            placeholder="Search"
            @keyup.enter="handleSearch"
        />
        <div class="filters">
            <select v-model="selected">
                <option value="" selected>Select a category</option>
                <option v-for="e in data.categories" :value="e" :key="e">
                    {{ e }}
                </option>
            </select>

            <div class="checkbox">
                <label for="checkbox">With images</label>
                <input type="checkbox" id="checkbox" v-model="checked" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.filterBox {
    width: 100%;

    display: flex;
    justify-content: flex-start;
    align-items: center;
    padding: 1rem 2rem;
    margin-top: -4px;
    gap: 16px;

    input {
        padding: 8px 8px;
        border-radius: 8px;
        border: 1px solid var(--color-text-terciary);
        stroke: none;
        outline: none;
        font-size: 0.8rem;
        width: 30%;
        max-width: 300px;
    }

    .filters {
        display: flex;
        justify-content: center;
        gap: 16px;
        align-items: center;

        .checkbox {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0px;
            background-color: var(--color-bg-secondary);
            padding: 8px 16px;
            border-radius: 8px;
        }

        label {
            font-size: 0.8rem;
            color: var(--color-text-secondary);
            margin-right: 0.5rem;
        }
        input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
            cursor: pointer;
        }
        input[type="checkbox"]:checked {
            background-color: var(--color-text-secondary);
        }
    }

    select {
        padding: 8px 8px;
        border-radius: 8px;
        border: 1px solid var(--color-text-terciary);
        stroke: none;
        outline: none;
        font-size: 0.8rem;
        color: var(--color-text-secondary);
        width: 150px;
    }
}

@media (width <= 600px) {
    .filterBox {
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: 1rem;

        input {
            width: 100%;
            max-width: 100%;
        }
        select {
            width: 100%;
            max-width: 100%;
        }
        .filters {
            width: 100%;
            align-items: space-between;
            gap: 8px;

            .checkbox {
            width: 100%;
            justify-content: space-between;
            padding: 8px ;
        }
        }

    }
}
</style>
