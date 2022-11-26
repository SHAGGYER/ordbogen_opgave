<script>
import { ref, onMounted } from "vue";
import HttpClient from "../HttpClient";
import { useStore } from "vuex";

export default {
  setup() {
    const store = useStore();
    const email = ref("");
    const password = ref("");
    const name = ref("");

    async function login() {
      if (email.value === "" || password.value === "") {
        alert("Please fill out all fields");
        return;
      }

      try {
        const { data } = await HttpClient().post("/api/auth/login", {
          email: email.value,
          password: password.value,
        });

        localStorage.setItem("token", data.content.token);
        window.location.href = "/";
      } catch (e) {
        alert("Invalid credentials");
      }
    }

    async function register() {
      if (!email.value || !password.value || !name.value) {
        alert("Please fill out all fields");
        return;
      }

      try {
        const { data } = await HttpClient().post("/api/auth/register", {
          email: email.value,
          password: password.value,
          name: name.value,
        });
        alert("User created, now log in.");
      } catch (e) {
        alert("Invalid credentials");
      }
    }

    return {
      login,
      register,
      email,
      password,
      name,
    };
  },
};
</script>

<template>
  <div>
    <form @submit.prevent="login">
      <h2>Login</h2>
      <input type="text" v-model="email" placeholder="Email" />
      <input type="password" v-model="password" placeholder="Kodeord" />
      <button type="submit">Log Ind</button>
    </form>
    <form @submit.prevent="register">
      <h2>Oprettelse</h2>
      <input type="text" v-model="name" placeholder="Navn" />
      <input type="text" v-model="email" placeholder="Email" />
      <input type="password" v-model="password" placeholder="Kodeord" />
      <button type="submit">Opret</button>
    </form>
  </div>
</template>

<style scoped>
  form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
    padding: 1rem;
    margin-bottom: 2rem;
  }
</style>
