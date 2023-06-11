<template>
  <card :title="$t('your_info')">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="$t('info_updated')" />

      <!-- Name -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{ $t('name') }}</label>
        <div class="col-md-7">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
          <has-error :form="form" field="name" />
        </div>
      </div>

      <!-- Email -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">{{ $t('email') }}</label>
        <div class="col-md-7">
          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
          <has-error :form="form" field="email" />
        </div>
      </div>

      <!-- Address -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">Dirección</label>
        <div class="col-md-7">
          <input v-model="form.address" :class="{ 'is-invalid': form.errors.has('address') }" class="form-control" type="address" name="address">
          <has-error :form="form" field="address" />
        </div>
      </div>

      <!-- Birthday -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">Cumpleaños</label>
        <div class="col-md-7">
          <input v-model="form.birthday" :class="{ 'is-invalid': form.errors.has('birthday') }" class="form-control" type="birthday" name="birthday">
          <has-error :form="form" field="birthday" />
        </div>
      </div>

      <!-- City -->
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label text-md-end">Ciudad</label>
        <div class="col-md-7">
          <input v-model="form.city" :class="{ 'is-invalid': form.errors.has('city') }" class="form-control" type="city" name="city">
          <has-error :form="form" field="city" />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="mb-3 row">
        <div class="col-md-9 ms-md-auto">
          <v-button :loading="form.busy" type="success">
            {{ $t('update') }}
          </v-button>
        </div>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      birthday: '',
      address: ''
    })
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
