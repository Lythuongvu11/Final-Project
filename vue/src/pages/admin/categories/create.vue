<template>
  <form @submit.prevent="createCategory">
    <a-card title="Create User" style="width: 100%">
      <div class="row">
        <div class="col-12">
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
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
          <router-link :to="{name:'admin-categories'}">
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
export default defineComponent({
  setup(){
    useMenu().onSelectedKeys(["admin-categories"]);

    const router = useRouter();

    const errors = ref({});
    const category = reactive({
      name: "",
    });
    const createCategory = () => {
      axios
          .post("http://127.0.0.1:8000/api/data/categories-create", category)
          .then((response) => {
            if(response){
              message.success('Create category successfully');
              router.push({name: 'admin-categories'})
            }

          })
          .catch((error) => {
            console.log(error);
            errors.value = error.response.data.errors;
          });
    };



    return {
      createCategory,
      ...toRefs(category),
      errors,
    };
  },


});
</script>
