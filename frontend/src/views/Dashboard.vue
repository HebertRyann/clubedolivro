<template>
  <div class="Container">

    <div class="wrapperContent">

      <div class="ContainerBooks" >
        <div class="book" v-for="book in books" :key="book.id">
          
            <h1 class="TitleBook">{{ book.name }}</h1>
            <router-link :to="{ name: 'Reservation', params: { id: book.id, user: $route.params.user } }" class="ContainerButtonReservation">Reservar</router-link>            
            <button class="ContainerButtonRemoved" @click=handleRemoved(book.id)>Excluir</button>
        </div>
      </div> 
      <div class="WrapperInfo">
        <form class="ContainerForm" @submit.prevent="handleSubmit">
          <h1 class="TitleForm">Cadastra Titulo</h1>
          <Input 
            v-model="bookName"
          />
          <Button content="Adicionar" class="ContainerButtonAdd" type="submit"/>
        </form>  

        <div class="WrapperContentReservation" >
          <h1 class="TextReservation">Titulos Reservados</h1>

          <div class="ContainerBook" v-for="bookReserve in booksReservated" :key=bookReserve.id>
            <p class="TitleBook">{{ bookReserve.book_name }}</p>
            <button type="button" class="ContainerButtonDelivery" @click="handleremoveReservation(bookReserve.id)">Entregar</button>
          </div>
        </div>          

      </div> 
    </div>   
      
  </div>
</template>

<script>
import Input from '@/components/Input.vue';
import Button from '@/components/Button.vue';
import axios from 'axios';


export default {
  name: 'Dashboard',
  components: {
    Input,
    Button
  },
  mounted() {
    axios.get('http://localhost:8000/api/books')
    .then(response => {
      if(response.data) {
        console.log(response.data)
        this.books = response.data;
      }
    });
    axios.get(`http://localhost:8000/api/reserve/${this.$route.params.user}`)
    .then(response => {
      if(response.data) {
        console.log(response.data, 'reserve')
        this.booksReservated = response.data;
      }
    });
  },
  methods: {
    handleSubmit() {
      try {
        axios.post('http://localhost:8000/api/books', {
          name: this.bookName,
        }).then(response => {
        if(response.data) {
          console.log(response.data)
          this.books.push(response.data);
        }});
      } catch (error) {
        new Error('This already exits')        
      }
    },
    handleremoveReservation(id) {
      axios.delete(`http://localhost:8000/api/reserve/${id}`)
      .then(response => {
        this.booksReservated = response.data;
        alert('Entrega feita com sucesso');
      }).catch(error => {
        if(error)
        alert('Ocorreu um erro tente novamate');
      }) 
    },
    handleRemoved(id) {
      axios.delete(`http://localhost:8000/api/books/${id}`).then(response => {
        if(response.data) {
          console.log(response.data)
          this.books = response.data;
        }
      });
    }
  },
  data() {
    return {
      bookName: '',
      books: [],
      booksReservated: [],
    }
  }
}
</script>

<style scoped>
.Container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  width: 100vw;
}
.ContainerHeader {
  display: flex;
  height: 102px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}
.wrapperContent {
  display: flex;
  min-width: 95%;
  height: 100%;
}
.ContainerForm {
  display: flex;
  flex-direction: column;
  justify-content: center;
  height: 250px;
  width: 350px;
  margin-top: 50px;
}
.ContainerBooks {
  display: flex;
  justify-content: space-between;
  height: 80%;
  width: 75%;
  padding: 20px;
  flex-wrap: wrap;
}
.book {
  display: flex;
  text-align: center;
  justify-content: space-between;
  flex-direction: column;
  box-shadow: 2px 2px 4px rgba(0,0,0, 0.2);
  height: 450px;
  width: 260px;
  border-radius: 8px;
  background: #fff;
  font-size: 20px;
  padding: 15px;
  margin-bottom: 20px;
}
.TitleBook {
  background: transparent;
  text-transform: capitalize;
  font-size: 26px;
  font-family: 'Roboto';
  font-weight: 400;
}
.ContainerBookImage {
  border-radius: 5px;
  height: 55%;
  background: #ff9000;
}
.ContainerButtonReservation {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 64px;
  text-align: center;
  background: transparent;
  font-size: 16px;
  font-family: 'Roboto';
  font-weight: 400;
  border: 2px solid #0066ff;
  transition: 0.7s ease-in-out;
  text-decoration: none;
}
.ContainerButtonReservation:hover {
  background: #0066ff;
  color: #fff;
}
.ContainerButtonRemoved {
  height: 50px;
  border: 2px solid #e5e5e5;
  background: transparent;
  font-size: 14px;
  color: #000;
  transition: 0.5s ease-in-out;

}
.ContainerButtonRemoved:hover {
  border: 2px solid rgba(0, 0, 0, 0.7);
}
.ContainerButtonAdd {
  margin-top: 30px;
  border: 0;
}
.TitleForm {
  text-align: center;
  margin-bottom: 20px;
  font-family: 'Roboto';
  font-weight: 400;
  font-size: 40px;
}
.TextReservation {
  background: transparent;
  display: flex;
  justify-content: center;
  font-family: 'Roboto';
  font-weight: 400;

}
.ContainerBook {
  display: flex;
  align-items: center;
  background: transparent;
  justify-content: space-between;
  margin-top: 50px;
}
.ContainerButtonDelivery {
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 5px;
  background: #0066ff;
  height: 64px;
  width: 150px;
  color: #fff;
  border: 0;
  transition: 0.7s;
  cursor: pointer;
}
.ContainerButtonDelivery:hover {
  transform: scale(1.12);
}
.WrapperContentReservation {
    display: flex;
  flex-direction: column;
  height: 400px;
  width: 350px;
  background: #fff;
  padding: 5px 20px 20px 20px;
  border-radius: 8px;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  margin-top: 20px;
  overflow: auto;
}
.ContainerReservation {
background: transparent;
}

</style>
