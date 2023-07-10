<template>
  <div class="card">
    <div v-if="title" class="card-header" @click="showDetails">
      {{ title }}
    </div>

    <div class="card-body">
      <!-- Contenido de la tarjeta -->
      <img :src="imageUrl" alt="Imagen del personaje">
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null },
    imageUrl: { type: String, default: null },
  },
 
    methods: {
    showDetails() {
      this.$emit('show-details');
    }
}
}
  
</script>
<style scoped>
.card {
  /* Estilos de la tarjeta */
  width: calc(25% - 5px);
  margin-right: 5%;
  margin-bottom: 5%;
  float: left;
}
@media (max-width: 768px) {
  .card {
    width: 100%;
    float: none;
    margin-right: 0;
  }
}
.card-title {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
.card:nth-child(even) {
  margin-right: 0;
}
.card-body img {
  width: 100%;
  height: auto;
}
</style>