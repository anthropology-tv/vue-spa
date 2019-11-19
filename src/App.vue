<template xmlns:v="http://www.w3.org/1999/xhtml">
  <div id="app">
    <img width="320" height="auto" src="./assets/star.gif" />
    <br>
    <hr class="red"/>
    <div class="links">
      <a class="link" href="http://lariushin.org/">lariushin.org</a>
      ⛧ <a class="link" href="http://lariushin.top/">lariushin.top</a>
      ⛧ <a class="link" href="http://herbarium.info/">herbarium.info</a>
      ⛧ <a class="link" href="http://fungarium.info/">fungarium.info</a>
      ⛧ <a class="link" href="http://lichenarium.info/">lichenarium.info</a>
      ⛧ <a class="link" href="http://plantarium.info/">plantarium.info</a>
      ⛧ <a class="link" href="http://algaerium.info/">algaerium.info</a>
      ⛧ <a class="link" href="http://lariushin.com/">lariushin.com</a>
      ⛧ <a class="link" href="http://nightshade.blog/">nightshade.blog</a>
      ⛧ <a class="link" href="http://bettycat.vip/">bettycat.vip</a>
      ⛧ <a class="link" href="http://www.bibliothecium.info/">bibliothecium.info</a>
      ⛧ <a class="link" href="https://antropology.tv/#/">antropology.tv</a>
      ⛧ <a class="link" href="http://xn--land-saar-z7a.cc/">öland-saar.cc</a>
      ⛧ <a class="link" href="http://iceland-trip.cc/">iceland-trip.cc</a>
      ⛧ <a class="link" href="http://centralbrainz.tv/">centralbrainz.tv</a>
      ⛧ <a class="link" href="ttp://travel-pics.vip/">travel-pics.vip</a>
    </div>
    <hr class="red"/>
    <br>
    <router-view />
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
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: deeppink;
  margin-top: 60px;
}
.links {
  max-width: 800px;
  margin: 0 auto;
  color: white;
}
.link {
  color: red;
}
.red {
  border-color: red;
  border-bottom-style: unset;
  max-width: 800px;
}
</style>
