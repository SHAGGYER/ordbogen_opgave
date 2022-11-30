<script>
import { useStore } from "vuex";
export default {
  props: ["user"],
  setup(props) {
    const store = useStore();

    const logout = () => {
      localStorage.removeItem("token");
      store.commit("setUser", null);
      window.location.href = "/login";
    };

    return {
      logout,
    };
  },
};
</script>

<template>
  <div class="navbar">
    <span>Todo App</span>
    <ul>
      <li><router-link to="/">Todos</router-link></li>
      <li><router-link to="/login">Konto</router-link></li>
      <li v-if="$store.state.user"><a href="#" @click="logout">Logout</a></li>
    </ul>
  </div>
</template>

<style scoped>
  .navbar {
    max-width: 960px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
    padding: 1rem;
    margin-bottom: 1rem;
  }

  .navbar ul {
    display: flex;
    list-style: none;
    gap: 1rem;
  }
</style>