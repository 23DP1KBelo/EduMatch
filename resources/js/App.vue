<template>
    <div class="container">
        <h1>{{ message }}</h1>

        <p>Laravel + Vue 3 darbojas!</p>

        <button @click="count++">
            Klikšķini mani: {{ count }}
        </button>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const message = 'Sveika, pasaule!';
const count = ref(0);
</script>

<style scoped>
.container {
    max-width: 700px;
    margin: 100px auto;
    text-align: center;
    font-family: Arial, sans-serif;
}

h1 {
    color: #42b883;
}

button {
    padding: 12px 20px;
    background: #42b883;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}
</style>