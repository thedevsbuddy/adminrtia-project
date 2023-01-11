require('./bootstrap')

import { createApp, h } from 'vue'
import { createInertiaApp, Link  } from '@inertiajs/inertia-vue3'
import AdminrLayout from "./Layouts/AdminrLayout";
import Icon from "./Components/Icon"
import Dropdown from "./Components/Global/Dropdown";
import DropdownItem from "./Components/Global/DropdownItem";
import PageHeader from "./Components/Adminr/PageHeader";

createInertiaApp({
    resolve: name => {
        const page = require(`./Pages/${name}`).default
        page.layout = page.layout || AdminrLayout
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('icon', Icon)
            .component('dropdown', Dropdown)
            .component('dropdown-item', DropdownItem)
            .component('page-header', PageHeader)
            .component('Link', Link)
            .mixin({methods: {route}})
            .mount(el)
    },
})

