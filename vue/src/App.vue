<template>
  <router-view></router-view>
</template>
<script>
import { provide } from 'vue';
import store from './stores';

export default {
  setup() {
    provide('store', store);
  },
};
</script>





