<template>
  <Head title="Users management"/>

  <section>
    <page-header title="Manage Users">
      <XButton as="link" :href="route('adminr.users.create')" icon="plus" label="Add New" />
    </page-header>

    <div>
      <Card>
        <CardHeader>
          <h3 class="heading-sm">Users list in the system</h3>
          <div>
            <a href="#" class=""></a>
          </div>
        </CardHeader>
        <CardContent class="px-0 py-0">
          <table class="w-full">
            <thead>
            <tr class="bg-slate-100 divide-x border-b text-sm">
              <th class="p-2 text-center">Sr.</th>
              <th class="p-2 text-left"></th>
              <th class="p-2 text-left">Name</th>
              <th class="p-2 text-left">Username</th>
              <th class="p-2 text-left">Email</th>
              <th class="p-2 text-left">Phone</th>
              <th class="p-2 text-left">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y">
            <tr v-for="(user, index) in props.users.data" :key="user.id" class="divide-x text-sm odd:bg-white even:bg-light">
              <td class="text-center p-2 w-12">{{ ++index }}</td>
              <td class="p-2 text-center w-16"><img :src="user.avatar" class="rounded-full w-12 h-12" alt=""></td>
              <td class="p-2">{{ user.name }}</td>
              <td class="p-2">{{ user.username }}</td>
              <td class="p-2">{{ user.email }}</td>
              <td class="p-2">{{ user.phone }}</td>
              <td class="p-2">
                <div class="flex items-center space-x-2">
                  <XButton as="link" :href="route('adminr.users.edit', user.id)" class="bg-blue-200 text-blue-600" :hero-icon="PencilSquareIcon" />
                  <XButton as="link" method="DELETE" :href="route('adminr.users.destroy', user.id)" class="bg-red-200 text-red-600" :hero-icon="TrashIcon" />
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
import {TrashIcon, PencilSquareIcon} from "@heroicons/vue/24/solid";
const props = defineProps({
  users: Object,
})


</script>
