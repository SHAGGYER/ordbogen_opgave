<script>
import { ref, onMounted } from "vue";
import Navbar from "./components/Navbar.vue";
import HttpClient from "./HttpClient";
import { useStore } from "vuex";

export default {
  components: {
    Navbar,
  },
  setup() {
    const user = ref(null);
    const initiated = ref(false);
    const store = useStore();

    onMounted(async () => {
      const { data } = await HttpClient().get("/api/auth/init");
      store.commit("setUser", data.user);
      initiated.value = true;
    });

    return {
      user,
      initiated,
    };
  },
};
</script>

<template>
  <div>
    <Navbar />
    <div v-if="initiated" class="router">
      <router-view />
    </div>
  </div>
</template>

<style scoped>
  .router {
    max-width: 960px;
    margin: 0 auto;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
    padding: 1rem;
  }
</style>
