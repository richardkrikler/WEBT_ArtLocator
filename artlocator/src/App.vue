<template>
  <div class="drawer">
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content flex flex-col py-10">
      <!-- Navbar -->
      <div class="navbar bg-base-100 shadow-xl rounded-box mx-5 md:mx-10 w-auto">
        <div class="flex-1">
          <a class="btn btn-ghost normal-case text-xl">ArtLocator</a>
        </div>

        <div class="flex-none hidden md:block">
          <ul class="menu menu-horizontal p-0">
            <!-- Navbar menu content here -->
            <li><a>Navbar Item 1</a></li>
            <li><a>Admin</a></li>
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
        <!--        <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5">-->
        <!--          Art Locator - A consortium of museums has contacted you to create a web app which allows to store information-->
        <!--          on which portrait is located at which venue. (e.g.: Mona Lisa at the Louvre). It is important to be able to-->
        <!--          store, retrieve and sort the information.-->
        <!--          <br/>-->
        <!--          <a href="https://www.louvre.fr/en" target="_blank" class="link link-hover">https://www.louvre.fr/en</a>-->
        <!--        </div>-->

        <div
            class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap ">
          <div class="form-control">
            <div class="input-group">
              <input type="text" placeholder="Search…" class="input input-bordered"/>
              <button class="btn btn-square">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
              </button>
            </div>
          </div>

          <div class="btn-group">
            <button class="btn">«</button>
            <button class="btn">1</button>
            <button class="btn">2</button>
            <button class="btn active">3</button>
            <button class="btn btn-disabled">...</button>
            <button class="btn">»</button>
          </div>
        </div>

        <div>
          <portrait v-for="p in 4"/>
        </div>
      </div>


    </div>
    <div class="drawer-side">
      <label for="my-drawer-3" class="drawer-overlay"></label>
      <ul class="menu p-4 overflow-y-auto w-80 bg-base-100">
        <!-- Sidebar content here -->
        <li><a class="normal-case text-xl font-bold">ArtLocator</a></li>
        <li><a>Sidebar Item 1</a></li>
        <li><a>Admin</a></li>
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
