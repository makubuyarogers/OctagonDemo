<template>
  <div id="container">
    <div class="header">
      <h2>Register Here</h2>
    </div>
    
    <div class="login-form">
      <form @submit.prevent="SubmitForm">
        <div class="form-content">
          <input type="text" placeholder="First name" id="first_name" v-model="first_name"/>
        </div>
        <div class="form-content">
          <input type="text" placeholder="Last name" id="last_name" v-model="last_name"/>
        </div>
        <div class="form-content">
          <input type="text" placeholder="Phone number" id="phone_number" v-model="phone_number"/>
        </div>
        <div class="form-content">
          <input type="password" placeholder="Password" id="password" v-model="password"/>
        </div>
        <div class="form-content">
          <input type="password" placeholder="Confirm Password" id="confirm_password" v-model="confirm_password"/>
        </div>
        <div class="form-content">
          <button>Register</button>
        </div>
        <div class="form-content">
          <a href="login">I already have an account</a> | <a href="/">Cancel</a>
        </div>
      </form> 
    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Register',
  data () {
    return {
      first_name:'',
      last_name:'',
      phone_number:'',
      password:'',
      confirm_password:''
    }
  },
  methods:{
    async SubmitForm(){
      const data = {
        first_name:this.first_name,
        last_name:this.last_name,
        phone_number:this.phone_number,
        password:this.password

      }
    const response= await axios.post('http://127.0.0.1:8000/api/auth/register',data)
    this.$router.push('/login')      

    }
  }
}
</script>
<style>
#container {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 10px;
  margin-bottom: 60px;
}
.header{
  width:100%;
  height:50px;
}
.login-form{
  width:40%;
  margin:auto;
  padding:30px;
  background-color:#f0f0f5;
  border-radius:10px;
}
.form-content{
  margin-top:20px;
}
input{
  width:80%;
  height:40px;
  border: none;
  margin:auto;
  color:#0a0a0f;
  border-radius:5px;
  padding-left:10px;
}
button{
  width:50%;
  height:40px;
  background-color:#52527a;
  border: none;
  color:#fff;
  font-size:1em;
  font-weight:bolder;
  border-radius:5px;
}
a{
  text-decoration:none;
  font-size:1em;
  font-weight:bolder;
}
</style>