<template>
  <div>
    <div
        class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-around flex-wrap">

      <div class="form-control w-full lg:w-64">
        <div class="input-group">
          <input type="text" placeholder="Search…" class="input input-bordered w-full lg:w-64" v-model="searchText" @input="searchDelay"/>

          <button class="btn btn-square" @click="search">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="form-control">
        <div class="input-group">
          <select class="select select-bordered w-64" v-model="museum" @change="filterMuseum">
            <option disabled selected value="null">Museum</option>
            <option v-for="museum in museumSelector" :value="museum.id">{{ museum.name }}</option>
          </select>
          <button class="btn btn-square" @click="exitFilter">
            <exit-icon/>
          </button>
        </div>
      </div>

      <div class="form-control xl:mx-0">
        <div class="input-group">
          <select class="select select-bordered w-52" v-model="sortBy" @change="sort">
            <option disabled selected value="null">Sort By</option>
            <option>Name</option>
            <option>Year</option>
            <option>Artist</option>
            <option>Museum</option>
          </select>

          <label class="swap swap-rotate px-2" style="border: 1px solid #D6D6D6; border-left: 0">
            <!-- this hidden checkbox controls the state -->
            <input type="checkbox" v-model="descending" @change="sort"/>

            <svg class="swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
              <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path
                  d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z"/>
            </svg>

            <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
              <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
              <path
                  d="M374.6 310.6l-160 160C208.4 476.9 200.2 480 192 480s-16.38-3.125-22.62-9.375l-160-160c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 370.8V64c0-17.69 14.33-31.1 31.1-31.1S224 46.31 224 64v306.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0S387.1 298.1 374.6 310.6z"/>
            </svg>
          </label>

          <button class="btn btn-square" @click="exitSort">
            <exit-icon/>
          </button>
        </div>
      </div>

      <!--      <div class="flex justify-center w-full xl:w-max mx-auto xl:mx-0">-->
      <!--        <div class="btn-group">-->
      <!--          <button class="btn">«</button>-->
      <!--          <button class="btn btn-active">1</button>-->
      <!--          <button class="btn">2</button>-->
      <!--          <button class="btn">3</button>-->
      <!--          <button class="btn btn-disabled">...</button>-->
      <!--          <button class="btn">»</button>-->
      <!--        </div>-->
      <!--      </div>-->
    </div>


    <div>
      <portrait v-for="p in portraits" :id="p.id" :name="p.name" :description="p.description" :year="p.year"
                :artist="p.artist" :museum="p.museumName"/>
    </div>
  </div>
</template>

<script>
import Portrait from './Portrait.vue'
import ExitIcon from './ExitIcon.vue'
import axios from 'axios'
import {BASE_URL} from '../store'
import {Debouncer} from '../Debouncer'

const debouncer = new Debouncer(300)

export default {
  name: 'Main',

  components: {
    ExitIcon,
    Portrait
  },

  data() {
    return {
      searchText: null,
      museum: null,
      sortBy: null,
      descending: false,
      page: 1,
      museumSelector: [],
      portraits: [],
      portraitsSave: []
    }
  },

  methods: {
    loadPortraits() {
      axios.get(BASE_URL, {
        params: {
          get: 'portraits'
        }
      }).then(res => {
        this.portraits = [...res.data]
        this.portraitsSave = [...res.data]
      })
    },

    search() {
      if (this.searchText !== null) {
        if (this.searchText.trim() === '') {
          this.loadPortraits()
        } else {
          axios.get(BASE_URL, {
            params: {
              get: 'portraits',
              searchText: this.searchText
            }
          }).then(res => {
            this.portraits = [...res.data]
            this.portraitsSave = [...res.data]
          })
        }
      }
    },

    searchDelay() {
      debouncer.debounce(() => this.search())
    },

    sort() {
      const descending = this.descending
      const sortBy = this.sortBy
      if (sortBy === 'Year') {
        this.portraits.sort((a, b) => descending ? b.year - a.year : a.year - b.year)
      } else if (sortBy === 'Name' || sortBy === 'Artist' || sortBy === 'Museum') {
        this.portraits.sort((a, b) => {
          console.log(sortBy)
          let fa, fb
          if (sortBy === 'Name') {
            fa = a.name.toLowerCase()
            fb = b.name.toLowerCase()
          } else if (sortBy === 'Artist') {
            fa = a.artist.toLowerCase()
            fb = b.artist.toLowerCase()
          } else if (sortBy === 'Museum') {
            fa = a.museumName.toLowerCase()
            fb = b.museumName.toLowerCase()
          }

          if (fa < fb) {
            return -1;
          }
          if (fa > fb) {
            return 1
          }
          return 0
        })
        if (descending) {
          this.portraits.reverse()
        }
      }
    },

    filterMuseum() {
      this.portraits = [...this.portraitsSave]
      this.portraits = this.portraits.filter(p => p.museumId === this.museum)
    },

    exitFilter() {
      this.museum = null
      this.portraits = [...this.portraitsSave]
    },

    exitSort() {
      this.sortBy = null
      this.portraits = [...this.portraitsSave]
    }
  },

  created() {
    axios.get(BASE_URL, {
      params: {
        get: 'museums'
      }
    }).then(res => this.museumSelector = res.data)

    this.loadPortraits()
  },
}
</script>

<style scoped>

</style>