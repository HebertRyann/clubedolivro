<template>
  <div class="Container">
    <form class="ContainerForm" @submit.prevent="handleSubmit">
      <Input 
        inputName="email" 
        inputPlaceholder="Email" 
        v-model="email"

      />

      <Input 
        inputName="password" 
        type="password" 
        inputPlaceholder="Senha" 
        v-model="password"
      />

      <Button content="Entrar" type="submit"/>

    </form>
    <router-link to="/" class="SignUpPage">Voltar ao login</router-link>
    </div>
</template>

<script>
import Input from '@/components/Input.vue';
import Button from '@/components/Button.vue';
import axios from 'axios';


export default {
  name: 'SignUp',
  components: {
    Input,
    Button
  },
  methods: {
    handleSubmit() {
      axios.post('http://localhost:8000/api/users', {
        email: this.email,
        password: this.password,
      }).then(response => {
        if(response.data) {
          console.log(response.data)
          this.isAutheticated = true;
        }
      });
      
    }
  },
  data() {
    return {
      email: '',
      password: '',
      isAutheticated: false
    }
  }
}
</script>

<style scoped>
.Container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  width: 100vw;
}
.ContainerForm {
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 300px;
  width: 350px;
}
.ContainerInput:nth-child(2) {
  margin-top: 20px;
}
.ContainerButton {
  margin: 50px 0;
}
.TextSignUp {
  display: flex;
  align-items: center;
  font-size: 16px;
  font-weight: 400;
  font-family: 'Roboto', sans-serif;
  text-align: left;
  width: 350px;
}
.SignUpPage {
  font-size: 16px;
  font-weight: 400;
  font-family: 'Roboto', sans-serif;
  color: #0066ff;
  margin-left: 5px;
  text-decoration: 0;
  transition: 0.7s ease-in-out;
}
.SignUpPage:hover {
  transform: scale(1.12);
}
</style>
