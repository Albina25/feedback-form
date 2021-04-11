<template>
  <div id="app">
    <button class="buttonForCalling" type="button" @click="openModal()">Заказать звонок</button>
<modal name="emailForm">
  <form class="formOfModal" @submit.prevent="sendEmail">
      <header class="headerModal">заказать звонок </header>
      <main class="contactsInInModal">
      <label class="contacts">имя
        <input type="text" name="name" :class="{'invalid-field': invalidForm.name}"  placeholder="Имя" v-model="dataForm.name">
      </label>
      <label class="contacts">телефон
        <the-mask :mask="['7(###) ###-##-##']" name="phone" :class="{'invalid-field': invalidForm.phone}" placeholder="7(###) ###-##-##" v-model="dataForm.phone"/>
      </label>
      <label class="contacts">время звонка
      <select name="time" v-model="dataForm.timeOfCalling">
<option> 9:00 </option>
<option> 10:00 </option>
<option> 11:00 </option>
<option> 12:00 </option>
<option> 13:00 </option>
</select>
      </label>
      </main>
      <footer>
      <button class="sendEmailButton" @click="sendEmail">отправить</button>
      <div v-if="this.error">{{ error }}</div>
           
      </footer>
      </form>
</modal>
<!-- <dialog class="callingModal" ref="callingModal">
      
    </dialog>
<div id="resultForm"></div>  -->
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
   invalidForm: {
     name: false,
     phone: false
   },
   error: null
  }),
  // computed: {
  //   invalidForm () { 
  //     return { 
  //       name: this.dataForm.name = ([A-Za-zА-Яа-яЁё]) ? true: false,
  //       phone: this.dataForm.phone.length === 10 ? true: false
  //     } 
  //   }
  // },
  methods: {
    
    openModal() {
      this.$modal.show('emailForm')
    },
    sendEmail() {
      
      this.invalidForm.phone = this.dataForm.phone.length === 10 ? false : true
      this.invalidForm.name = (!/[A-Za-zА-Яа-яЁё]/.test(this.dataForm.name) || !this.dataForm.name)  ? true : false
    
      
      if( !this.invalidForm.name && !this.invalidForm.phone ){
        
          const response = fetch('sendemail.php',{method: 'POST', body: this.dataForm});
         
            if(!response.ok) { throw new Error(`Ошибка, статус ошибки ${response.status}`);}
             else { 
              return  Swal.fire({
               position: 'top-end',
               icon: 'success',
               title: 'Ваша заявка успешно отправлена, с Вами скоро свяжется наш оператор',
               showConfirmButton: true,
              })
              dataForm.reset()
             }
      } else { 
         this.error = "Пожалуйста, заполните корректно поля!"
         this.dataForm.reset()
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
}
.invalid-field {
    border-color: red;
}
</style>
