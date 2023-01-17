<template>

    <Head title="Features Settings" />

    <section>
        <page-header title="Update Features Settings" />
        <div>
            <form @submit.prevent="storeSettings">
                <card class="bg-white">
                    <card-header>
                        <h3 class="heading-sm">Features Settings</h3>
                    </card-header>
                    <card-content class="relative md:px-6 md:py-4">
                        <loading-progress v-if="form.processing" :message="`Loading (${form.progress.percentage}%)`" />
                        <!-- Show splash message -->
                        <splash-message />

                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-5">

                            <form-select label="Email Verification"
                                :options="[{ value: '1', label: 'Enabled' }, { value: '0', label: 'Disabled' }]"
                                v-model="form.email_verification_enabled"
                                :error="form.errors.email_verification_enabled"
                                placeholder="Email verification feature" />
                            <form-select label="Email Queues"
                                :options="[{ value: '1', label: 'Enabled' }, { value: '0', label: 'Disabled' }]"
                                v-model="form.mail_queue_enabled" :error="form.errors.mail_queue_enabled"
                                placeholder="Email in queue feature" />
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
    email_verification_enabled: [getSetting('email_verification_enabled'), [isRequired()]],
    mail_queue_enabled: [getSetting('mail_queue_enabled'), [isRequired()]],
});

function storeSettings() {
    form.post(route('adminr.settings.store'), {
        preserveScroll: true,
        onSuccess: () => { },
    });
}

</script>
