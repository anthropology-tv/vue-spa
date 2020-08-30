<template xmlns:v="http://www.w3.org/1999/xhtml">
  <div id="app">
    <img width="320" height="auto" src="/static/star.webp" />
    <br>
    <hr class="red"/>
    <div class="links">
      &bull;
      <a class="link" href="https://algaerium.info/">algaerium.info</a> &bull;
      <a class="link" href="https://antropology.tv/">antropology.tv</a> &bull;
      <a class="link" href="https://asmodeus.vip/">asmodeus.vip</a> &bull;
      <br />
      &bull;
      <a class="link" href="https://bettycat.vip/">bettycat.vip</a> &bull;
      <a class="link" href="https://www.bibliothecium.info/"
        >bibliothecium.info</a
      >
      &bull;
      <a class="link" href="https://centralbrainz.tv/">centralbrainz.tv</a>
      &bull;
      <br />
      &bull;
      <a class="link" href="https://egypt-trip.cc/">egypt-trip.cc</a> &bull;
      <a class="link" href="https://eldritch-horror.com/"
        >eldritch-horror.com</a
      >
      &bull;
      <a class="link" href="https://fungarium.info/">fungarium.info</a> &bull;
      <br />
      &bull;
      <a class="link" href="https://herbarium.info/">herbarium.info</a> &bull;
      <a class="link" href="https://horror-movies.best/">horror-movies.best</a>
      &bull;
      <a class="link" href="https://iceland-trip.cc/">iceland-trip.cc</a> &bull;
      <br />
      &bull;
      <a class="link" href="https://karelia-trip.cc/">karelia-trip.cc</a> &bull;
      <a class="link" href="https://käpalised.com/">käpalised.com</a> &bull;
      <a class="link" href="https://lariushin.com/">lariushin.com</a> &bull;
      &bull; <br />
      &bull;
      <a class="link" href="https://lichenarium.info/">lichenarium.info</a>
      <a class="link" href="https://melikian.vip/">melikian.vip</a> &bull;
      <a class="link" href="https://nightshade.blog/">nightshade.blog</a> &bull;
      <br />
      &bull;
      <a class="link" href="https://öland-saar.cc/">öland-saar.cc</a> &bull;
      <a class="link" href="https://plantarium.info/">plantarium.info</a> &bull;
      <a class="link" href="https://sciencebooks.cc/">sciencebooks.cc</a> &bull;
      <br />
      &bull;
      <a class="link" href="https://sochi-trip.cc/">sochi-trip.cc</a> &bull;
      <a class="link" href="https://tenerife-trip.cc/">tenerife-trip.cc</a>
      &bull;
      <a class="link" href="https://travel-pics.vip/">travel-pics.vip</a> &bull;
      &bull; <br />
      &bull;
      <a class="link" href="https://wheeloftheyear.page/">wheeloftheyear.page</a
      >&bull;<br />
    </div>
    <hr class="red"/>
    <br>
    <div class="input-group input-group-lg bottom">
      <div class="input-group-prepend">
        <span class="input-group-text">Search</span>
      </div>
      <input type="text"
        class="form-control"
        @keyup.prevent="search"
        v-model="query" />
    </div>
    <div v-if="data && data.length > 0" class="data">
      <br/>
      <hr class="red"/>
      <br/>
      <div v-for="(value, index) in data"
      :key="index"
      :ref="`card_${index}`" class="values">
        <div class="div-img"><a :href="value.img_url" target="_blank"><img :src="value.img_url" class="thumb"/></a></div>
        <div class="div-value">
          <h5><a href="#" class="rot" @click="clearData(value.url)">{{value.name}}</a></h5>
          <h6 class="blue">{{value.description}}</h6>
          <template v-for="cathash in catshashes(value.keywords)">
            &nbsp; <a href="#" class="yellow" @click="clearData('/hash/' + cathash.substr(1) + '')" v-bind:key="cathash">{{ cathash }}</a>
          </template>
        </div>
      </div>
    </div>
    <br/>
    <hr class="red"/>
    <router-view />
  </div>
</template>
<script>
import json from './json/vids.json'

