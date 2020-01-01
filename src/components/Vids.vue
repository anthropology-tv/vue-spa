<template>
  <div class="iblock mainblock">
    <h1>{{ msg }}</h1>
    <div class="iblock">
      <div class="iblock yellow" >
      <template v-for="cathash in catshashes">
        &nbsp;<router-link class="yellow" :to="'/hash/' + cathash.substr(1) + ''" v-bind:key="cathash">{{ cathash }}</router-link>
      </template>
      </div>
      <div class="iblock" v-for="data in vids" v-bind:key="data.url">
        <h2 class="iblock pink">
        😈  <a :name="encodeURI(data.url)">{{ data.name !== 'todo add name' ? data.name : data.url.split('.')[0] }}</a>  😈
        </h2>
        <div class="iblock">
          <router-link :to="encodeURI('/vid/' + data.url)">
          <img :src="encodeURI('../thumbs/' + extension(data.url) + '.webp')" class="videoblock" height="auto" /></router-link>
        </div>
        <h3 class="iblock blue">
          {{ data.description !== 'todo add description' ? data.description : data.url.split('.')[0] }}
        </h3>
        <h4 class="iblock green">
          <input type="hidden" :v-model="encodeURI('../videos/' + data.url)"/>
          <router-link  v-clipboard:copy="encodeURI('../videos/' + data.url)" :to="'/vid/' + encodeURI(data.url)">
            {{ encodeURI('../videos/' + data.url) }}
          </router-link >
        </h4>
        <h4 class="iblock yellow">
          <template v-for="cat in data.cats.split(' ')" to="/">
            &nbsp;<router-link class="yellow" :to="'/hash/' + cat.substr(1) + ''" v-bind:key="cat">{{ cat }}</router-link>
          </template>
        </h4>
        <hr class="pink"/>
      </div>
    </div>
    <img class="flip" width="320" height="auto" src="/static/star.webp">
  </div>
</template>

<script>
import json from '../json/vids.json'
import Vue from 'vue'
import VueClipboard from 'vue-clipboard2'

Vue.use(VueClipboard)
export default {
  name: 'video-collection',
  props: {
    options: {
      type: Object,
      default () {
        return {}
      }
    }
  },
  data () {
    return {
      msg: 'Abhorrent unknown, Psyche and Abominations, Curious Anthropology',
      vids: json
    }
  },
  computed: {
    catshashes () {
      let array = []
      json.forEach(element => {
        let cats = element.cats.split(' ')
        cats.forEach(cat => {
          array.push(cat)
        })
      })
      return array.filter((item, index) => array.indexOf(item) === index)
    }
  },
  methods: {
    extension (url) {
      // Remove everything to the last slash in URL
      url = url.substr(1 + url.lastIndexOf('/'))
      // Break URL at ? and take first part (file name, extension)
      url = url.split('?')[0]
      // Sometimes URL doesn't have ? but #, so we should aslo do the same for #
      url = url.split('#')[0]
      // Now we have only extension
      url = url.substr(0, url.lastIndexOf('.'))

      return url
    }
  },
  mounted: function () {
  }
}
</script>
