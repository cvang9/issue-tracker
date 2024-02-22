<template>

<div class="login-box">
    <div class="login-box-formbox">
      <div class="login-box-signup" v-if="role == 'user'"  >
        Don't have an account? <a href="/userlogin/signup">Sign Up</a>
      </div>
      <div class="login-box-login">
        <h1>{{ role.charAt(0).toUpperCase() + role.slice(1) }}</h1>


        <form action="/userlogin" method="post">
          <div>
            <label for="email"> Username</label>
            <input type="text" class="input-field" placeholder="Username" name="username" />
          </div>

          <div>
            <label for="password"> Password</label>
            <input type="password" class="input-field" placeholder="Password" name="password" />
          </div>
 
          <button class="login-button btn" style="background-color: #181b82; padding: 4px 12px; margin-left: 5px;">
          <a style=" color: white;">Login</a>

      </button>
      </form>    

      
        <div class="alternate-text">Or</div>
        <div class="alternate-boxes">
            <div class="alternate-box">
            <router-link to="/"> <h3>Go back</h3> </router-link>
          </div>

          <!-- <div class="alternate-box" v-if="role != 'resolver' ">
            <router-link to="/login?role=resolver"> <h3>Resolver</h3> </router-link>
          </div>

          <div class="alternate-box" v-if="role != 'admin' ">
            <router-link to="/login?role=admin"> <h3>Admin</h3> </router-link>
          </div> -->
        </div>
      </div>
    </div>
  </div>
    
</template>

<script>

import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        
        const route = useRouter();
        const role = ref(route.currentRoute._value.query.role);

        return {
            role: role.value
        }
    },
}
</script>


<style scoped>

a {
    text-decoration: none;
    color: #0f1396;
}
</style>