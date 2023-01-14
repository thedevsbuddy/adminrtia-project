require('./bootstrap')

import {createApp, h} from 'vue'
import {createInertiaApp, Link, Head} from '@inertiajs/inertia-vue3'
import {Inertia} from '@inertiajs/inertia'
import AdminrLayout from "./Layouts/AdminrLayout";
import { InertiaProgress } from '@inertiajs/progress'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

window.Inertia = Inertia;

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout = page.layout || AdminrLayout
        return page
    },
    setup({el, App, props, plugin}) {
        const app = createApp({render: () => h(App, props)})
            .use(plugin)
            .mixin({methods: {route}})

        app.component('Link', Link)
        app.component('Head', Head)

        /// Loading all components automatically
        const files = require.context('./Components/', true, /\.vue$/i)
        files.keys().map(key => app.component(key.split('/').pop().split('.')[0], files(key).default))
        app.config.devtools = true;

        const options = {
            // You can set your default options here
        };

        app.use(Toast, options);
        app.mount(el)
    },
})

InertiaProgress.init();
