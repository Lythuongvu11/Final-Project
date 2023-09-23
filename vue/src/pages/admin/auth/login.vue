<template>

  <div class="login-form-container">
    <div class="form-wrapper">
      <div class="title">Admin Login</div>
      <a-form
          class="login-form"
          :model="formState"
          name="basic"
          :label-col="{ span: 8 }"
          :wrapper-col="{ span: 16 }"
          autocomplete="off"
      >
        <a-form-item
            label="Email"
            name="email"
            :rules="[{ required: true, message: 'Please input your email!' }]"
        >
          <a-input v-model:value="formState.email" />
        </a-form-item>

        <a-form-item
            label="Password"
            name="password"
            :rules="[{ required: true, message: 'Please input your password!' }]"
        >
          <a-input-password v-model:value="formState.password" />
        </a-form-item>

        <a-form-item name="remember" :wrapper-col="{ offset: 8, span: 16 }">
          <a-checkbox v-model:checked="formState.remember">Remember me</a-checkbox>
        </a-form-item>

        <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
          <a-button type="primary" @click="submitForm" html-type="submit">Submit</a-button>
        </a-form-item>
        <router-link :to="{name:'admin-forgot-password'}">Forgot Password</router-link>
      </a-form>
    </div>

  </div>

</template>
<style scoped>
.login-form-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  min-height: 50vh;
}
.form-wrapper {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  text-align: center;
}
.title {
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 2rem;
}
.login-form {
  width: 600px;
}
</style>
<script>
import {reactive, defineComponent,inject} from 'vue';
import axios  from "axios";
import { message } from 'ant-design-vue';
import {useRouter} from "vue-router";
export default defineComponent({
  setup(){
    const formState = reactive({
      email: '',
      password: '',
      remember: false,
    });
    const router = useRouter();
    const store = inject('store');
    const submitForm = () => {
      axios.post('http://127.0.0.1:8000/api/admin/login', formState)
          .then((res) => {
            if (res.data.status === 'success') {
              message.success('Login success');
              store.commit('setLoggedIn', true);
              console.log(store.state.isLoggedIn);
              router.push({name: 'admin-users'});
            } else {
              message.error('Login failed');
            }
          })
          .catch((error) => {
            console.log(error);
          });
    };

    return {
      formState,
      submitForm,
    }
  }
})
</script>