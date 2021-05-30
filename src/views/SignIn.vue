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

      <router-link :to="{ name: 'Dashboard', params: { user: email }}" type="submit" class="ContainerLink">Entrar</router-link>

    </form>
    <p class="TextSignUp">
      Não tem conta ? 
      <a href="/signup" class="SignUpPage"> Criar Conta</a>
    </p>
    </div>
</template>

<script>
import Input from '@/components/Input.vue';
import axios from 'axios';


export default {
  name: 'SignIn',
  components: {
    Input,
  },
  methods: {
    handleSubmit() {
      axios.post('http://localhost:8000/api/users', {
        email: this.email,
        password: this.password,
      }).then(response => {
        if(response.data) {
          console.log(response.data);
          this.isAuthenticated = true;

        }
      });
      
    }
  },
  data() {
    return {
      email: '',
      password: '',
      isAuthenticated: false,
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
.ContainerLink {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 64px;
  text-align: center;
  background: #0066ff;
  font-size: 16px;
  font-family: 'Roboto';
  font-weight: 400;
  transition: 0.7s ease-in-out;
  text-decoration: none;
  color: #fff;
  margin-top: 50px;
  border-radius: 5px;
}

</style>
