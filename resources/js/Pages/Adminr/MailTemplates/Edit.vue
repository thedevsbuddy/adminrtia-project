<template>

    <Head title="Edit and update mail template" />

    <section>
        <page-header title="Edit mail template">
            <XButton as="link" icon="list" :href="route('adminr.templates.index')" label="View All" />
        </page-header>

        <div>
            <form @submit.prevent="updateTemplate">
                <Card>
                    <CardHeader>
                        <h3 class="heading-sm">Modify template</h3>
                    </CardHeader>
                    <CardContent class="">
                        <!-- Show splash message -->
                        <splash-message />
                        <div class="flex space-x-6">
                            <div class="w-2/3">
                                <div class="grid grid-cols-1 gap-x-6 gap-y-2">
                                    <form-input label="Subject" :error="form.errors.subject" required
                                        v-model="form.subject" :value="form.subject"
                                        placeholder="Eg: Order placed successfully." />
                                    <form-input disabled
                                        title="Please create a unique mail code as you wont be able to change it later."
                                        label="Code" :error="form.errors.code" required v-model="form.code"
                                        :value="form.code" placeholder="Eg: order-placed-successfully" />
                                    <form-input label="Purpose" :error="form.errors.purpose" type="text" required
                                        v-model="form.purpose" :value="form.purpose"
                                        placeholder="Eg: To be sent when order placed" />
                                    <label
                                        class="flex mb-1 mt-2 text-sm font-medium text-slate-500 items-center space-x-1">
                                        <span>Content</span>
                                        <span class="font-bold text-red-500">*</span>
                                    </label>
                                    <v-md-editor v-model="form.content" height="400px"></v-md-editor>
                                    <span v-if="form.errors.content"
                                        class="text-red-500 font-semibold text-xs tracking-wider">{{
                                            form.errors.content
                                        }}</span>
                                </div>
                            </div>
                            <div class="w-1/3">
                                <h3 class="text-2xl font-semibold">Important Information</h3>
                                <div class="space-y-3">
                                    <div>
                                        <h5 class="text-lg">Default Variables</h5>
                                        <ul class="pl-8">
                                            <li><code>{br}</code> or <code>{nl}</code>: For line break</li>
                                            <li><code>{app.name}</code>: For app name</li>
                                            <li><code>{app.url}</code>: For app root url</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h5 class="text-lg">Styling mail template</h5>
                                        <p>We are allowing you to use <code>markdown</code> to style and compose your
                                            mail template.</p>
                                    </div>
                                    <div class="text-sm space-y-0.5">
                                        <p><strong>Example:</strong></p>
                                        <p>You can use <code>markdown</code> as <code># this is the h1 heading</code> to
                                            create <code>h1</code> heading.</p>
                                        <p class="mb-1"><strong>Note:</strong></p>
                                        <p class="m-0"><strong>1. You can use markdown only in the content
                                                section.</strong>
                                        </p>
                                        <p class="m-0"><strong>2. Variable replacement is only available for subject and
                                                content.</strong></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </CardContent>
                    <CardFooter class="justify-end">
                        <XButton type="submit" :hero-icon="FolderPlusIcon" :is-busy="form.processing" label="Update" />
                    </CardFooter>
                </Card>
            </form>
        </div>
    </section>
</template>
<script setup>
import { FolderPlusIcon } from '@heroicons/vue/24/outline'
import useValidatedForm from "@/Composables/useValidatedForm";
import { isRequired } from "intus/rules";


const props = defineProps({
    template: Object,
})


const form = useValidatedForm({
    subject: [props.template.subject, [isRequired()]],
    code: [props.template.code, [isRequired()]],
    purpose: [props.template.purpose, [isRequired()]],
    content: [props.template.content, [isRequired()]],
    _method: ["PUT", []],
});

function updateTemplate() {
    form.post(route('adminr.templates.update', props.template.id), {
        preserveScroll: true,
        onSuccess: () => {
            // Inertia.replace(route('adminr.templates.index'));
        },
    });
}

</script>
