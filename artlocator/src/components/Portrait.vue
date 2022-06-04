<template>
  <div class="card lg:card-side my-10 bg-base-100 shadow-2xl rounded-box p-5">
    <figure><img src="https://api.lorem.space/image/album?w=300&h=300" alt="Album"></figure>
    <div class="card-body">
      <h2 class="card-title">New album is released!</h2>
      <p>Click the button to listen on Spotiwhy app.</p>
      <div class="card-actions justify-end">
        <button class="btn btn-primary">Listen</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Portrait'
}
</script>

<style scoped>

</style>