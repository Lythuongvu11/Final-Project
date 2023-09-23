<template>
    <form @submit.prevent="createUser">
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

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.email}">
                  Email:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Email" allow-clear v-model:value="email" />
              <div class="w-100"></div>
              <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.phone}">
                  Phone:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Phone" allow-clear v-model:value="phone"/>
              <div class="w-100"></div>
              <small v-if="errors.phone" class="text-danger">{{errors.phone[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.gender}">
                  Gender:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-select

                  ref="select"
                  placeholder="Select a person"
                  style="width: 50%;"
                  v-model:value="gender"
              >
                <a-select-option value="male">Male</a-select-option>
                <a-select-option value="female">Female</a-select-option>
              </a-select>
              <div class="w-100"></div>
              <small v-if="errors.gender" class="text-danger">{{errors.gender[0]}}</small>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span>
                  Address:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input placeholder="Address" allow-clear v-model:value="address" />
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12 col-sm-3 text-start text-sm-end">
              <label>
                <span class="text-danger me-1">*</span>
                <span :class="{'text-danger':errors.password}">
                  Password:
                </span>
              </label>
            </div>
            <div class="col-12 col-sm-5">
              <a-input-password  placeholder="Password" v-model:value="password"/>
              <div class="w-100"></div>
              <small v-if="errors.password" class="text-danger">{{errors.password[0]}}</small>
            </div>
          </div>


        </div>
      </div>

      <div class="row mb-3">
        <div class="col-12 d-grid d-sm-flex justify-content-sm-end mx-auto">
            <router-link :to="{name:'admin-users'}">
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
          useMenu().onSelectedKeys(["admin-users"]);

        const router = useRouter();

          const errors = ref({});
          const user = reactive({
            name: "",
            email: "",
            phone: "",
            gender: "",
            address: "",
            password: "",
          });
          const createUser = () => {
            axios
                .post("http://127.0.0.1:8000/api/data/users-create", user)
                .then((response) => {
                  if(response){
                    message.success('Create user successfully');
                    router.push({name: 'admin-users'})
                  }

                })
                .catch((error) => {
                  console.log(error);
                  errors.value = error.response.data.errors;
                });
          };



          return {
            createUser,
            ...toRefs(user),
            errors,
          };
        },


    });
</script>
