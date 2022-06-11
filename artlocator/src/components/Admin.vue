<template>
  <div>
    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full">
        <h1 class="text-3xl mt-2 text-center">Admin</h1>
      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full flex flex-col gap-3">
        <h1 class="text-2xl mt-2 text-center">Museum</h1>

        <success-message class="max-w-xs mx-auto" v-if="museum.sucMsg" :msg="museum.sucMsg"/>
        <error-message class="max-w-xs mx-auto" v-if="museum.errMsg" :msg="museum.errMsg"/>

        <input type="text" placeholder="Name" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="museum.name"/>
        <input type="text" placeholder="Description" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="museum.description"/>
        <input type="url" placeholder="Country" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="museum.country"/>
        <input type="url" placeholder="City" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="museum.city"/>
        <input type="url" placeholder="URL" class="input input-bordered w-full max-w-xs mx-auto" v-model="museum.url"/>
        <input type="file" placeholder="Image" class="input input-bordered w-full max-w-xs mx-auto" ref="museumImage"/>
        <input class="btn btn-primary max-w-xs mx-auto" type="button" value="Add" @click="addMuseum">

      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full flex flex-col gap-3">
        <h1 class="text-2xl mt-2 text-center">Portrait</h1>

        <success-message class="max-w-xs mx-auto" v-if="portrait.sucMsg" :msg="portrait.sucMsg"/>
        <error-message class="max-w-xs mx-auto" v-if="portrait.errMsg" :msg="portrait.errMsg"/>

        <input type="text" placeholder="Name" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.name"/>
        <input type="text" placeholder="Description" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.description"/>
        <input type="text" placeholder="Year" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.year"/>
        <input type="text" placeholder="Artist" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.artist"/>
        <input type="file" placeholder="Image" class="input input-bordered w-full max-w-xs mx-auto"
               ref="portraitImage"/>

        <select class="select select-bordered max-w-xs mx-auto" v-model="portrait.museum">
          <option disabled selected value="null">Museum</option>
          <option v-for="museum in museumSelector" :value="museum.id">{{ museum.name }}</option>
        </select>

        <input class="btn btn-primary max-w-xs mx-auto" type="button" value="Add" @click="addPortrait">
      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full flex flex-col gap-3">
        <h1 class="text-2xl mt-2 text-center">Museum</h1>

        <success-message class="max-w-xs mx-auto" v-if="removeMuseum.sucMsg" :msg="removeMuseum.sucMsg"/>
        <error-message class="max-w-xs mx-auto" v-if="removeMuseum.errMsg" :msg="removeMuseum.errMsg"/>

        <select class="select select-bordered max-w-xs mx-auto" v-model="removeMuseum.id">
          <option disabled selected value="null">Museum</option>
          <option v-for="museum in museumSelector" :value="museum.id">{{ museum.name }}</option>
        </select>

        <input class="btn btn-primary max-w-xs mx-auto" type="button" value="Remove" @click="deleteMuseum">
      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full flex flex-col gap-3">
        <h1 class="text-2xl mt-2 text-center">Portrait</h1>

        <success-message class="max-w-xs mx-auto" v-if="removePortrait.sucMsg" :msg="removePortrait.sucMsg"/>
        <error-message class="max-w-xs mx-auto" v-if="removePortrait.errMsg" :msg="removePortrait.errMsg"/>

        <select class="select select-bordered max-w-xs mx-auto" v-model="removePortrait.id">
          <option disabled selected value="null">Portrait</option>
          <option v-for="portrait in portraitSelector" :value="portrait.id">{{ portrait.name }}</option>
        </select>

        <input class="btn btn-primary max-w-xs mx-auto" type="button" value="Remove" @click="deletePortrait">
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import {BASE_URL} from '../store'
import ErrorMessage from './ErrorMessage.vue'
import SuccessMessage from './SuccessMessage.vue'

