<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
        <ul>
          <li v-for="character, i in characters" :key="i">
            {{ characters[i].name }}
            <button @click="toggleFavorito(i)">
              {{ isFavorito(i) ? 'Quitar de favoritos' : 'Agregar a favoritos' }}
            </button>
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
      favoritos: [],
      select: ''
    }
  },
  created () {
    this.fetchCharacters()
  },
  methods: {
    toggleFavorito (characterId) {
      const isFavorito = this.favoritos[characterId]

      axios.post(`/api/favoritos/${characterId}`)
        .then(response => {
          if (isFavorito) {
            this.$delete(this.favoritos, characterId)
          } else {
            this.$set(this.favoritos, characterId, true)
          }
        })
        .catch(error => {
          console.error(error)
        })
    },
    isFavorito (index) {
      return this.favoritos.includes(index)
    },
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
