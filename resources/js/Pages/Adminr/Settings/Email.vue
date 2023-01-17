<template>

    <Head title="Email Settings" />

    <section>
        <!-- Send test email dialog -->
        <dialog-modal :show="testEmailModalOpened">
            <dialog-header title="Send test email" @close="testEmailModalOpened = false" />
            <dialog-content class="relative">
                <!-- <loading-progress v-if="testEmailForm.processing"
                    :message="`Loading (${testEmailForm.progress.percentage}%)`" /> -->
                <form-input label="Email" v-model="testEmailForm.email" required placeholder="Eg: johndoe@adminr.com" />
            </dialog-content>
            <dialog-footer>
                <XButton type="button"
                    class="outline-none ring-none !bg-transparent !text-primary border border-primary"
                    :label="`${testEmailForm.processing ? 'Sending (' + testEmailForm.progress.percentage + '%)' : 'Send mail'}`"
                    @click="sendTestEmail" />
                <XButton type="button"
                    class="outline-none ring-none !bg-transparent !text-slate-600 border border-slate-300"
                    label="Cancel" @click="testEmailModalOpened = false" />
            </dialog-footer>
        </dialog-modal>

        <!-- Page Header -->
        <page-header title="Update Email Settings" />
        <div>
            <form @submit.prevent="storeSettings">
                <card class="bg-white">
                    <card-header class="flex items-center justify-between">
                        <h3 class="heading-sm">Email Settings</h3>
                        <div>
                            <XButton @click="testEmailModalOpened = true" type="button" label="Send test email" />
                        </div>
                    </card-header>
                    <card-content class="relative md:px-4 md:py-4">
                        <loading-progress v-if="form.processing" :message="`Loading (${form.progress.percentage}%)`" />
                        <!-- Show splash message -->
                        <splash-message />
                        <div
                            class="flex items-center justify-between rounded-lg mb-3 px-4 py-3 text-sm tracking-wider bg-blue-50 text-blue-800">
                            <span>You can use the <a href="https://mailtrap.io" class="font-semibold hover:underline"
                                    target="_blank">mailtrap.io</a> service
                                for testing emails</span>
                        </div>
                        <div class="grid md:grid-cols-2 gap-x-6 gap-y-5">
                            <form-input label="Mail from name" :error="form.errors.mail_from_name" required
                                v-model="form.mail_from_name" :value="form.mail_from_name"
                                placeholder="Eg: Adminr Generator" />
                            <form-input label="Mail from email" :error="form.errors.mail_from_email" required
                                v-model="form.mail_from_email" :value="form.mail_from_email"
                                placeholder="Eg: no-reply@adminr.com" />
                            <form-select label="Mail driver"
                                :options="[{ value: 'smtp', label: 'SMTP' }, { value: 'sendgrid', label: 'Sendgrid' }]"
                                v-model="form.mail_driver" :error="form.errors.mail_driver"
                                placeholder="Select Mail driver" />
                            <form-select label="Mail Encryption"
                                :options="[{ value: 'ssl', label: 'SSL' }, { value: 'tls', label: 'TLS' }]"
                                v-model="form.mail_encryption" :error="form.errors.mail_encryption"
                                placeholder="Select encyption type" />
                            <form-input label="Mail host" :error="form.errors.mail_host" type="text" required
                                v-model="form.mail_host" :value="form.mail_host" placeholder="Eg: smtp.mailtrap.io" />
                            <form-input label="Mail Port" :error="form.errors.mail_port" type="text" required
                                v-model="form.mail_port" :value="form.mail_port" placeholder="Eg: 2525" />
                            <form-input label="Mail Username" :error="form.errors.mail_username" type="text" required
                                v-model="form.mail_username" :value="form.mail_username"
                                placeholder="Eg: mailer@adminr.com" />
                            <form-input label="Mail Password" :error="form.errors.mail_password" type="password"
                                required v-model="form.mail_password" :value="form.mail_password"
                                placeholder="********" />

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
import { isEmail, isRequired } from "intus/rules";
import { ref } from 'vue';


const testEmailModalOpened = ref(false);

const form = useValidatedForm({
    mail_from_name: [getSetting('mail_from_name'), [isRequired()]],
    mail_from_email: [getSetting('mail_from_email'), [isRequired()]],
    mail_driver: [getSetting('mail_driver'), [isRequired()]],
    mail_encryption: [getSetting('mail_encryption'), [isRequired()]],
    mail_host: [getSetting('mail_host'), [isRequired()]],
    mail_port: [getSetting('mail_port'), [isRequired()]],
    mail_username: [getSetting('mail_username'), [isRequired()]],
    mail_password: [getSetting('mail_password'), [isRequired()]],
});

const testEmailForm = useValidatedForm({
    email: ['', [isRequired(), isEmail()]],
});

function storeSettings() {
    form.post(route('adminr.settings.store'), {
        preserveScroll: true,
        onSuccess: () => { },
    });
}

function sendTestEmail() {
    testEmailForm.post(route('adminr.send-test-email'), {
        preserveScroll: true,
        onSuccess: () => {
            testEmailModalOpened.value = false;
        },
    });
}

</script>
