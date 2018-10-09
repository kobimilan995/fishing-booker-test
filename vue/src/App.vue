<template>
  <div id="app">
    <navigation-component></navigation-component>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navigation from './components/layout/Navigation.vue';

export default {
  name: 'app',
  components: {
    'navigation-component': Navigation
  }
}
</script>
