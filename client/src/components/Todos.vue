<script>
import { ref, onMounted } from "vue";
import { useStore } from "vuex";
import HttpClient from "../HttpClient";

export default {
  setup() {
    const store = useStore();
    const newTodo = ref("");
    const todos = ref([]);

    onMounted(async () => {
      if (!store.state.user) {
        window.location.href = "/login";
        return;
      }

      const { data } = await HttpClient().get("/api/todos/list");
      todos.value = data.content;
    });

    const markAsDone = async (todo) => {
      await HttpClient().post("/api/todos/" + todo.id + "/markComplete", {
        id: todo.id,
      });

      todo.completed = 1;
    };

    const createTodo = async () => {
      const { data } = await HttpClient().post("/api/todos/create", {
        title: newTodo.value,
      });

      todos.value.push(data.content);
      newTodo.value = "";
    };

    return {
      newTodo,
      createTodo,
      todos,
      markAsDone,
    };
  },
};
</script>

<template>
  <div>
    <h1>Todo List</h1>
    <div>
      <div class="todo" v-for="(todo, index) in todos" :key="index">
        <span
          >{{ todo.title }}
          <span v-if="todo.completed == 1">(Er færdig)</span>
        </span>
        <button v-if="todo.completed == 0" @click="markAsDone(todo)">
          Færdig
        </button>
      </div>
    </div>
    <form @submit.prevent="createTodo">
      <input v-model="newTodo" type="text" />
      <button type="submit">Tilføj</button>
    </form>
  </div>
</template>

<style scoped>
  .todo {
    display: flex;
    align-items: center;
    gap: 1rem;
    border: 1px solid #ccc;
    padding: 1rem;
    margin-bottom: 1rem;
  }
</style>