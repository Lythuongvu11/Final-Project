<template>
    <div class="container-fuild">
        <div class="row" style="background-color: rgb(155, 197, 190); padding: 1rem;">
            <div class="col-1 d-flex d-sm-none align-item-center justify-content-center">
                <span @click="showDrawer()">
                    <font-awesome-icon :icon="['fas', 'align-justify']" />
                </span>
            </div>
            <div class="col-10 col-sm-9 d-flex  align-item-center justify-content-center justify-content-sm-start">
                <span>Welcome to Admin page</span>
            </div>
            <div class=" col-sm-3 d-none d-sm-flex  align-item-center justify-content-center  ">
                <span v-if="isLoggedInFromStore" @click="logout()">
                  <font-awesome-icon :icon="['fas', 'right-from-bracket']" />
                </span>
              <span v-else @click="showDrawerUser()"><font-awesome-icon :icon="['fas', 'user']" /></span>
            </div>
            <div class="col-1 d-flex d-sm-none align-item-center justify-content-center">
                <span @click="showDrawerUser()"><font-awesome-icon :icon="['fas', 'user']"/></span>
            </div>
        </div>
    </div>
    <a-drawer
        v-model:open="open"
        title="Dashboard"
        placement="left"
  >
        <TheMenu />
    </a-drawer>
    <a-drawer v-model:open="open_user" title="Admin" placement="right">
    </a-drawer>
</template>
<script lang="ts" setup>
import { ref,inject} from 'vue';
import TheMenu from './TheMenu.vue';
import { useRouter } from 'vue-router';

const open = ref<boolean>(false);
const open_user = ref<boolean>(false);
const router = useRouter();
const isLoggedIn = ref<boolean>(false);

const showDrawer = () => {
  open.value = true;
};
const showDrawerUser = () => {
  open_user.value = true;
};
const store = inject('store');
const logout = () => {

  isLoggedIn.value = false;
  router.push({ name: 'admin-login' });
  store.commit('setLoggedIn', false);
};
const isLoggedInFromStore = store.state.isLoggedIn;
store.watch(
    (state: { isLoggedIn: boolean }) => state.isLoggedIn,
    (newIsLoggedIn: boolean) => {
      isLoggedIn.value = newIsLoggedIn;
    }
);


</script>