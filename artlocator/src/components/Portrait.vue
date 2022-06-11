<template>
  <div class="card lg:card-side my-10 bg-base-100 shadow-2xl rounded-box p-5">
    <figure>
      <img :src="getImage()" alt="Portrait" class="w-56">
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ name }}</h2>

      <div class="text-left flex flex-col gap-2">
        <p>{{ description }}</p>
        <p>Year: {{ year }}</p>
        <p>Artist: {{ artist }}</p>
        <p>Museum: {{ museum }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import {BASE_URL} from '../store'

export default {
  name: 'Portrait',

  props: {
    id: {
      type: String,
      required: true
    },
    name: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    year: {
      type: String,
      default: ''
    },
    artist: {
      type: String,
      default: ''
    },
    museum: {
      type: String,
      default: ''
    }
  },

  methods: {
    getImage() {
      return BASE_URL + '?get=image&from=portrait&id=' + this.id
    }
  }
}
</script>

<style scoped>

</style>