<template>

  <div class="login-form-container">
    <div class="form-wrapper">
      <div class="title">Forgot Password</div>
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
        >
          <a-input v-model:value="formState.email" />
          <div class="w-100"></div>
          <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
        </a-form-item>
        <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
          <a-button type="primary" @click="sendResetPasswordRequest" html-type="submit">Submit</a-button>
        </a-form-item>
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
<script setup>
import {reactive, ref} from "vue";
import {useRouter} from "vue-router";
import axios from "axios";
import {message} from "ant-design-vue";
const router = useRouter();
const formState = reactive({
  email: "",
});
const errors = ref({});
const sendResetPasswordRequest = () => {
   axios.post("http://127.0.0.1:8000/api/admin/password/request", formState)
         .then((response) => {
           if (response.data.status === "success") {
             message.success('Please check your email to reset password');
             router.push({name: 'admin-login'});
           } else {
             message.error('Email does not exist');
           }
         })
       .catch ((error) => {
         console.log(error);
         errors.value = error.response.data.errors;
       });
  };
</script>