<template>
  <div class="register">
    <h2>Register</h2>
    <form @submit.prevent="register">
      <div>
        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          v-model="email"
          placeholder="Enter your email"
          required
        />
      </div>
      <div>
        <label for="password">Password</label>
        <input
          type="password"
          id="password"
          v-model="password"
          placeholder="Enter your password"
          required
        />
      </div>
      <button type="submit">Register</button>
      <p v-if="message" class="error">{{ message }}</p>
    </form>
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import axios from 'axios';

export default defineComponent({
  name:'SignIn',
  setup(){
    const email = ref('ahcenneait@gmail.com')
    const password = ref('123456')
    const message = ref('');

    const register = () => {
      axios.post('api/register', {
        'email' : email.value,
        'password' : password.value
      }).then((response) => {
        console.log(response)
        message.value = response.data.message
      }).catch((error)=>{
        message.value = response.data.message
      })
    }

    

    return{
      email,
      password,
      register,
      message
    }
  }
})
</script>

<style>

</style>