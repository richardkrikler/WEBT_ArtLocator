<template>
  <div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content flex flex-col py-10">
      <!-- Navbar -->
      <div class="navbar bg-base-100 shadow-xl rounded-box mx-5 md:mx-10 w-auto">
        <div class="flex-1">
          <a class="btn btn-ghost normal-case text-xl" @click="$router.push({name: 'default'})">ArtLocator</a>
        </div>

        <div class="flex-none hidden md:block">
          <ul class="menu menu-horizontal p-0">
            <!-- Navbar menu content here -->
            <li><a @click="$router.push({name: 'Museums'})">Museums</a></li>
            <li><a @click="$router.push({name: 'About'})">About</a></li>
            <li><a @click="$router.push({name: 'Admin'})">Admin</a></li>
          </ul>
        </div>

        <div class="flex-none md:hidden">
          <label for="my-drawer-3" class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 class="inline-block w-6 h-6 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </label>
        </div>
      </div>

      <div class="mx-5 md:mx-10">
        <router-view/>
      </div>

    </div>

    <div class="drawer-side">
      <label for="my-drawer-3" class="drawer-overlay"></label>
      <ul class="menu p-4 overflow-y-auto w-80 bg-base-100">
        <!-- Sidebar content here -->
        <li><a class="normal-case text-xl font-bold" @click="$router.push({name: 'default'})">ArtLocator</a></li>
        <li><a @click="$router.push({name: 'Museums'})">Museums</a></li>
        <li><a @click="$router.push({name: 'About'})">About</a></li>
        <li><a @click="$router.push({name: 'Admin'})">Admin</a></li>
      </ul>
    </div>
  </div>
</template>

<script>
import Portrait from './components/Portrait.vue'

export default {
  components: {
    Portrait
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

html {
  background-color: rgb(242, 242, 242) !important;
}
</style>
