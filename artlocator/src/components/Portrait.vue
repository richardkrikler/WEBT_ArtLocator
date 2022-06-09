<template>
  <div class="card lg:card-side my-10 bg-base-100 shadow-2xl rounded-box p-5">
    <figure>
      <img src="https://api.lorem.space/image/album?w=250&h=250" alt="Portrait">
    </figure>
    <div class="card-body">
      <h2 class="card-title">{{ name }}</h2>

      <div class="text-left flex flex-col gap-2">
        <p>{{ description }}</p>
        <p>Artist: {{ artist }}</p>
        <p>Venue: <a class="link link-hover">{{ venue }}</a></p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Portrait',

  props: {
    name: {
      type: String,
      default: ''
    },
    description: {
      type: String,
      default: ''
    },
    artist: {
      type: String,
      default: ''
    },
    venue: {
      type: String,
      default: ''
    }
  }
}
</script>

<style scoped>

</style>