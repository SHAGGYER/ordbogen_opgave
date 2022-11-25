import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import { createRouter, createWebHistory } from "vue-router";

import { createStore } from "vuex";

// Create a new store instance.
const store = createStore({
  state() {
    return {
      user: null,
    };
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
  },
});

const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: "/", component: () => import("./components/Todos.vue") },
    {
      path: "/login",
      component: () => import("./components/LoginRegister.vue"),
    },
  ],
});

const app = createApp(App);

app.use(router);
app.use(store);

app.mount("#app");
