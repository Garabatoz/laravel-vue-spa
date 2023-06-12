<template>
  <div class="row">
    <div class="col-lg-10 m-auto">
      <card :title="$t('home')">
        {{ $t('you_are_logged_in') }}
        <ul>
          <li v-for="character, i in characters" :key="i">
            {{ i+1 }} {{ characters[i].name }}
            <button @click="toggleFavorito(characters[i].id)">
              {{ isFavorito(characters[i].id) ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}
            </button>
            <button @click="showCharacterDetails(characters[i])">Detalles</button>
          </li>
        </ul>
      </card>
      <div v-if="selectedCharacter">
        <h3>Nombre: {{ selectedCharacter.name }}</h3>
        <img :src="selectedCharacter.image">
        <p>Estado: {{ selectedCharacter.status }}</p>
        <p>Especie: {{selectedCharacter.species}}</p>
        <!-- Agrega más detalles o información sobre el personaje según tus necesidades -->
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
import VModal from 'vue-js-modal'

Vue.use(VModal, {
  dynamicDefaults: {
    draggable: true,
    resizable: true,
    height: 'auto'
  }
})

export default {
  data () {
    return {
      characters: [],
      favoritos: [],
      select: '',
      showModal: false,
      selectedCharacter: null
    }
  },
  created () {
    this.fetchCharacters()
  },
  /* mounted () {
    this.fetchFavoritos()
  }, */
  methods: {
    showCharacterDetails (character) {
      console.log(character)
      this.selectedCharacter = character
      this.showModal = true
    },
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
      /* return this.favoritos.includes(characterId) */
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
