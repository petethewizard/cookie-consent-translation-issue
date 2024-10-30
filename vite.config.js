import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "resources/js/classes/Homepage.js",
                "resources/js/classes/Products.js",
                "resources/js/classes/Contacts.js",
                "resources/js/classes/Gallery.js",
                "resources/js/classes/Common.js",
                "resources/js/classes/DeviceDetection.js",
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: "resources/assets",
                    dest: "public/assets",
                },
            ],
        }),
    ],
});
