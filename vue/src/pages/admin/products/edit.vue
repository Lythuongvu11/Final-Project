<template>
  <form @submit.prevent="updateProducts()">
    <a-card title="Edit Product" style="width: 100%">
      <div class="row">
        <div class="col-12 col-sm-4 mb-3">
          <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
              <a-avatar shape="square" :size="200">
                <template #icon>
                  <img
                      v-if="selectedImage"
                      :src="selectedImage"
                      alt="Avatar"
                  />
                  <img
                      v-else
                      src="../../../assets/users.jpg"
                      alt="Avatar"
                  />
                </template>
              </a-avatar>
            </div>

            <div class="col-12 d-flex justify-content-center">
              <a-input type="file" name="image" id="image" class="form-control-file"
                       @change="handleImageChange"
              />
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.name}">
                  Name:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Name" allow-clear v-model:value="name"  />
              <div class="w-100"></div>
              <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.description}">
                  Description:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Description" allow-clear v-model:value="description" />
              <div class="w-100"></div>
              <small v-if="errors.description" class="text-danger">{{errors.description[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.category_id}">
                  Category ID:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Category ID" allow-clear v-model:value="category_id"/>
              <div class="w-100"></div>
              <small v-if="errors.category_id" class="text-danger">{{errors.category_id[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.size}">
                  Size:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input  placeholder="Size" v-model:value="size"/>
              <div class="w-100"></div>
              <small v-if="errors.size" class="text-danger">{{errors.size[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.color}">
                  Color:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input  placeholder="Color" v-model:value="color"/>
              <div class="w-100"></div>
              <small v-if="errors.color" class="text-danger">{{errors.color[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.price}">
                  Price:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input  placeholder="Price" v-model:value="price"/>
              <div class="w-100"></div>
              <small v-if="errors.price" class="text-danger">{{errors.price[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.old_price}">
                  Old Price:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input  placeholder="Price" v-model:value="old_price"/>
              <div class="w-100"></div>
              <small v-if="errors.old_price" class="text-danger">{{errors.old_price[0]}}</small>
            </div>
          </div>

        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
          <router-link :to="{name:'admin-products'}">
            <a-button class="me-0 me-sm-2 mb-3 mb-sm-0">
              <span class="ms-1">Back</span>
            </a-button>
          </router-link>

          <a-button type="primary" html-type="submit">
            <span>Save</span>
          </a-button>
        </div>
      </div>
    </a-card>
  </form>
</template>

<script>
import { useMenu } from "../../../stores/use-menu.js";
import {defineComponent,ref,reactive,toRefs} from "vue";
import axios from 'axios';
import { message } from 'ant-design-vue';
import {useRouter} from "vue-router";
import {useRoute} from "vue-router";
export default defineComponent({
  setup(){
    useMenu().onSelectedKeys(["admin-products"]);

    const router = useRouter();
    const route = useRoute();
    const errors = ref({});
    const selectedImage = ref(null);
    const handleImageChange = (event) => {
      const file = event.target.files[0];
      product.image = 'product_images/'+event.target.files[0].name;
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          selectedImage.value = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };
    const product = reactive({
      image: "",
      name: "",
      description: "",
      category_id: "",
      size: "",
      color: "",
      price: "",
      old_price: "",
    });


    const getProductsEdit=()=>{
      axios.get(`http://127.0.0.1:8000/api/data/${route.params.id}/products-edit`)
          .then((response)=>{
            product.image=response.data.product.image;
            product.name=response.data.product.name;
            product.description=response.data.product.description;
            product.category_id=response.data.product.category_id;
            product.size=response.data.product.size;
            product.color=response.data.product.color;
            product.price=response.data.product.price;
            product.old_price=response.data.product.old_price;
          })
          .catch((error)=>{
            console.log(error)
          })
    }

    getProductsEdit();

    const updateProducts=()=>{
      axios.put(`http://127.0.0.1:8000/api/data/${route.params.id}/products`, product)
          .then((response)=>{
            if(response){
              message.success('Update product successfully');
              router.push({name: 'admin-products'})
            }
          })
          .catch((error)=>{
            error.value =error.response.data.errors;
          })
    }


    return {
      ...toRefs(product),
      errors,
      updateProducts,
      handleImageChange,
      selectedImage,
    };
  },


});
</script>
