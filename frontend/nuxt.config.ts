// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
    compatibilityDate: "2025-05-15",
    devtools: { enabled: true },
    css: ["./assets/styles/colors.scss"],
    modules: [
        "@nuxt/icon",
        "@pinia/nuxt",
        "pinia-plugin-persistedstate/nuxt",
        "nuxt-toast",
    ],


    runtimeConfig: {
        public: {
            baseApiUrl: process.env.NUXT_BASE_API_URL,
        },
    },
});
