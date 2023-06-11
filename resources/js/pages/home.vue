<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
        <ul>
          <li v-for="character, i in characters" :key="i">
            {{ characters[i].name }}
            <select label="favorito">
              <option value="true">true</option>
              <option value="false" selected>false</option>
            </select>
            <!-- <img :src=" characters[i].image " alt=""> -->
          </li>
        </ul>
      </card>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      characters: [],
      select: ''
    }
  },
  created () {
    this.fetchCharacters()
  },
  methods: {
    fetchCharacters () {
      axios.get('https://rickandmortyapi.com/api/character')
        .then(response => {
          this.characters = response.data.results
        })
        .catch(error => {
          console.error(error)
        })
    }
  },
  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
