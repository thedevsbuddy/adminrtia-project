<template>

    <Head title="Edit user" />

    <section>
        <page-header title="Edit and update user details">
            <XButton as="link" icon="list" :href="route('adminr.users.index')" label="View All" />
        </page-header>

        <form @submit.prevent="updateUser">
            <card>
                <card-header>
                    <h3 class="heading-sm">Edit user</h3>
                    <div>
                        <a href="#" class=""></a>
                    </div>
                </card-header>
                <card-content class="relative">
                    <loading-progress v-if="form.processing" :message="`Loading (${form.progress.percentage}%)`" />
                    <!-- Show splash message -->
                    <splash-message />
                    <div class="flex space-x-4">
                        <div class="w-3/5">
                            <div class="grid md:grid-cols-2 gap-x-6 gap-y-2">
                                <form-input label="Name" :error="form.errors.name" required :value="form.name"
                                    v-model="form.name" placeholder="John Doe" />
                                <form-input label="Username" :error="form.errors.username" required
                                    :value="form.username" v-model="form.username" placeholder="johndoe" />
                                <form-input label="Email" :error="form.errors.email" type="email" required
                                    :value="form.email" v-model="form.email" placeholder="johndoe@example.com" />
                                <form-input label="Phone" :value="form.phone" v-model="form.phone" is-optional
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
                                <!-- <form-input label="Avatar" :error="form.errors.avatar" type="file"
                                                v-model="form.avatar" /> -->
                                <form-avatar-input v-model="form.avatar" :default="asset(props.user.avatar)"
                                    class="mx-auto mt-5" />
                            </div>
                        </div>
                    </div>
                </card-content>
                <card-footer class="justify-end">
                    <XButton type="submit" :hero-icon="FolderPlusIcon" :is-busy="form.processing" label="Update" />
                </card-footer>
            </card>
        </form>

    </section>
</template>
<script>
export default {
    inheritAttrs: false
}
</script>
<script setup>
import { FolderPlusIcon } from '@heroicons/vue/24/outline'
import useValidatedForm from "@/Composables/useValidatedForm";
import { isEmail, isRequired, isNumeric, isSame, isMin } from "intus/rules";
import { onMounted, ref } from "vue";

const roles = ref([]);

const props = defineProps({
    roles: Array,
    user: Object,
})

const form = useValidatedForm({
    name: [props.user.name, [isRequired()]],
    username: [props.user.username, [isRequired()]],
    email: [props.user.email, [isRequired(), isEmail()]],
    phone: [props.user.phone, [isRequired(), isNumeric()]],
    avatar: [null, []],
    role: [props.user.roles[0].id, [isRequired(),]],
    password: ['', [isMin(8)]],
    confirm_password: ['', [isSame('password')]],
    _method: ["PUT", []],
});

// const form = useForm({
//     name: props.user.name,
//     username: props.user.username,
//     email: props.user.email,
//     phone: props.user.phone,
//     avatar: null,
//     role: props.user.roles[0].id,
//     password: null,
//     confirm_password: null,
//     _method: "PUT",
// });


onMounted(() => {
    roles.value = props.roles.map(role => ({ label: role.name.ucFirst(), value: role.id }));
});


function updateUser() {
    form.post(route('adminr.users.update', props.user.id), {
        preserveScroll: true,
        onSuccess: () => { },
    });
}

</script>

