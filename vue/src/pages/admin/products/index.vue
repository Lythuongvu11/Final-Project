<template>
  <a-card title="Products" style="width: 100%">
    <form @submit.prevent="searchProduct">
      <div class="row">
        <div class="col-3 mb-3 ">
          <a-input placeholder="Search" allow-clear v-model:value="search" />
        </div>
        <div class="col-1">
          <a-button type="primary" html-type="submit">
            <span>Search</span>
          </a-button>
        </div>
      </div>
    </form>

    <div class="row">
      <div class="col-12 mb-3 ">
        <router-link :to="{name:'admin-products-create'}">
          <a-button type="primary">
            <font-awesome-icon :icon="['fas', 'plus']" />
          </a-button>
        </router-link>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a-button type="primary" danger @click="deleteSelectedProducts">Delete Selected</a-button>
      </div>
    </div>
      <div class="row">
        <div class="col-12">
          <a-table :dataSource="products" :columns="columns" :scroll="{ x: 576}">
            <template #bodyCell="{ column, index, record }">
              <template v-if="column.key === 'checkbox'">
                <a-checkbox v-model="record.selected" @change="handleCheckboxChange(record.id)" />
              </template>
              <template v-if="column.key === 'index'">
                <span>{{ index + 1 }}</span>
              </template>
              <template v-if="column.key === 'image'">
                <img
                    v-if="record.image"
                    :src="`http://127.0.0.1:8000/storage/`+record.image"
                alt="Product Image"
                style="max-width: 100px; max-height: 100px;"
                />
                <span v-else>No Image</span>
              </template>
              <template v-if="column.key === 'action'">
              <span>
                <router-link :to="{name:'admin-products-edit', params:{id:record.id}}">
                  <a-button type="primary" :key="index">
                    <font-awesome-icon :icon="['fas', 'edit']" />
                  </a-button>
                </router-link>
                <a-button class="mt-2" type="primary" danger ghost @click="deleteProduct(record.id)">Delete</a-button>
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
        useMenu().onSelectedKeys(["admin-products"]);

        const products=ref([]);
        const columns =[
          {
            title: "Checkbox",
            key: "checkbox",
            width: 100,
          },
      {
        title:"ID",
        dataIndex:"id",
        key:"id"
      },
          {
            title:"Image",
            dataIndex:"image",
            key:"image",},
      {
        title:"Name",
        dataIndex:"name",
        key:"name"
      },
      {
        title:"Description",
        dataIndex:"description",
        key:"description"
      },
          {
            title:"Category",
            dataIndex:"category_id",
            key:"category_id",
          },
      {
        title:"Size",
        dataIndex:"size",
        key:"size"
      },
      {
        title:"Color",
        dataIndex:"color",
        key:"color"
      },
      {
        title:"Price",
        dataIndex:"price",
        key:"price"
      },
      {
        title:"Old Price",
        dataIndex:"old_price",
        key:"old_price"
      },
          {
            title: "Action",
            key: "action",
            fixed: "right",
          },

    ];
      const search = ref("");
      const getProducts = () => {
        const searchValue = search.value;
      axios.get('http://127.0.0.1:8000/api/data/products',{
        params: {
          search: searchValue,
        },
      })
        .then(function (response) {
          products.value = response.data.map((product) => ({
            ...product,
            selected: false,
          }));
        })
        .catch(function (error) {
          console.log(error);
        })
    }
    getProducts();
      const searchProduct = () => {
        getProducts();
      }
      const deleteProduct = (id) => {
        axios.delete(`http://127.0.0.1:8000/api/data/products/${id}`)
            .then(function (response) {
              if (response.data.message === "Delete success") {
                message.success("Delete product success");
                getProducts();
              }
              else {
                console.error("Delete failed:", response.data.message);
              }
            })
            .catch(function (error) {
              console.log(error);
            })
      }
      const selectedProducts = ref([]);
      const handleCheckboxChange = (productId) => {
        const product = products.value.find((item) => item.id === productId);
        if (product) {
          product.selected = !product.selected;

          if (product.selected) {
            selectedProducts.value.push(productId);
          } else {
            const index = selectedProducts.value.indexOf(productId);
            if (index !== -1) {
              selectedProducts.value.splice(index, 1);
            }
          }
        }
      };
      const deleteSelectedProducts = () => {
        if (selectedProducts.value.length === 0) {
          message.warning("Please select at least one product to delete.");
          return;
        }

        axios
            .post("http://127.0.0.1:8000/api/data/products/delete-selected", {
              products: selectedProducts.value,
            })
            .then(function (response) {
              if (response.data.message === "Delete success") {
                message.success("Selected products have been deleted.");
                getProducts();
                selectedProducts.value = [];
              } else {
                console.error("Delete failed:", response.data.message);
              }
            })
            .catch(function (error) {
              console.log(error);
            });
      };

    return{
      products,
      columns,
      deleteProduct,
      searchProduct,
      search,
      handleCheckboxChange,
      deleteSelectedProducts,

    }
    },

});
</script>