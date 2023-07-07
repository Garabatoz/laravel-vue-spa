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
        <modal name="my-first-modal" 
            :width="800"
            :height="600"
            :adaptive="true" 
            v-if="selectedCharacter" 
        >
        <div class="button_modal">
            <button @click="$modal.hide('my-first-modal')" style="left:auto">
                ❌
            </button>
        </div>
            <h1>Nombre: {{ selectedCharacter.name }}</h1>
            <h3>Estado: {{ selectedCharacter.status }}</h3>
            <h3>Especie: {{ selectedCharacter.species }}</h3>
            <img :src="selectedCharacter.image">
            <!-- Agrega más detalles o información sobre el personaje según tus necesidades -->
        </modal>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  import Vue from 'vue'
  import modal from 'vue-js-modal'
  
Vue.use(modal)

  export default {
    name: 'MyComponent',
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
        justify-content: flex-end;
        padding: 10px;
      }
    </style>
  