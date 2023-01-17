<template>

    <Head title="Roles & permissions management" />

    <section>
        <page-header title="Manage Roles & Permissions">
            <XButton as="link" :href="route('adminr.users.create')" icon="plus" label="Add New" />
        </page-header>

        <div>
            <card>
                <card-header class="justify-between">
                    <h3 class="heading-sm">Roles & Permissions</h3>
                    <!-- <div>
                        <form-input placeholder="Search here..." :value="filters.term" v-model="filters.term"
                            input-style="rounded-full " />
                    </div> -->
                </card-header>
                <card-content class="px-0 py-0">
                    <table class="w-full">
                        <thead class="bg-slate-100 border-b text-sm">
                            <tr class="divide-x">
                                <th class="p-2 text-left">Permissions</th>

                                <th v-for="(role, index) in props.roles" :key="role.id" class="p-2 text-center">
                                    {{ role.name.title() }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <tr v-for="(permission, index) in props.permissions" :key="permission.id"
                                class="divide-x text-sm odd:bg-white even:bg-slate-100">
                                <td class="text-left p-2 w-12">{{ permission.name }}</td>
                                <td v-for="(role, index) in props.roles" :key="role.id"
                                    :class="`${role.name == 'super_admin' ? 'w-56' : ''} p-2 text-center`">
                                    <span v-if="role.name == 'super_admin'"
                                        class="bg-green-100 text-green-600 font-semibold text-xs px-2 py-1 rounded">
                                        All Permission Allowed
                                    </span>
                                    <form-radio-switch v-else
                                        :checked="role.permissions.find(e => e.id == permission.id) != null"
                                        @change="e => toggleRolePermission(e, role.id, permission.id)" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </card-content>
                <!-- <cardFooter class="justify-end">
                    <pagination :links="props.users.links" />
                </cardFooter> -->
            </card>
        </div>
    </section>
</template>
<script setup>
import { onMounted } from "vue";

/// Props
const props = defineProps({
    permissions: Object,
    roles: Object,
})

function toggleRolePermission(e, roleId, permissionId) {
    console.log($(e.target).is(':checked'));
    axios.post(route('adminr.roles-and-permissions.toggle-permissions'), {
        role_id: roleId,
        permission_id: permissionId,
        action: $(e.target).is(':checked') ? 'assign' : 'revoke'
    }).then(e => console.log(e));
}


onMounted(() => {
    // console.log("onMounted", getRoles())
})

</script>
