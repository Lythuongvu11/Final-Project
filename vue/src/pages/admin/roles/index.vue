<template>
  <a-card title="Roles" style="width: 100%">
    <div class="row">
        <div class="col-12">
          <a-table :dataSource="roles" :columns="columns" :scroll="{ x: 576}" />
        </div>
    </div>
  </a-card>
</template>

<script>
import { useMenu } from "../../../stores/use-menu.js";
import {defineComponent, ref } from "vue"; 
export default defineComponent({
    setup() {
        useMenu().onSelectedKeys(["admin-roles"]);

        const roles=ref([]);
        const columns =[
      {
        title:"ID",
        dataIndex:"id",
        key:"id"
      },
      {
        title:"Name",
        dataIndex:"name",
        key:"name"
      },
      {
        title:"Display Name",
        dataIndex:"display_name",
        key:"display_name"
      }
    ];
    const getRoles = () => {
      axios.get('http://127.0.0.1:8000/api/data/roles')
        .then(function (response) {
          roles.value = response.data;
        })
        .catch(function (error) {
          console.log(error);
        }) 
    }
    getRoles();
    return{
      roles,
      columns
    }
    },

});
</script>