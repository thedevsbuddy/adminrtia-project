<template>
  <Head title="Users management"/>
  <section>
    <page-header>
      <template #title>Manage Users</template>
      <template #action>
        <div>
          <XButton>
            <icon name="plus" class="w-4 h-4"/>
            <span>This is test</span>
          </XButton>
        </div>
      </template>
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
            <tr class="bg-light divide-x">
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
            <tr v-for="(user, index) in props.users.data" :key="user.id" :class="`divide-x text-sm ${index % 2 === 0 ? 'bg-white' : 'bg-light'}`">
              <td class="text-center p-2 w-12">{{ ++index }}</td>
              <td class="p-2 text-center w-16"><img :src="user.avatar" class="rounded-full w-12 h-12" alt=""></td>
              <td class="p-2">{{ user.name }}</td>
              <td class="p-2">{{ user.username }}</td>
              <td class="p-2">{{ user.email }}</td>
              <td class="p-2">{{ user.phone }}</td>
              <td class="p-2">{{ user.phone }}</td>
            </tr>
            </tbody>
          </table>
        </CardContent>
      </Card>
    </div>
  </section>
</template>
<script setup>
import {Head} from "@inertiajs/inertia-vue3"
import Card from "@/Components/Adminr/Card/Card"
import CardHeader from "@/Components/Adminr/Card/CardHeader"
import CardContent from "@/Components/Adminr/Card/CardContent"
import XButton from "@/Components/Adminr/Buttons/XButton"


const props = defineProps({
  users: Array,
})


</script>