export default {
  name: 'Admin',
  components: {SuccessMessage, ErrorMessage},
  data() {
    return {
      museumSelector: [],
      portraitSelector: [],
      museum: {
        errMsg: null,
        sucMsg: null,
        name: null,
        description: null,
        country: null,
        city: null,
        url: null
      },
      portrait: {
        errMsg: null,
        sucMsg: null,
        name: null,
        description: null,
        year: null,
        artist: null,
        image: null,
        museum: null
      },
      removeMuseum: {
        errMsg: null,
        sucMsg: null,
        id: null
      },
      removePortrait: {
        errMsg: null,
        sucMsg: null,
        id: null
      }
    }
  },

  methods: {
    loadMuseumSelector() {
      axios.get(BASE_URL, {
        params: {
          get: 'museums'
        }
      }).then(res => this.museumSelector = res.data)
    },

    loadPortraitSelector() {
      axios.get(BASE_URL, {
        params: {
          get: 'portraits'
        }
      }).then(res => this.portraitSelector = res.data)
    },

    addMuseum() {
      const selectedFile = this.$refs.museumImage.files[0]

      if (selectedFile === undefined) {
        this.addMuseumRequest(null)
        return
      }

      const reader = new FileReader()
      reader.readAsDataURL(selectedFile)
      reader.onload = () => {
        let data = reader.result
        this.addMuseumRequest(data);
      }
    },

    addMuseumRequest(data) {
      axios.post(BASE_URL, {
        post: 'museum',
        name: this.museum.name,
        description: this.museum.description,
        country: this.museum.country,
        city: this.museum.city,
        url: this.museum.url,
        image: data
      }).then((res) => {
        this.museum.sucMsg = null
        this.museum.errMsg = null
        if (res.data.error !== undefined) {
          this.museum.errMsg = res.data.error
        } else if (res.data.msg !== undefined) {
          this.museum.sucMsg = res.data.msg

          this.museum.name = null
          this.museum.description = null
          this.museum.country = null
          this.museum.city = null
          this.museum.url = null

          this.loadMuseumSelector()
        }
      }).catch((error) => {
        this.museum.msg = error
      })
    },

    addPortrait() {
      const selectedFile = this.$refs.portraitImage.files[0]

      if (selectedFile === undefined) {
        this.addPortraitRequest(null)
        return
      }

      const reader = new FileReader()
      reader.readAsDataURL(selectedFile)
      reader.onload = () => {
        let data = reader.result
        this.addPortraitRequest(data);
      }
    },

    addPortraitRequest(data) {
      axios.post(BASE_URL, {
        post: 'portrait',
        name: this.portrait.name,
        description: this.portrait.description,
        year: this.portrait.year,
        artist: this.portrait.artist,
        museum: this.portrait.museum,
        image: data
      }).then((res) => {
        this.portrait.sucMsg = null
        this.portrait.errMsg = null
        if (res.data.error !== undefined) {
          this.portrait.errMsg = res.data.error
        } else if (res.data.msg !== undefined) {
          this.portrait.sucMsg = res.data.msg

          this.portrait.name = null
          this.portrait.description = null
          this.portrait.year = null
          this.portrait.artist = null
          this.portrait.museum = null

          this.loadPortraitSelector()
        }
      }).catch((error) => {
        this.portrait.msg = error
      })
    },

    deleteMuseum() {
      axios.post(BASE_URL, {
        delete: 'museum',
        id: this.removeMuseum.id
      }).then((res) => {
        this.removeMuseum.sucMsg = null
        this.removeMuseum.errMsg = null
        if (res.data.error !== undefined) {
          this.removeMuseum.errMsg = res.data.error
        } else if (res.data.msg !== undefined) {
          this.removeMuseum.sucMsg = res.data.msg
          this.removeMuseum.id = null
          this.loadMuseumSelector()
        }
      }).catch((error) => {
        this.removeMuseum.msg = error
      })
    },

    deletePortrait() {
      axios.post(BASE_URL, {
        delete: 'portrait',
        id: this.removePortrait.id
      }).then((res) => {
        this.removePortrait.sucMsg = null
        this.removePortrait.errMsg = null
        if (res.data.error !== undefined) {
          this.removePortrait.errMsg = res.data.error
        } else if (res.data.msg !== undefined) {
          this.removePortrait.sucMsg = res.data.msg
          this.removePortrait.id = null
          this.loadPortraitSelector()
        }
      }).catch((error) => {
        this.removePortrait.msg = error
      })
    }
  },

  created() {
    this.loadMuseumSelector()
    this.loadPortraitSelector()
  }
}
</script>

<style scoped>

</style>