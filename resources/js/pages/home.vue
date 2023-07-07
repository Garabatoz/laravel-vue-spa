<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
      </card>
    </div>
  </div>
</template>

<script>

export default {
  data () {
    return {
      select: '',
    }
  },
  created () {
  },
  /* mounted () {
    this.fetchFavoritos()
  }, */
  methods: {
  },
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
