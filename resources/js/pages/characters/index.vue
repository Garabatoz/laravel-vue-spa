<template>
  <div class="row">
    <div class="col-10 m-auto">
      <div v-for="character, i in characters" :key="i">
          <Card :title="characters[i].name" :image-url="character.image" @show-details="showCharacterDetails(characters[i])">
              {{ i+1 }} {{ characters[i].name }}
          </Card>
      </div>
      <modal name="my-first-modal" 
          :width="800"
          :height="600"
          :adaptive="true" 
          v-if="selectedCharacter" 
          >
      <div class="button_modal">
        <p style="text-align: center;">Especificaciones del personaje</p>
          <button @click="$modal.hide('my-first-modal')">
              ❌
          </button>
      </div>
          <h3>Nombre: {{ selectedCharacter.name }}</h3>
          <h3>Estado: {{ selectedCharacter.status }}</h3>
          <h3>Especie: {{ selectedCharacter.species }}</h3>
          <img :src="selectedCharacter.image" alt="Imagen del personaje"><br>
          <button @click="toggleFavorito(selectedCharacter.id)">
            <favorite name="favorite" :value="selectedCharacter.isFavorite"></favorite>
          </button>
          <!-- Agrega más detalles o información sobre el personaje según tus necesidades -->
      </modal>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Vue from 'vue'
import modal from 'vue-js-modal'
import Card from '~/components/CardChild.vue'

Vue.use(modal)

export default {
  name: 'MyComponent',
  components:{
      Card
  },
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
    this.$modal.show('my-first-modal')
  },
  /* mounted () {
    this.fetchFavoritos()
  }, */
  methods: {
    isFavorito(characterId) {
      return this.favoritos.includes(characterId);
    },
    showCharacterDetails (character) {
      this.selectedCharacter = character
      this.$modal.show('my-first-modal')
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
  <style>
  .button_modal {
      /* Agrega tus estilos personalizados aquí */
      display: flex;
      justify-content:space-between;
      padding: 0px;
    }
    h1 {
      font-size: 18px;
    }
    h3 {
      font-size: 18px;
    }
  </style>