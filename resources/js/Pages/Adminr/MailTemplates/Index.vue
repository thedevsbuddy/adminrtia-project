<template>

    <Head title="Mail Templates" />

    <section>
        <splash-message />
        <page-header title="Manage mail templates">
            <XButton as="link" :href="route('adminr.templates.create')" icon="plus" label="Add New" />
        </page-header>

        <div>
            <card>
                <card-header class="justify-between">
                    <h3 class="heading-sm">All Templates</h3>
                    <div>
                        <form-input placeholder="Search here..." :value="filters.term" v-model="filters.term"
                            input-style="rounded-full " />
                    </div>
                </card-header>
                <card-content class="px-0 py-0">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b text-sm">
                            <tr class="divide-x">
                                <th class="p-2 text-center">Sr.</th>
                                <th class="p-2 text-left">Subject</th>
                                <th class="p-2 text-left">Purpose</th>
                                <th class="p-2 text-left">Code</th>
                                <th class="p-2 text-left">Content</th>
                                <th class="p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y" v-if="props.templates.data.length">
                            <tr v-for="(template, index) in props.templates.data" :key="template.id"
                                class="divide-x text-sm odd:bg-white even:bg-light">
                                <td class="text-center p-2 w-12">{{ ++index }}</td>
                                <td class="p-2">{{ template.subject }}</td>
                                <td class="p-2">{{ template.purpose }}</td>
                                <td class="p-2">{{ template.code }}</td>
                                <td class="p-2">{{ template.content }}</td>
                                <td class="p-2 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <XButton as="link" :href="route('adminr.templates.edit', template.id)"
                                            class="bg-blue-200 text-blue-600" :hero-icon="PencilSquareIcon" />
                                        <XButton as="link" method="DELETE"
                                            :href="route('adminr.templates.destroy', template.id)"
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
                                        <p class="text-3xl font-semibold text-slate-500 mt-5">No Templates found.</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </card-content>
                <card-footer class="justify-end"
                    v-if="props.templates.next_page_url != null && props.templates.prev_page_url != null">
                    <pagination :links="props.templates.links" />
                </card-footer>
            </card>
        </div>
    </section>
</template>
<script setup>
import { TrashIcon, PencilSquareIcon } from "@heroicons/vue/24/solid";
import { watch, reactive } from "vue";
import moment from 'moment';

/// Props
const props = defineProps({
    templates: Object,
    query: Object,
})


/// Search Stuffs
const filters = reactive({
    term: props.query.term ?? null,
});

const searchTemplates = _.debounce((newFilters) => {
    Inertia.get(route('adminr.templates.index'), _.pickBy(newFilters), { replace: true, preserveState: true });
}, 200);

/// Watchers
watch(() => filters, async (newFilters) => {
    searchTemplates(newFilters);
}, { deep: true });

</script>
