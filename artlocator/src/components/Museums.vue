<template>
  <div>
    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full">
        <h1 class="text-3xl mt-2 text-center">Museums</h1>
      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex flex-col gap-6 text-left flex-wrap"
         v-for="(m, i) in museums" key="i">
      <h2 class="text-2xl mt-2">{{ m.name }}</h2>

      <div>
        <img :src="getImage(m.id)" class="h-60" :alt="m.name + ' - Image'"/>
      </div>

      {{ m.description }}

      <div>
        <a :href="m.url" target="_blank" class="link link-hover">{{ m.url }}</a>
      </div>

      <div>
        {{ m.country }},
        {{ m.city }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import {BASE_URL} from '../store'

export default {
  name: 'Venues',

  data() {
    return {
      museums: null
    }
  },

  created() {
    axios.get(BASE_URL, {
      params: {
        get: 'museums'
      }
    }).then(res => this.museums = res.data)
  },

  methods: {
    getImage(id) {
      return BASE_URL + '?get=image&from=museum&id=' + id
    }
  }
}
</script>

<style scoped>

</style>