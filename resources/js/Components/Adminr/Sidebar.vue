<template>
    <div class="flex flex-col w-72 bg-slate-800 text-light border-r border-slate-700 z-50">
        <Link :href="route('adminr.dashboard')" class="h-14 shrink-0 px-4 py-2 flex items-center justify-center">
        <img v-if="getSetting('app_name')" :src="asset(getSetting('app_logo'))" class="h-8 w-auto"
            :alt="`${getSetting('app_name')} ${getSetting('title_separator')} ${getSetting('app_tagline')}`">
        <span v-else class="block text-lg font-semibold">
            {{ getSetting('app_name') }}
        </span>
        </Link>
        <div class="grow h-full overflow-y-auto">
            <nav>
                <ul>
                    <li
                        :class="`hover:bg-slate-700 ${$page.props.currentRoute === 'adminr.dashboard' ? 'bg-slate-700' : ''}`">
                        <Link :href="route('adminr.dashboard')"
                            class="flex items-center text-sm space-x-4 px-4 py-2 rounded">
                        <icon cicon name="speedometer" class="w-4 h-4" />
                        <span>Dashboard</span>
                        </Link>
                    </li>
                    <li>
                        <span class="block text-xs font-semibold text-slate-400 uppercase px-4 py-2 mt-2">
                            Resources
                        </span>
                    </li>
                    <li v-for="(resourceRoute, index) in resourceRoutes" :key="index"
                        :class="`${resourceRoute.type !== 'label' ? 'hover:bg-slate-700' : ''} ${$page.props.currentRoute === resourceRoute.route ? 'bg-slate-700' : ''}`">
                        <!-- <span v-if="resourceRoute.type === 'label'"
                            class="block text-xs font-semibold text-slate-400 uppercase px-4 py-2 mt-2">{{
                                resourceRoute.label
                            }}</span> -->
                        <Link :href="route(resourceRoute.route)"
                            class="flex items-center text-sm space-x-4 px-4 py-2 rounded">
                        <icon :cicon="resourceRoute.cicon" :name="resourceRoute.icon" class="w-4 h-4" />
                        <span>{{ resourceRoute.label }}</span>
                        </Link>
                    </li>
                    <li v-for="(navItem, index) in navItems" :key="index"
                        :class="`${navItem.type !== 'label' ? 'hover:bg-slate-700' : ''} ${$page.props.currentRoute === navItem.route ? 'bg-slate-700' : ''}`">
                        <span v-if="navItem.type === 'label'"
                            class="block text-xs font-semibold text-slate-400 uppercase px-4 py-2 mt-2">{{
                                navItem.label
                            }}</span>
                        <Link v-else :href="route(navItem.route)"
                            class="flex items-center text-sm space-x-4 px-4 py-2 rounded">
                        <icon :cicon="navItem.cicon" :name="navItem.icon" class="w-4 h-4" />
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

const resourceRoutes = [
    {
        label: "Tenants",
        icon: "folder",
        cicon: true,
        route: "index",
        type: "link"
    },
];
const navItems = [
    {
        label: "Permissible",
        type: "label"
    },
    {
        label: "Roles & Permissions",
        icon: "star",
        cicon: true,
        route: "adminr.roles-and-permissions.index",
        type: "link"
    },
    {
        label: "Users",
        icon: "user",
        cicon: true,
        route: "adminr.users.index",
        type: "link"
    },
]
const props = defineProps({

})
</script>
