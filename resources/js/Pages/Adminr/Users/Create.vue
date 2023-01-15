<template>

    <Head title="Create a new user" />

    <section>
        <page-header title="Create new user">
            <XButton as="link" icon="list" :href="route('adminr.users.index')" label="View All" />
        </page-header>

        <div>
            <form @submit.prevent="storeUser">
                <Card>
                    <CardHeader>
                        <h3 class="heading-sm">Users list in the system</h3>
                        <div>
                            <a href="#" class=""></a>
                        </div>
                    </CardHeader>
                    <CardContent class="">
                        <!-- Show splash message -->
                        <splash-message />
                        <div class="flex space-x-4">
                            <div class="w-3/5">
                                <div class="grid md:grid-cols-2 gap-x-6 gap-y-2">
                                    <form-input label="Name" :error="form.errors.name" required v-model="form.name"
                                        placeholder="John Doe" />
                                    <form-input label="Username" :error="form.errors.username" required
                                        v-model="form.username" placeholder="johndoe" />
                                    <form-input label="Email" :error="form.errors.email" type="email" required
                                        v-model="form.email" placeholder="johndoe@example.com" />
                                    <form-input label="Phone" v-model="form.phone" is-optional
                                        placeholder="+91-9876543210" />
                                    <form-input label="Password" :error="form.errors.password" type="password"
                                        v-model="form.password" placeholder="********" />
                                    <form-input label="Confirm Password" :error="form.errors.confirm_password"
                                        type="password" v-model="form.confirm_password" placeholder="********" />
                                </div>
                            </div>
                            <div class="w-2/5">
                                <div>
                                    <form-select label="Role" required placeholder="Select Role" :options="roles"
                                        v-model="form.role" :error="form.errors.role" />
                                    <form-avatar-input v-model="form.avatar"
                                        :default="asset('images/user-placeholder.jpg')" label="Avatar"
                                        class="mx-auto mt-5" />
                                </div>
                            </div>
                        </div>
                    </CardContent>
                    <CardFooter class="justify-end">
                        <XButton type="submit" :hero-icon="FolderPlusIcon" :is-busy="form.processing" label="Save" />
                    </CardFooter>
                </Card>
            </form>
        </div>
    </section>
</template>
<script setup>
import { FolderPlusIcon } from '@heroicons/vue/24/outline'
import useValidatedForm from "@/Composables/useValidatedForm";
import { isEmail, isRequired, isNumeric, isSame, isMin } from "intus/rules";
import { onMounted, ref } from "vue";
import { useToast } from "vue-toastification";

const roles = ref([]);
// Get toast interface
const toast = useToast();

const form = useValidatedForm({
    name: ["", [isRequired()]],
    username: ["", [isRequired()]],
    email: ["", [isRequired(), isEmail()]],
    phone: ["", [isRequired(), isNumeric()]],
    role: ["", [isRequired(),]],
    avatar: [null, [isRequired()]],
    password: ["", [isRequired(), isMin(8)]],
    confirm_password: ["", [isRequired(), isSame('password')]],
});
const props = defineProps({
    roles: Array,
})


onMounted(() => {
    roles.value = props.roles.map(role => ({ label: role.name, value: role.id }));
})


function storeUser() {
    form.post(route('adminr.users.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            Inertia.replace(route('adminr.users.index'));
        },
    });
}

</script>
