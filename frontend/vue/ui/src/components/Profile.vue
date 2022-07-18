<template>
  <div id="container">
    <div class="header">
      <h2 v-if="!user">Welcome</h2>
      <h2 v-if="user">Welcome {{user.first_name}}</h2>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'Profile',
  data () {
    return {
      user:null
    }
  },
  async getUser() {
    const response= await axios.get('http://127.0.0.1:8000/api/auth/profile/4',{
        headers: {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        }
    });
    this.user = response.data;
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