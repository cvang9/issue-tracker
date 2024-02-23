<template>

<div class="login-box">
    <div class="login-box-formbox">
      <div class="login-box-signup">
        Do have an account? <router-link to="/login?role=user">Login</router-link>
      </div>
      <div class="login-box-login">
        <h1>User</h1>


        <form>

          <div>
            <label for="name"> Username</label>
            <input type="text" class="input-field" placeholder="John Doe" name="name" v-model="name" />
          </div>

          <div>
            <label for="email"> Email</label>
            <input type="email" class="input-field" placeholder="johndoe@example.com" name="email" v-model="email"/>
          </div>

          <div>
            <label for="password"> Password</label>
            <input type="password" class="input-field" placeholder="******" name="password" v-model="password" />
          </div>
            <button class="login-button btn" v-on:click.prevent="handleSubmitButton">Sign Up </button>
        </form>
      </div>
    </div>
  </div>
    
</template>

<script>

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../store/auth.js';

export default {
    setup() {

        const route = useRouter();
        const { toggleState } = useAuthStore();
        const name = ref('');
        const email = ref('');
        const password = ref('');
        

        const handleSubmitButton = async() => {

            const payload = {
                name,
                email,
                password
            }

            try {

                const response = await axios.post('/register', payload );

                if( response.status == 200 )
                {
                    toggleState();
                    localStorage.setItem('token', response.data.token);
                    route.push('/tickets');
                }

            } catch (error) {
                console.log(error);
            }
        }
        
        return {
            name,
            email,
            password,
            handleSubmitButton
        }
    },
}
</script>


<style scoped>



button {
    background-color: #181b82;
    padding: 4px 12px;
    margin-left: 5px;
    color:white
}
</style>