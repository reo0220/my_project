<script setup>
import { ref } from "vue";

const userInput = ref('');

</script>

<template>
    <p>{{userInput}}</p>
    <input v-model="userInput" type="text">
</template>

<style>

</style>