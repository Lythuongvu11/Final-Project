import { createApp } from "vue";
import { createPinia } from "pinia";
import App from "./App.vue";
import router from "./router/index.js";
import store from "./stores/index.js";
import axios from "axios";
window.axios=axios;
import { Button, message, Drawer, List, Menu, Card, Table,Avatar,Input,Select,Checkbox,Form} from "ant-design-vue";

import "bootstrap/dist/css/bootstrap-grid.min.css";
import "bootstrap/dist/css/bootstrap-utilities.min.css";
import "ant-design-vue/dist/reset.css";

//font-awesome
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { fab } from "@fortawesome/free-brands-svg-icons";
import { far } from "@fortawesome/free-regular-svg-icons";
/* add icons to the library */
library.add(fas,fab,far);

const app = createApp(App);
app.component("font-awesome-icon", FontAwesomeIcon);
app.use(store);
app.use(router);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(Card);
app.use(Table);
app.use(Avatar);
app.use(Input);
app.use(Select);
app.use(Checkbox);
app.use(Form);
app.use(createPinia());
app.mount("#app");

app.config.globalProperties.$message = message;
