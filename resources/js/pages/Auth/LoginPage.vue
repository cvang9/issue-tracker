<template>

<div class="login-box">
    <div class="login-box-formbox">
      <div class="login-box-signup" v-if="role == 'user'"  >
        Don't have an account? <router-link to="/user-signup">Sign Up</router-link>
      </div>
      <div class="login-box-login">
        <h1>{{ role.charAt(0).toUpperCase() + role.slice(1) }}</h1>


        <form>
            <p align="center" v-if="invalidCreds" style="color:red;" > Invalid Credentials Entered </p>
          <div>
            <label for="email"> Email</label>
            <input type="email" class="input-field" placeholder="Email" name="email" v-model="email" required/>
          </div>

          <div>
            <label for="password"> Password</label>
            <input type="password" class="input-field" placeholder="Password" name="password" v-model="password" required/>
          </div>
 
          <button class="login-button btn" v-on:click.prevent="submitButtonHandler">
            Login 
          </button>
      </form>    

      
        <div class="alternate-text">Or</div>
        <div class="alternate-boxes">
            <div class="alternate-box">
            <router-link to="/"> <h3>Go back</h3> </router-link>
          </div>

        </div>
      </div>
    </div>
  </div>
    
</template>

<script>

import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../../store/auth.js';
import axios from 'axios';

export default {
    setup() {
        
        const route = useRouter();
        const { toggleState } = useAuthStore();
        const role = ref(route.currentRoute._value.query.role);
        const email = ref('');
        const password = ref('');
        const invalidCreds = ref(false);

        const submitButtonHandler = async () => {

            const payload = {
                email,
                password
            }
    

            try {
                const response = await axios.post('/login', payload );

                if(response.status == 200) 
                {
                    toggleState();
                    localStorage.setItem('token',response.data.token )

                    if( role.value == 'user' ) {
                        route.push('/tickets');
                    }
                    
                    else if( role.value == 'resolver' ) {
                        route.push('/resolver');
                    }
                    
                    else if( role.value == 'admin' ) {
                        route.push('/admin');
                    }
                }

                else {
                    invalidCreds.value = true;
                }

            } catch (error) {
                console.log(error.response);
            }

        }

        return {
            role,
            email,
            password,
            submitButtonHandler,
            invalidCreds
        }
    },
}
</script>


<style scoped>

a {
    text-decoration: none;
    color: #0f1396;
}

button {
    background-color: #181b82;
    padding: 4px 12px;
    margin-left: 5px;
    color:white
}
</style>