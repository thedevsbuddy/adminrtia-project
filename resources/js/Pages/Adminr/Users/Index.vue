<template>

    <Head title="Users management" />

    <section>
        <page-header title="Manage Users">
            <XButton as="link" :href="route('adminr.users.create')" icon="plus" label="Add New" />
        </page-header>

        <div>
            <Card>
                <CardHeader class="justify-between">
                    <h3 class="heading-sm">Users list in the system</h3>
                    <div>
                        <form-input placeholder="Search here..." :value="filters.term" v-model="filters.term"
                            input-style="rounded-full " />
                    </div>
                </CardHeader>
                <CardContent class="px-0 py-0">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b text-sm">
                            <tr class="divide-x">
                                <th class="p-2 text-center">Sr.</th>
                                <th class="p-2 text-left"></th>
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Username</th>
                                <th class="p-2 text-left">Email</th>
                                <th class="p-2 text-left">Phone</th>
                                <th class="p-2 text-center">Status</th>
                                <th class="p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" v-if="props.users.data.length">
                            <tr v-for="(user, index) in props.users.data" :key="user.id"
                                class="divide-x text-sm odd:bg-white even:bg-light">
                                <td class="text-center p-2 w-12">{{ ++index }}</td>
                                <td class="p-2 text-center w-16"><img :src="asset(user.avatar)"
                                        class="rounded-full w-12 h-12" alt=""></td>
                                <td class="p-2">{{ user.name }}</td>
                                <td class="p-2">{{ user.username }}</td>
                                <td class="p-2">{{ user.email }}</td>
                                <td class="p-2">{{ user.phone }}</td>
                                <td class="p-2 text-center">
                                    <span
                                        :class="`inline-block px-3 py-1 rounded-full text-xs font-semibold tracking-wider ${user.is_verified ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'}`">{{
                                            user.is_verified ? 'Verified' : 'Not Verified'
                                        }}</span>
                                </td>
                                <td class="p-2 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <XButton as="link" :href="route('adminr.users.edit', user.id)"
                                            class="bg-blue-200 text-blue-600" :hero-icon="PencilSquareIcon" />
                                        <XButton as="link" method="DELETE"
                                            :href="route('adminr.users.destroy', user.id)"
                                            class="bg-red-200 text-red-600" :hero-icon="TrashIcon" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="12">
                                    <div class="flex w-full flex-col items-center justify-center py-8 md:py-12">
                                        <img :src="asset('images/no-users.png')" class="w-56" alt="">
                                        <p class="text-3xl font-semibold text-slate-500 mt-5">No Users found.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </CardContent>
                <CardFooter class="justify-end">
                    <pagination :links="props.users.links" />
                </CardFooter>
            </Card>
        </div>
    </section>
</template>
<script setup>
import { TrashIcon, PencilSquareIcon } from "@heroicons/vue/24/solid";
import { ref, watch, reactive } from "vue";
import moment from 'moment';

/// Props
const props = defineProps({
    users: Object,
    query: Object,
})


/// Search Stuffs
const filters = reactive({
    term: props.query.term ?? null,
    field: props.query.field ?? null,
    sort: props.query.sort ?? null,
});

const searchUser = _.debounce((newFilters) => {
    Inertia.get(route('adminr.users.index'), _.pickBy(newFilters), { replace: true, preserveState: true });
}, 200);

/// Watchers
watch(() => filters, async (newFilters) => {
    searchUser(newFilters);
}, { deep: true });

</script>
