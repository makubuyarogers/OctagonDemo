<template>
  <div class="hello">
    <h1>{{ msg }}</h1>
    <h2>Octagon Demo</h2>
    <ul>
      <li>
        <a href="register"> Sign Up </a>
      </li>
      <li>
        <a href="login">  Login </a>
      </li>
    </ul>
    
  </div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data () {
    return {
      msg: 'Makubuya Rogers'
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
  text-decoration: none;
  font-weight: bolder;
}
</style>
