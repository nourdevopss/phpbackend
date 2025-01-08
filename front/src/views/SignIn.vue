<template>
  <div>
    <h1>Sign In</h1>

    <form @submit.prevent="handleLogin">
      <div class="form-group">
        <input 
          v-model="email" 
          type="email" 
          placeholder="Email" 
          required 
        />
      </div>
      <div class="form-group">
        <input 
          v-model="password" 
          type="password" 
          placeholder="Password" 
          required 
        />
      </div>
      <button type="submit">
        {{ loading ? 'Logging in...' : 'Login' }}
      </button>
      <div v-if="error" class="error">{{ error }}</div>
    </form>
  </div>
</template>

<script>
import { defineComponent, ref } from "vue";
import axios from 'axios';
import { useRouter } from "vue-router";

export default defineComponent({
  name:'SignIn',
  setup(){
    const email = ref('ahcenneait@gmail.com')
    const password = ref('12345678')
    const router = useRouter();

    axios.get('sanctum/csrf-cookie')

    const handleLogin = () => {
      axios.post('api/login', {
        'email' : email.value,
        'password' : password.value
      }).then((response) => {
        router.push('/home')
        console.log(response)
      }).catch((error)=>{
        console.log(error)
      })
    }

    

    return{
      email,
      password,
      handleLogin
    }
  }
})
</script>

<style>

</style>