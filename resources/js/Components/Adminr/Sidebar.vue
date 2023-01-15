<template>
    <div class="flex flex-col w-72 bg-slate-800 text-light border-r border-slate-700">
        <div class="h-12 shrink-0 px-4 py-2 flex items-center  justify-center">
            <span class="block text-lg font-semibold">App Name</span>
        </div>
        <div class="grow h-full overflow-y-auto">
            <nav>
                <ul>
                    <li v-for="(navItem, index) in navItems" :key="index"
                        :class="`${navItem.type !== 'label' ? 'hover:bg-slate-700' : ''} ${$page.props.currentRoute === navItem.route ? 'bg-slate-700' : ''}`">
                        <span v-if="navItem.type === 'label'"
                            class="block text-xs font-semibold text-slate-400 uppercase px-4 py-2 mt-2">{{
                                navItem.label
                            }}</span>
                        <Link v-else :href="route(navItem.route)"
                            class="flex items-center text-sm space-x-2 px-4 py-2 rounded">
                        <icon :name="navItem.icon" class="w-4 h-4" />
                        <span>{{ navItem.label }}</span>
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="min-h-12 shrink-0 px-3 pb-2">
            <h3 class="heading2 text-light font-semibold leading-snug">Adminrtia</h3>
            <small class="text-xs leading-snug">Version: V1.0</small>
        </div>
    </div>
</template>
<script setup>
import { defineProps } from "vue";
const navItems = [
    {
        label: "Dashboard",
        icon: "dashboard",
        route: "adminr.dashboard",
        type: "link"
    },
    {
        label: "Resources",
        type: "label"
    },
    {
        label: "Tenants",
        icon: "dashboard",
        route: "adminr.dashboard",
        type: "link"
    },
    {
        label: "Permissible",
        type: "label"
    },
    {
        label: "Roles & Permissions",
        icon: "dashboard",
        route: "adminr.dashboard",
        type: "link"
    },
    {
        label: "Users",
        icon: "user",
        route: "adminr.users.index",
        type: "link"
    },
]
const props = defineProps({

})
</script>
