<template>
  <div id="app">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <fab :position="config_position" :bg-color="config_bgColor" :actions="config_actions" :position-type="config_position_type"
      :icon-size="config_icon_size" :main-icon="config_main_icon" :main-tooltip="config_main_tooltip" ></fab>
  </div>
</template>

<script>



  import fab from './FAB.vue';
  export default {
    components: {
      fab
    },
    data() {
      return config_float_btn
    }
  }
</script>