export default {
  name: 'App',
  data () {
    return {
      query: '',
      data: []
    }
  },
  methods: {
    clearData (url) {
      this.$router.push(url)
      this.data = []
      this.query = ''
    },
    catshashes (cats) {
      let array = []
      cats.split(' ').forEach(cat => {
        array.push(cat)
      })
      return array.filter((item, index) => array.indexOf(item) === index)
    },
    extension (url) {
      console.log(url)
      // Remove everything to the last slash in URL
      url = url.substr(1 + url.lastIndexOf('/'))
      // Break URL at ? and take first part (file name, extension)
      url = url.split('?')[0]
      // Sometimes URL doesn't have ? but #, so we should aslo do the same for #
      url = url.split('#')[0]
      // Now we have only extension
      url = url.substr(0, url.lastIndexOf('.'))

      return url
    },
    search () {
      if (this.query.length < 3) {
        return
      }
      console.log(this.query)
      let results = []
      json.forEach(element => {
        let str, n
        let result = {
          keywords: '',
          name: '',
          url: '',
          img_url: '',
          description: ''
        }
        str = element.description
        n = str.toLowerCase().indexOf(this.query)
        if (n === -1) {
          str = element.cats
          n = str.toLowerCase().indexOf(this.query)
        }
        if (n >= 0) {
          result.keywords = element.cats
          result.name = element.name
          result.description = element.description
          result.url = encodeURI('/vid/' + element.url)
          result.img_url = encodeURI('/thumbs/' + this.extension(element.url) + '.webp')
          results.push(result)
        }
      })
      this.data = results
    }
  }
}
</script>

<style>
body {
  background-color: black!important;
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
.rot {
  color: red;
  word-wrap: break-word;
}
.pink {
  color: deeppink;
  word-wrap: break-word;
}
.yellow {
  color: yellow;
  word-wrap: break-word;
}
.green {
  color: lawngreen;
  word-wrap: break-word;
}
.blue {
 color: dodgerblue;
 word-wrap: break-word;
}
.red {
  border-color: red;
  border-bottom-style: unset;
  max-width: 800px;
}
.bottom {
    margin-top: 50px;
    margin-left: 200px;
}
.card-row {
  display: flex;
  justify-content: center;
  align-items: center;
  min-width: 780px;
  width: 100%;
  height: 500px;
}
.card {
  position: relative;
  background-color: #FFFFFF;
  height: 370px;
  width: 240px;
  margin: 10px;
  overflow: hidden;
  box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.5);
}
.card-image {
  position: absolute;
  left: -9999px;
  right: -9999px;
  margin: auto;
  height: 220px;
  min-width: 100%;
}
.card-footer {
  position: absolute;
  bottom: 0;
  height: 130px;
  padding: 10px 15px;
  font-family: Helvetica;
}
.card-text {
  font-size: 14px;
  color: rgba(0, 0, 0, 0.7);
}
.card-title {
  font-family: Serif;
}
.card-author {
  font-size: 14px;
  color: #BAB096;
}
.input-group {
  max-width: 640px;
  margin: 0 auto;
}
.thumb {
  width: 160px;
  height: auto;
  padding-right: 20px;
}
.data {
  margin: 0 auto;
  text-align: center;
  max-width: 800px;
}
.values {
  display: flex;
  margin-left: 100px;
  padding-bottom: 10px;
  padding-top: 5px;
  text-align: center;
}
.div-img {
  text-align: left;
}
.div-value {
  text-align: left;
}
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: lawngreen;
  word-wrap: break-word
}
.pink {
  color: deeppink;
  word-wrap: break-word
}
.yellow {
  color: yellow;
  word-wrap: break-word
}
.green {
  color: lawngreen;
  word-wrap: break-word
}
.blue {
 color: dodgerblue;
 word-wrap: break-word
}
.mainblock {
  max-width: 800px;
  margin: 0 auto;
}
.videoblock {
  max-width: 640px;
  width: 100%;
  min-width: 320px;
}
.flip {
  -webkit-transform: scale(-1, -1);
  transform: scale(-1, -1);
}
</style>
