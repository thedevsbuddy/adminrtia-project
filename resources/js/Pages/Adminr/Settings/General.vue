<template>

    <Head title="General Settings" />

    <section>
        <page-header title="Update general settings" />
        <div>
            <form @submit.prevent="storeSettings">
                <card>
                    <card-header>
                        <h3 class="heading-sm">Manage General Settings</h3>
                    </card-header>
                    <card-content class="relative">
                        <loading-progress v-if="form.processing" :message="`Loading (${form.progress.percentage}%)`" />
                        <!-- Show splash message -->
                        <splash-message />
                        <div class="flex space-x-6">
                            <div class="w-2/3">
                                <div class="grid grid-cols-1 gap-x-6 gap-y-2">
                                    <form-input label="App Name" :error="form.errors.app_name" required
                                        v-model="form.app_name" :value="form.app_name"
                                        placeholder="Eg: Adminr Generator" />
                                    <form-input label="App Tag Line" :error="form.errors.app_tagline" required
                                        v-model="form.app_tagline" :value="form.app_tagline"
                                        placeholder="Awesome document builds here." />
                                    <form-input label="App meta title" :error="form.errors.meta_title" type="text"
                                        required v-model="form.meta_title" :value="form.meta_title"
                                        placeholder="Adminr - The ultimate admin template and generator." />
                                    <form-input multiline label="Meta Desctiption" :error="form.errors.meta_description"
                                        type="text" required v-model="form.meta_description"
                                        :value="form.meta_description" rows="5" class="resize-none"
                                        placeholder="Generate CRUDs within minutes with our easy to use GUI." />
                                    <form-select
                                        :options="[{ value: '-', label: 'Hyphen (-)' }, { value: '|', label: 'Pipe sign (|)' }, { value: '~', label: 'Tilda (~)' }]"
                                        label="Title separator" v-model="form.title_separator"
                                        :error="form.errors.title_separator" placeholder="Title separator" />
                                </div>
                            </div>
                            <div class="w-1/3">
                                <div class="space-y-4 pt-6">
                                    <form-avatar-input label="App Logo" v-model="form.app_logo"
                                        :default="asset(`${getSetting('app_logo') ?? 'images/logo-placeholder.png'}`)" />
                                    <form-avatar-input label="App Favicon" v-model="form.app_favicon"
                                        :default="asset(`${getSetting('app_favicon') ?? 'images/logo-placeholder.png'}`)" />
                                </div>
                            </div>
                        </div>
                    </card-content>
                    <card-footer class="justify-end">
                        <XButton type="submit" :hero-icon="FolderPlusIcon" :is-busy="form.processing" label="Save" />
                    </card-footer>
                </card>
            </form>
        </div>
    </section>
</template>
<script setup>
import { FolderPlusIcon } from '@heroicons/vue/24/outline'
import useValidatedForm from "@/Composables/useValidatedForm";
import { isRequired } from "intus/rules";


const form = useValidatedForm({
    app_name: [getSetting('app_name'), [isRequired()]],
    app_tagline: [getSetting('app_tagline'), [isRequired()]],
    meta_title: [getSetting('meta_title'), [isRequired()]],
    meta_description: [getSetting('meta_description'), [isRequired()]],
    title_separator: [getSetting('title_separator'), [isRequired()]],
    app_logo: [null, []],
    app_favicon: [null, []],
});

function storeSettings() {
    form.post(route('adminr.settings.store'), {
        preserveScroll: true,
        onSuccess: () => { },
    });
}

</script>
