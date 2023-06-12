<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
        <ul>
          <li v-for="character, i in characters" :key="i">
            {{ i+1 }} {{ characters[i].name }}
            <button @click="toggleFavorito(characters[i].id)" :class="{ 'btn-green': !isFavorito, 'btn-red': isFavorito }">
              {{ isFavorito(characters[i].id) ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}
            </button>
            <!-- <button
              v-if="isFavorito(characters[i].id)"
              @click="eliminarFavorito"
            >
              Eliminar de favoritos
            </button>
            <button
              v-else
              @click="toggleFavorito(characters[i].id)"
            >
              Agregar a favoritos
            </button> -->
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
  /* mounted () {
    this.fetchFavoritos()
  }, */
  methods: {
    fetchFavoritos () {
      axios.get('api/favoritos')
        .then(response => {
          this.favoritos = response.data
        })
        .catch(error => {
          console.error(error)
        })
    },
    toggleFavorito (characterId) {
      console.log(characterId)
      axios.post(`/api/toggle-favorito/${characterId}`)
        .then(response => {
          // Actualizar la lista de favoritos después de agregar o eliminar
          this.fetchFavoritos()
        })
        .catch(error => {
          console.error(error)
        })
    },
    isFavorito (characterId) {
      return this.favoritos.includes(characterId)
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
