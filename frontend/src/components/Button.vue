<template>
  <div class="ContainerButton">
    <button 
      :type="buttonType"
      class="ButtonContent" 
    >{{ content }}</button>
  </div>
</template>

<script>
export default {
  name: 'Button',
  props: {
    content: String,
    inputPlaceholder: String
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  div.ContainerButton {
    display: flex;
    height: 64px;
  }
  .ButtonContent {
    flex: 1;
    border: 0;
    outline: 0;
    border-radius: 5px;
    background: #0066ff;
    color: #fff;
    transition: all 0.7s;
    font-size: 18px;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
  }
  .ButtonContent:hover {
    transform: scale(1.1);
  }
</style>
