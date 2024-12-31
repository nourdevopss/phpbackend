<template>
  <div>
    <h1>Home</h1>
    <div v-if="user != null">
      {{user}}
    </div>
  </div>
</template>

<script>
import { defineComponent, onMounted, ref } from "vue";
import axios from 'axios';
import { useRouter } from "vue-router";

export default defineComponent({
  name:'SignIn',
  setup(){
    const user = ref(null);
    const router = useRouter();

    onMounted(()=>{
      getUser()
    })

    const getUser = () => {
      axios.get('api/user')
      .then((response)=>{
        user.value = response.data;
      })
      .catch((error)=>{
        console.log(error)
        if(error.response.status == 401){
          router.push('/')
        }
      })
    }

    return{
      user
    }
  }
})
</script>

<style>

</style>