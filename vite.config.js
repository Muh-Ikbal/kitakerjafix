import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/slider.scss",
                "resources/css/contact.css",
                "resources/css/card.css",
                "resources/css/modal.css",
                "resources/js/modal.js",
            ],
            refresh: true,
        }),
    ],
    optimizeDeps: {
        include: ["swiper"],
    },
});
