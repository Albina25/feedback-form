<template>
  <div id="app">
    <button class="btn" type="button" @click="openModal">Заказать звонок</button>
    <modal name="emailForm" height="auto" adaptive>
    <form class="form" method="post" @submit.prevent="sendEmail">
      <header class="header-modal">
        <div class="title-form">заказать звонок</div>
        <i class="icon-close far fa-times-circle fa-lg" @click="closeModal"></i>
      </header>
      <main class="contacts-in-modal">
        <label class="form-row">
          <span class="title">имя</span>
          <input class="input-data" type="text" name="name" tabindex=1 :class="{'invalid-field': invalidForm.name && (dataForm.name || check)}" placeholder="Имя" v-model="dataForm.name">
        </label>
        <label class="form-row">
          <span class="title">телефон</span>
            <the-mask class="input-data" :mask="['7(###) ###-##-##']" tabindex=2 name="phone" :class="{'invalid-field': invalidForm.phone && (dataForm.phone || check) }" placeholder="7(___) ___-__-__" v-model="dataForm.phone"/>
        </label>
        <label class="form-row">
          <span class="title">время звонка</span>
            <select class="input-data" name="time" tabindex=3 v-model="dataForm.timeOfCalling">
            <option v-for="(time, index) of times" :key="index">{{time}}</option> 
            </select>
        </label>
      </main>
      <footer>
        <button class="btn-send" tabindex=4 @click="sendEmail">отправить</button>
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
      timeOfCalling: '',
    },
    times: ['09:00','10:00','11:00','12:00'],
    error: null,
    check: false,
  }),
  computed: {
    invalidForm () { 
      return { 
        name: this.dataForm.name ? !/^[A-Za-zА-Яа-яЁё]*$/i.test(this.dataForm.name) : true,
        phone: this.dataForm.phone ? this.dataForm.phone.length !== 10 : true
      } 
    }
  },
  methods: {
    openModal() {
      this.$modal.show('emailForm')
    },
    closeModal() {
      this.$modal.hide('emailForm');
      this.resetModal();
    },
    resetModal() {
      for (let key in this.dataForm) {
        this.dataForm[key] = ''
      } 
      this.error = '';
      this.check = false;
    },
    checkForm () {
      this.check = true;
      let count = 0;
      
      for (let key in this.invalidForm) {
        if (this.invalidForm[key])
          count++;
      }
      return count;
    },
    sendAlert(type) {
      if (type === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'Ваша заявка успешно отправлена, с Вами скоро свяжется наш оператор',
          showConfirmButton: true,
        })
      }
      if (type === 'fail') {
        Swal.fire({
          icon: 'error',
          title: `Ошибка, статус ошибки ${response.status}`,
          showConfirmButton: true,
        })
      }
    },
    async sendEmail() {
      
      if(this.checkForm()){
        this.error = "Пожалуйста, заполните поля корректно.";
      }
      else { 
        this.error = '';
        const response = await fetch('sendemail.php',{
          method: 'POST',
          body: JSON.stringify(this.dataForm),
          headers: {
                'Content-Type': 'application/json', 
            }
        });
        if(response.ok) { 
          Swal.fire({
          icon: 'success',
          title: 'Ваша заявка успешно отправлена, с Вами скоро свяжется наш оператор',
          showConfirmButton: true,
        })
        }
        else { 
         this.sendAlert(fail);
        
        }
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
 * {
  padding: 0;
  margin: 0;
  font-size: 18px;
  font-family: Roboto, sans-serif;
  box-sizing: border-box;
} 
.title-form {
  display: block;
  position: absolute;
  left: 35%;
  }
.icon-close {
  display: block;
  position: absolute;
  right: 2%;
  color: lightgrey;
}
.valid {
  border-color: black;
}
.invalid-field {
    border-color: red;
}
.header-modal {
  text-transform: uppercase;
  margin-bottom: 1rem;
  width: 100%;
  height: 1rem;
  flex-wrap: nowrap;
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
.btn-send {
  text-transform: uppercase;
  margin-bottom: 1rem;
  padding: 0.1rem;
}
.form {
  display: flex;
  align-items: center;
  flex-direction: column;
  padding: 1rem;
}
.contacts-in-modal {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-direction: column;
  width: 100%;
}
.title {
  display: flex;
  justify-content: space-between;
  flex: 2;
}
.input-data {
  flex: 3;
  height: 2rem;
  font-size: 1rem;
  outline: none;
}
.form-row {
  display: flex;
  flex-wrap: nowrap;
  margin-bottom: 1rem;
  align-items: center;
  justify-content: flex-end;
  width: 90%;
  text-transform: uppercase;
}
.error {
  display: flex;
  margin-bottom: 1rem;
  font-size: 15px;
  color: red;
}
.email-modal {
  height:auto;
}
@media only screen and (max-width: 768px) and (orientation: portrait) {
  .form-row {
  flex-direction: column;
  },
  .email-modal {
  height:auto;
  width: 100vw;
  }
}
</style>
