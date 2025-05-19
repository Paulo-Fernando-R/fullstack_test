
<script setup lang="ts">
import { computed, defineProps, defineEmits } from "vue";

const props = defineProps({
    modelValue: {
        type: Number,
        default: 0,
    },
    label: String,
    id: String,
    name: String,
    placeholder: String,
    disabled: Boolean,
    required: Boolean,
    maxlength: Number,
    minlength: Number,
});

const emit = defineEmits(["update:modelValue"]);

const formattedValue = computed(() => {
    if (isNaN(props.modelValue)) return "";
    return props.modelValue.toLocaleString("en-US", {
        style: "currency",
        currency: "USD",
    });
});

function handleInput(event: Event) {
    const input = event.target as HTMLInputElement;
    const onlyDigits = input.value.replace(/\D/g, "");
    const numericValue = parseFloat(onlyDigits) / 100;
    emit("update:modelValue", isNaN(numericValue) ? 0 : numericValue);
}
</script>

<template>
    <div class="inputBox">
        <label v-if="label" :for="id">{{ label }}</label>

        <input
            :id="id"
            :name="name"
            :placeholder="placeholder"
            :disabled="disabled"
            :required="required"
            :maxlength="maxlength"
            :minlength="minlength"
            :value="formattedValue"
            @input="handleInput"
            type="text"
        />
    </div>
</template>

<style scoped>
.inputBox {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
    max-width: 600px;
}

.inputBox label {
    font-size: 0.8rem;
    color: var(--color-text-secondary);
    margin-right: 0.5rem;
}

.inputBox input {
    padding: 8px 8px;
    border-radius: 8px;
    border: 1px solid var(--color-text-terciary);
    stroke: none;
    outline: none;
    font-size: 0.8rem;
    width: 100%;
}
</style>
