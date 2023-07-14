<template>
    <div class="row">
      <div class="col-10 m-auto">
        <div v-for="character, i in characters" :key="i">
            <Card :title="characters[i].name" :image-url="character.image" @show-details="showCharacterDetails(characters[i])">
                {{ i+1 }} {{ characters[i].name }}
            </Card>
        </div>
        <!-- <modal name="my-first-modal" 
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
            <img :src="selectedCharacter.image" alt="Imagen del personaje"><br>
            <button @click="toggleFavorito(selectedCharacter.id)">
                {{ isFavorito(selectedCharacter.id) ? 'Eliminar de favoritos' : 'Agregar a favoritos' }}
            </button>
         Agrega más detalles o información sobre el personaje según tus necesidades 
        </modal> -->
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
        favoritosIds: [],
        favoritos: [],
        /* select: '',
        showModal: false,
        selectedCharacter: null */
      }
    },
    mounted () {
        this.fetchFavoritos()
        console.log(JSON.stringify(this.favoritosIds))
    },
    watch:{
        
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
        var val = [];
        axios.get('api/favoritos')
          .then(response => {
            console.log(JSON.stringify(response.data))
            val = (response.data)            
            this.fetchCharacters(val)
        })
        .catch(error => {
            console.error(error)
        })
        this.favoritos = val
        console.log(JSON.stringify(this.favoritos))  
    },
    fetchCharacters(val) {
          val.forEach(id => {
            console.log(id)
            axios.get(`https://rickandmortyapi.com/api/character/${id}`)
                .then(response => {
                this.characters.push(response.data)
            })
            .catch(error => {
                console.error(error);
            });
        });
        },    
    metaInfo () {
      return { title: this.$t('home') }
    }
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
  