<template>
  <a-card title="Users" style="width: 100%">
    <div class="row">
      <div class="col-12 mb-3 ">
        <router-link :to="{name:'admin-users-create'}">
          <a-button type="primary">
            <font-awesome-icon :icon="['fas', 'plus']" />
          </a-button>
        </router-link>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a-table :dataSource="users" :columns="columns" :scroll="{ x: 576 }">
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'index'">
              <span>{{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'action'">
              <span>
                <router-link :to="{name:'admin-users-edit', params:{id:record.id}}">
                  <a-button type="primary" :key="index">
                    <font-awesome-icon :icon="['fas', 'edit']" />
                  </a-button>
                </router-link>
                <span style="margin-left: 8px;"></span>
                <a-button type="primary" danger ghost @click="deleteUser(record.id)">Delete</a-button>
              </span>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>
<script>
import { useMenu } from "../../../stores/use-menu.js";
import { defineComponent, ref } from "vue";
import { message } from 'ant-design-vue';
export default defineComponent({
  setup() {
    useMenu().onSelectedKeys(["admin-users"]);

    const users = ref([]);

    const columns = [
      {
        title: "ID",
        dataIndex: "id",
        key: "id"
      },
      {
        title: "Name",
        dataIndex: "name",
        key: "name"
      },
      {
        title: "Email",
        dataIndex: "email",
        key: "email"
      },
      {
        title: "Phone",
        dataIndex: "phone",
        key: "phone"
      },
      {
        title: "Address",
        dataIndex: "address",
        key: "address"
      },
      {
        title: "Gender",
        dataIndex: "gender",
        key: "gender"
      },
      {
        title: "Action",
        key: "action",
        fixed: "right",
      },
    ];

    const getUsers = () => {
      axios.get('http://127.0.0.1:8000/api/data/users')
        .then(function (response) {
          users.value = response.data;
        })
        .catch(function (error) {
          console.log(error);
        })
    }
    const deleteUser = (id) => {
      axios.delete(`http://127.0.0.1:8000/api/data/users/${id}`)
        .then(function (response) {
          if (response.data.message === "Delete success") {
            message.success("Delete user success");
            getUsers();
          }
          else {
            console.error("Delete failed:", response.data.message);
          }
        })
        .catch(function (error) {
          console.log(error);
        })
    }
    getUsers();
    return {
      users,
      columns,
      deleteUser,
    }
  },
});
</script>