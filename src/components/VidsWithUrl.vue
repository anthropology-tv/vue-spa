<template>
  <div class="iblock mainblock">
    <h1>#{{ this.$route.params.uri }}</h1>
    <div class="iblock">
      <div class="iblock yellow" >
      <template v-for="cathash in catshashes">
        &nbsp;<router-link class="yellow" :to="'/hash/' + cathash.substr(1) + ''" v-bind:key="cathash">{{ cathash }}</router-link>
      </template>
      </div>
      <div class="iblock" v-for="data in videos" v-bind:key="data.url">
        <h2 class="iblock pink">
        😈  <a name="anchor">{{ data.name !== 'todo add name' ? data.name : data.url.split('.')[0] }}</a>  😈
        </h2>
        <div class="iblock">
          <video id="viddiv" class="videoblock" webkit-playsinline="true"
                 playsinline="true" ref="videoRef"
                 :src="encodeURI('../videos/' + data.url)"
                 height="auto"
                 muted="muted"
                 autoplay
                 preload
                 controls>
          </video>
        </div>
        <h3 class="iblock blue">
          {{ data.description !== 'todo add description' ? data.description : data.url.split('.')[0] }}
        </h3>
        <h4 class="iblock green">
          <input type="hidden" :v-model="encodeURI('../videos/' + data.url)"/>
          <a v-clipboard:copy="encodeURI('../videos/' + data.url)" :href="'#' + encodeURI(data.url)">
            {{ encodeURI('../videos/' + data.url) }}
          </a>
        </h4>
        <h4 class="iblock yellow">
          <template v-for="cat in data.cats.split(' ')" to="/">
            &nbsp;<router-link class="yellow" :to="'/hash/' + cat.substr(1) + ''" v-bind:key="cat">{{ cat }}</router-link>
          </template>
        </h4>
      </div>
    </div>
    <img class="flip" width="320" height="auto" src="/static/star.webp">
  </div>
</template>

<script>
import json from '../json/vids.json'
import Vue from 'vue'
import VueClipboard from 'vue-clipboard2'
import $ from 'jquery'

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
      vids: this.jsonWithUrl(json),
      uri: this.$route.params.uri
    }
  },
  computed: {
    videos () {
      return this.jsonWithUrl(json)
    },
    catshashes () {
      let array = []
      this.jsonWithUrl(json).forEach(element => {
        let cats = element.cats.split(' ')
        cats.forEach(cat => {
          array.push(cat)
        })
      })
      return array.filter((item, index) => array.indexOf(item) === index)
    }
  },
  methods: {
    jsonWithUrl (json) {
      let jsonOut = []
      json.forEach(item => {
        let str = item.url
        if (str === this.$route.params.uri) {
          jsonOut.push(item)
        }
      })
      return jsonOut
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
    }
  },
  mounted: function () {
    var video = $('#viddiv')
    video.on('play', function (e) {
      if (video.requestFullscreen) {
        video.requestFullscreen()
      } else if (video.mozRequestFullScreen) {
        video.mozRequestFullScreen()
      } else if (video.webkitRequestFullscreen) {
        video.webkitRequestFullscreen()
      }
    })
  }
}
</script>
