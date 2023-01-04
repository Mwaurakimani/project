<template>
  <div v-if="tenants" class="tenant-display">
    <table>
      <thead>
      <th>ID</th>
      <th>Name</th>
      </thead>
      <tbody>
      <tr v-for="user in tenants" @click="select_tenant">
        <td>{{user.id}}</td>
        <td>{{ user.username }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  name: 'select_tenant',
  props: {
    select_tenant: {},
    tenants: {}
  }
}
</script>

<style scoped lang="scss" >
.tenant-display {
    margin-left: 100px;
    width: 400px;

    table {
        background-color: #ece9e9;
        width: 100%;
        thead{
            background-color: dodgerblue;
            color: white;
        }
        tbody{
            tr{
                border-bottom: 1px solid lightgrey;
                &:hover{
                    cursor: pointer;
                    background-color: dodgerblue;
                    color: white;
                }
            }
        }
    }
}
</style>
