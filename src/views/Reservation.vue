<template>
  <div class="Container">

    <div class="WrapperContent">
      <div class="ContainerHeader">
      <div class="ContainerImage"></div>
      <h1 class="TitleHeader">{{ book.name }}</h1>
      </div>

      <form class="ContainerForm">
        <div class="ContainerCheckIn">
          <label for="InputCheckIn" class="labelCheckIn">Data de Retirada</label>
          <Input type="date" id="InputCheckIn" v-model="checkin"/>
        </div>

        <div class="ContainerCheckOut">
          <label for="InputCheckOut" class="labelCheckOut">Data de Entrega</label>
          <Input type="date" id="InputCheckOut" v-model="checkout"/>
        </div>

        <Button content="Reservar" @click.prevent="handeReservation" type="submit"/>
      </form>
    </div>

  </div>
</template>

<script>
import Input from '@/components/Input.vue';
import Button from '@/components/Button.vue';
import axios from 'axios';


export default {
  name: 'Reservation',
  components: {
    Input,
    Button
  },
  methods: {
    handeReservation() {
      axios.post('http://localhost:8000/api/reserve',{
        user_name: this.$route.params.user,
        book_name: this.book.name,
        checkin: this.checkin,
        checkout: this.checkout,
      }).then(response => {
        console.log(this.book.name, this.checkin, this.checkout)
        console.log(response.data)
      }).catch(error => {
        if(error.message) {
          alert('Ocorreu um erro tente novamente')
        }
      });
    },
  },
  data() {
    return {
      book: {},
    }
  },
  mounted() {
    axios.get(`http://localhost:8000/api/books/${this.$route.params.id}`)
    .then(response => {
      this.book = response.data;
      console.log(response.data);
    })
  }
}
</script>

<style scoped>
.Container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  width: 100vw;
}

.ContainerForm {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 350px;
  width: 400px;
}

.ContainerHeader {
  display: flex;
  flex-direction: column;
  align-content: center;
  justify-content: center;
  text-align: center;
}

.ContainerImage {
  height: 300px;
  width: 200px;
  background: #0066ff;
  margin: 0 auto;
  border-radius: 5px;
  box-shadow: 2px 2px 4px rgba(0,0,0, 0.2);
}
.TitleHeader {
  margin: 20px auto 50px auto;
  font-size: 32px;
  font-family: 'Roboto';
  font-weight: 400;
}
.labelCheckIn {
  font-size: 20px;
  font-family: 'Roboto';
  font-weight: 400;
}
.labelCheckOut {
  font-size: 20px;
  font-family: 'Roboto';
  font-weight: 400;
}
.ContainerInput {
  margin-top: 15px;
}

</style>
