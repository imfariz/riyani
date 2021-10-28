<template>
<Topbar />
  <router-view/>
</template>

<script>
import Topbar from '@/components/Topbar.vue'

export default {
  components: {
    Topbar,
  }
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
}

body {
    font-family: 'Poppins', sans-serif;
}

a {
    color: #000;
}

.bon-primary {
  background-color: #fff;
  border: 2px solid #CE93D8;
  border-width: 2px;
}

.bon-secondary {
    background-color: #CE93D8;
    border: none;
    color: white;
}

  .vertical-divider {
    height: 20px;
    width: 1px;
    background-color: #666363;
}

.horizontal-divider {
    height: 1px;
    width: 100%;
    background-color: #CE93D8;
}

input[type=number] {
    border: solid 4px #CE93D8;
    border-radius: 32px;
    width: 75px;
    text-align: center;
    font-weight: bold;
    font-size: 1.25em;
    padding: 10px;
}

main {
    width: 90%;
    
    margin: auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>