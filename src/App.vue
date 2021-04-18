<template>
  <div id="app">
    <button class="btn" type="button" @click="openModal()">Заказать звонок</button>
<modal name="emailForm">
  <form class="form" @submit.prevent="sendEmail">
      <header class="headerOfModal">заказать звонок </header>
      <main class="contactsInInModal">
      <div class="form-row">
       <label class="title">имя</label>
          <input class="inputData" type="text" name="name" tabindex=1 :class="{'invalid-field': invalidForm.name}" placeholder="Имя" v-model="dataForm.name">
      </div>
      <div class="form-row">
        <label class="title">телефон</label>
          <the-mask class="inputData" :mask="['7(###) ###-##-##']" tabindex=2 name="phone" :class="{'invalid-field': invalidForm.phone}" placeholder="7(___) ___-__-__" v-model="dataForm.phone"/>
      </div>
      <div class="form-row">
        <label class="title">время звонка</label>
          <select class="inputData" name="time" tabindex=3 v-model="dataForm.timeOfCalling">
            <option v-for="time of times" :key="time">{{time}}</option> 
          </select>
      </div>
      </main>
      <footer>
      <button class="btn1" tabindex=4 @click="sendEmail">отправить</button>
      <div class="error" v-if="error">{{ error }}</div>
           
      </footer>
      </form>
</modal>

  </div>
</template>

<script>
export default {
  name: 'App',
  components: {
  },
  data: () => ({
    dataForm: {
      name: null,
      phone: '',
      timeOfCalling: null,
    },
    times: ['09:00','10:00','11:00','12:00'],
    error: null
  }),
  computed: {
    invalidForm () { 
      return { 
        name:  !/^[A-Za-zА-Яа-яЁё]*$/i.test(this.dataForm.name),
        phone: this.dataForm.phone && this.dataForm.phone.length !== 10 ? true : false
      } 
    }
  },
  methods: {
    openModal() {
      this.$modal.show('emailForm')
      
    },
    sendEmail() {
      this.invalidForm.phone = this.dataForm.phone.length !== 10 ? true : false 
      this.invalidForm.name = !/[A-Za-zА-Яа-яЁё]/.test(this.dataForm.name) ? true : false
      
      if(!this.invalidForm.name && !this.invalidForm.phone ){
        
          const response = fetch('\sendemail.php',{method: 'POST', body: this.dataForm});
         
            if(!response.ok) { throw new Error(`Ошибка, статус ошибки ${response.status}`);}
             else { 
              return  Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Ваша заявка успешно отправлена, с Вами скоро свяжется наш оператор',
               showConfirmButton: true,
              })
              
             }
      } else { 
         this.error="Пожалуйста, заполните корректно поля!"
        }
        
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  font-size: 20px;
}
.valid {
  border-color: black;
}
.invalid-field {
    border-color: red;
}
.headerOfModal {
  text-transform: uppercase;
  margin-bottom: 1rem;
}
.btn {
  text-transform: uppercase;
  margin-bottom: 1rem;
  background-color: white;
  border: 2px solid #4CAF50;
  padding: 0.5rem;
}
.btn:hover {
    background-color: #FFFAFA;
    }
.btn1 {
  text-transform: uppercase;
  margin-bottom: 1rem;
}
.form {
  display: flex;
  align-items: center;
  text-transform: uppercase;
  flex-direction: column;
  padding: 1rem;
}

.contactsInInModal {
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-transform: uppercase;
  margin-bottom: 1rem;
  flex-direction: column;
  width: 100%;
}
.title {
  display: flex;
  justify-content: space-between;
  margin-right: 1rem;
  flex: 1;
}
.inputData {
  flex: 2;
  height: 2rem;
}
.form-row {
  display: flex;
  flex-wrap: nowrap;
  margin-bottom: 1rem;
  align-items: center;
  justify-content: flex-end;
  width: 90%;
}
.error {
    font-size: 15px;
    color: red;
}

</style>
