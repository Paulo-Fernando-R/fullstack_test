import { createPinia } from "pinia";
import piniaPluginPersistedstate from "pinia-plugin-persistedstate";
import type { Pinia } from "pinia";
const pinia = createPinia();

export default defineNuxtPlugin(({ pinia: Pinia }) => {
    pinia.use(piniaPluginPersistedstate);
});
