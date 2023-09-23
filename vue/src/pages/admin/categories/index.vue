<template>
  <a-card title="Categories" style="width: 100%">
    <div class="row">
      <div class="col-12 mb-3 ">
        <router-link :to="{name:'admin-categories-create'}">
          <a-button type="primary">
            <font-awesome-icon :icon="['fas', 'plus']" />
          </a-button>
        </router-link>
      </div>
    </div>
      <div class="row">
        <div class="col-12">
          <a-table :dataSource="categories" :columns="columns" :scroll="{ x: 576}" >
            <template #bodyCell="{ column, index, record }">
              <template v-if="column.key === 'index'">
                <span>{{ index + 1 }}</span>
              </template>
              <template v-if="column.key === 'action'">
                <span>
                  <router-link :to="{name:'admin-categories-edit', params:{id:record.id}}">
                    <a-button type="primary" :key="index">
                      <font-awesome-icon :icon="['fas', 'edit']" />
                    </a-button>
                  </router-link>
                  <span style="margin-left: 8px;"></span>
                  <a-button type="primary" danger ghost @click="deleteCategory(record.id)">Delete</a-button>
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
import {defineComponent, ref } from "vue";
import {message} from "ant-design-vue";
export default defineComponent({
    setup() {
        useMenu().onSelectedKeys(["admin-categories"]);

        const categories=ref([]);
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
            title: "Action",
            key: "action",
            fixed: "right",
          },
        ];

    const getCategories = () => {
      axios.get('http://127.0.0.1:8000/api/data/categories')
        .then(function (response) {
          categories.value = response.data;
        })
        .catch(function (error) {
          console.log(error);
        }) 
    }

      const deleteCategory = (id) => {
        axios.delete(`http://127.0.0.1:8000/api/data/categories/${id}`)
            .then(function (response) {
              if (response.data.message === "Delete success") {
                message.success("Delete category success");
                getCategories();
              }
              else {
                console.error("Delete failed:", response.data.message);
              }
            })
            .catch(function (error) {
              console.log(error);
            })
      }

    getCategories();
    return{
      categories,
      columns,
      deleteCategory,
    }
    },
});
</script>