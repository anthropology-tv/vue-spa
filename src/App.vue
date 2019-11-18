<template xmlns:v="http://www.w3.org/1999/xhtml">
  <div id="app">
    <img width="320" height="auto" src="./assets/star.gif">
    <router-view/>
  </div>
</template>
<script>

export default {
  name: 'App'
}

</script>

<style>
  body {
    background-color: black;
    color: white;
  }
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: deeppink;
    margin-top: 60px;
  }
</style>
