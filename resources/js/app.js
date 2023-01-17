require("./bootstrap");
require("./Helpers/String");

import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import AdminrLayout from "./Layouts/AdminrLayout";
import { InertiaProgress } from "@inertiajs/progress";
import VMdEditor from "@kangc/v-md-editor";
import "@kangc/v-md-editor/lib/style/base-editor.css";
import githubTheme from "@kangc/v-md-editor/lib/theme/github.js";
import "@kangc/v-md-editor/lib/theme/style/github.css";
import enUS from "@kangc/v-md-editor/lib/lang/en-US";

// highlightjs
import hljs from "highlight.js";

VMdEditor.use(githubTheme, {
    Hljs: hljs,
});
VMdEditor.lang.use("en-US", enUS);

window.Inertia = Inertia;

/// Create asset helper for the vue app
function asset(path) {
    if (path.includes("http://") || path.includes("https://")) return path;
    var base_path = window._asset || "";
    return base_path + path;
}
window.asset = asset;

/// Share App Settings with vue app
function getSetting(key) {
    return (
        JSON.parse(window._settings.replaceAll("&quot;", `"`)).find(
            (s) => s.option == key
        )?.value ?? null
    );
}
window.getSetting = getSetting;

createInertiaApp({
    title: (title) =>
        `${title} ${getSetting("title_separator")} ${getSetting(
            "app_name"
        )} ${getSetting("title_separator")} ${getSetting("app_tagline")}`,
    resolve: (name) => {
        const page = require(`./Pages/${name}`).default;
        page.layout = page.layout || AdminrLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({
                methods: {
                    route,
                    asset,
                    getSetting,
                },
            });

        app.component("Link", Link);
        app.component("Head", Head);

        /// Loading all components automatically
        const files = require.context("./Components/", true, /\.vue$/i);
        files
            .keys()
            .map((key) =>
                app.component(
                    key.split("/").pop().split(".")[0],
                    files(key).default
                )
            );
        app.config.devtools = true;

        app.use(VMdEditor);
        app.mount(el);
    },
});

InertiaProgress.init();
