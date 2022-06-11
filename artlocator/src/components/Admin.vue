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
        <input class="btn btn-primary max-w-xs mx-auto" value="Add" @click="addMuseum">

      </div>
    </div>

    <div class="my-10 bg-base-100 shadow-2xl rounded-box p-5 flex justify-center gap-6 md:justify-between flex-wrap">
      <div class="text-center w-full flex flex-col gap-3">
        <h1 class="text-2xl mt-2 text-center">Portrait</h1>
        <input type="text" placeholder="Name" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.name"/>
        <input type="text" placeholder="Description" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.description"/>
        <input type="text" placeholder="Year" class="input input-bordered w-full max-w-xs mx-auto"
               v-model="portrait.year"/>
        <input type="file" placeholder="Image" class="input input-bordered w-full max-w-xs mx-auto"
               ref="portraitImage"/>

        <select class="select select-bordered max-w-xs mx-auto" v-model="portrait.museum">
          <option disabled selected value="null">Museum</option>
          <option>Louvre</option>
          <option>The Metropolitan Museum</option>
        </select>

        <input class="btn btn-primary max-w-xs mx-auto" value="Add" @click="addPortrait">
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {BASE_URL} from "../store";
import ErrorMessage from './ErrorMessage.vue'
import SuccessMessage from './SuccessMessage.vue'

export default {
  name: 'Admin',
  components: {SuccessMessage, ErrorMessage},
  data() {
    return {
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
        msg: null,
        name: null,
        description: null,
        year: null,
        image: null,
        museum: null
      }
    }
  },

  methods: {
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
        }
      }).catch((error) => {
        this.museum.msg = error
      })
    },

    addPortrait() {
      axios.post(BASE_URL, {
        params: {
          post: 'portrait',
          name: this.portrait.name,
          description: this.portrait.description,
          year: this.portrait.year,
          image: this.portrait.image,
          museum: this.portrait.museum
        }
      })
    }
  }
}
</script>

<style scoped>

</style>