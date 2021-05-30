<template>
  <div class="ContainerInput" >

    <input 
      :type="type" 
      :name="inputName" 
      :value="modelValue"
      :placeholder="inputPlaceholder" 
      @input="$emit('update:modelValue', $event.target.value)"
      class="InputContent" 
      autocomplete="off"
    />
  </div>
</template>

<script>
export default {
  name: 'Input',
  props: {
    inputName: String,
    inputPlaceholder: String,
    modelValue: String,
    type: String,
  },
  emits: ['update:modelValue'],
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  div.ContainerInput {
    display: flex;
    height: 64px;
    

  }
  .InputContent {
    display: flex;
    align-items: center;
    flex: 1;
    padding: 0 15px;
    border: 2px solid #f8f7f9;
    outline: 0;
    box-shadow: 2px 2px 5px rgba(0,0,0, 0.2);
    border-radius: 5px;
    font-size: 18px;
    font-weight: 400;
    font-family: 'Roboto', sans-serif;
    background: #fff;
  }
  .InputContent:focus {
    border: 2px solid #0066ff;
  }
  .InputContent::placeholder {
    color: rgba(0,0,0, 0.5);
  }

</style>
