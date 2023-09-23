<template>
    <a-menu v-model:openKeys="openKeys"
        v-model:selectedKeys="selectedKeys" 
        mode="inline"
    >
        <a-menu-item key="admin-users">
            <router-link :to="{name:'admin-users'}">
                <font-awesome-icon :icon="['fas', 'user']"/>
                <span class="ms-2">User</span>
            </router-link>
        </a-menu-item>


        <a-menu-item key="admin-products">
            <router-link :to="{name:'admin-products'}">
                <font-awesome-icon :icon="['fab', 'product-hunt']" />
                <span class="ms-2">Product</span>
            </router-link>
        </a-menu-item>

        <a-menu-item key="admin-categories">
            <router-link :to="{name:'admin-categories'}">
                <font-awesome-icon :icon="['fas', 'bars']" />
                <span class="ms-2">Category</span>
            </router-link>
        </a-menu-item>

        <a-menu-item key="admin-roles">
          <router-link :to="{name:'admin-roles'}">
            <font-awesome-icon :icon="['fab', 'critical-role']" />
            <span class="ms-2">Role</span>
          </router-link>
        </a-menu-item>

        <a-menu-item key="admin-settings">
            <router-link :to="{name:'admin-settings'}">
                <font-awesome-icon :icon="['fas', 'gear']" />
                <span class="ms-2">Setting</span>
            </router-link>
        </a-menu-item>
    </a-menu>
</template>
<script>
import {useMenu} from "../stores/use-menu.js";
import {defineComponent} from "vue";
import { storeToRefs } from "pinia";
export default defineComponent({
    setup() {
    const store = useMenu();

    return {
      ...storeToRefs(store),
    };
  },
  
})

</script>