<template>

<div class="login-box">

    
    <div class="login-box-formbox">

        <div v-if="invalidCreds"
            class=" my-6 flex w-full border-l-6 border-[#F87171] bg-[#F87171] bg-opacity-[15%] px-7 py-8 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30 md:p-9"
        >
            <div
            class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-[#F87171]"
            >
            <svg
                width="13"
                height="13"
                viewBox="0 0 13 13"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                d="M6.4917 7.65579L11.106 12.2645C11.2545 12.4128 11.4715 12.5 11.6738 12.5C11.8762 12.5 12.0931 12.4128 12.2416 12.2645C12.5621 11.9445 12.5623 11.4317 12.2423 11.1114C12.2422 11.1113 12.2422 11.1113 12.2422 11.1113C12.242 11.1111 12.2418 11.1109 12.2416 11.1107L7.64539 6.50351L12.2589 1.91221L12.2595 1.91158C12.5802 1.59132 12.5802 1.07805 12.2595 0.757793C11.9393 0.437994 11.4268 0.437869 11.1064 0.757418C11.1063 0.757543 11.1062 0.757668 11.106 0.757793L6.49234 5.34931L1.89459 0.740581L1.89396 0.739942C1.57364 0.420019 1.0608 0.420019 0.740487 0.739944C0.42005 1.05999 0.419837 1.57279 0.73985 1.89309L6.4917 7.65579ZM6.4917 7.65579L1.89459 12.2639L1.89395 12.2645C1.74546 12.4128 1.52854 12.5 1.32616 12.5C1.12377 12.5 0.906853 12.4128 0.758361 12.2645L1.1117 11.9108L0.758358 12.2645C0.437984 11.9445 0.437708 11.4319 0.757539 11.1116C0.757812 11.1113 0.758086 11.111 0.75836 11.1107L5.33864 6.50287L0.740487 1.89373L6.4917 7.65579Z"
                fill="#ffffff"
                stroke="#ffffff"
                ></path>
            </svg>
            </div>
            <div class="w-full">
            <h5 class="mb-3 font-bold text-[#B45454]">Wrong Credentials</h5>
            <ul>
                <li class="leading-relaxed text-[#CD5D5D]">
                Please check your credentials again
                </li>
            </ul>
            </div>
        </div>

      <div class="login-box-signup" v-if="role == 'user'"  >
        Don't have an account? <router-link to="/user-signup">Sign Up</router-link>
      </div>
      <div class="login-box-login">
        <p class="text-xl mx-3">Login {{ role.charAt(0).toUpperCase() + role.slice(1) }}</p>
        <!-- <p v-if="invalidCreds" class="text-md mx-3" style="color: red" >Invalid Credentials</p> -->


        <form>
            <!-- <p align="center" v-if="invalidCreds" style="color:red;" > Invalid Credentials Entered </p> -->
          <div>
            <label for="email"> Email</label>
            <input type="email" class="input-field" placeholder="Email" name="email" v-model="email" required/>
          </div>

          <div>
            <label for="password"> Password</label>
            <input type="password" class="input-field" placeholder="Password" name="password" v-model="password" required/>
          </div>
 
          <button v-if="!button" class="flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90" v-on:click.prevent="submitButtonHandler">
            Login 
          </button>
          <button v-if="button" disabled type="button" class=" flex justify-center rounded bg-primary py-2 px-6 font-medium text-gray hover:bg-opacity-90 inline-flex items-center">
                  <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                    </svg>
                    Loading
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
        const button = ref(false);

        const submitButtonHandler = async () => {

            button.value = true;

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
                        route.push('/resolver/' + response.data.id );
                    }
                    
                    else if( role.value == 'admin' ) {
                        route.push('/admin');
                    }
                }

                else {
                    invalidCreds.value = true;
                    button.value = false;
                }

            } catch (error) {
                console.log(error.response);
                invalidCreds.value = true
                button.value = false;
            }

        }

        return {
            role,
            email,
            password,
            submitButtonHandler,
            invalidCreds,
            button
        }
    },
}
</script>



<style scoped > 

button {
    background-color: #181b82;
    padding: 4px 12px;
    margin-left: 5px;
    color:white
}

a {
    text-decoration: none;
    color: #0f1396;
}

.flex-container {
    display: flex;
    align-content: center;
    justify-content: center;
}

.router-view {
    width: 50vw;
}

.intro-box {
    width: 50vw;
}




.login-box {
  display: flex;
  /* width: 90em; */
  height: 100vh;
  min-height: 40em;
  /* border-radius: 20px; */
  background-color: #ffffff;
  overflow: hidden;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.025);
}

.login-box-formbox,
.login-box-quotebox {
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex: 1 1 100%;
  padding: 4em 6em;
}

.login-box-quotebox {
  color: white;
  background-color: #2028eb;
  background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="%235257f0" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M6 17.6l-2 -1.1v-2.5"></path><path d="M4 10v-2.5l2 -1.1"></path><path d="M10 4.1l2 -1.1l2 1.1"></path><path d="M18 6.4l2 1.1v2.5"></path><path d="M20 14v2.5l-2 1.12"></path><path d="M14 19.9l-2 1.1l-2 -1.1"></path><line x1="12" y1="12" x2="14" y2="10.9"></line><line x1="18" y1="8.6" x2="20" y2="7.5"></line><line x1="12" y1="12" x2="12" y2="14.5"></line><line x1="12" y1="18.5" x2="12" y2="21"></line><path d="M12 12l-2 -1.12"></path><line x1="6" y1="8.6" x2="4" y2="7.5"></line></svg>'), linear-gradient(to right top, #0f1396, #202199, #2d2d9c, #38389f, #4243a1, #4243a1, #4142a0, #4142a0, #36379d, #2b2b99, #1d1e95, #0a0f90);
  background-size: 125%;
  background-repeat: no-repeat;
  background-position: center left;
}

.login-box-signup a {
  color: #a0a4e3;
  font-weight: 600;
  text-decoration: inherit;
}
.login-box-signup a:hover, .login-box-signup a:focus {
  color: #0f1396;
}

.login-box-login {
  display: flex;
  flex-wrap: wrap;
  align-content: center;
  flex-grow: 1;
}
.login-box-login > * {
  width: 100%;
  flex-shrink: 0;
}

form > div {
  position: relative;
  padding: 1.5em 0;
}
form > div input {
  color: #bebebe;
  width: 100%;
  padding: 1.5em 2em;
  border: 1px solid #bebebe;
  border-radius: 5px;
}
form > div input.input-email, form > div input.input-password {
  background-repeat: no-repeat;
  background-position: right 1em top 1.25em;
}
form > div input.input-email {
  background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="lightgrey" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="4"></circle><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path></svg>');
}
form > div input.input-password {
  background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="lightgrey" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="5" y="11" width="14" height="10" rx="2"></rect><circle cx="12" cy="16" r="1"></circle><path d="M8 11v-4a4 4 0 0 1 8 0v4"></path></svg>');
}
form > div input:focus {
  outline-color: #2028eb;
  border-color: #2028eb;
}
form > div label {
  font-size: 0.85em;
  position: absolute;
  top: 1.25em;
  left: 1.5em;
  background: #ffffff;
  padding: 0 0.5em;
}
form > div:focus-within label {
  color: #2028eb;
  font-weight: 600;
}
form > div .btn {
  color: #ffffff;
  font-size: 1em;
  letter-spacing: 1px;
  line-height: 1;
  background-color: #2028eb;
  border-color: #2028eb;
  cursor: pointer;
  transition: all 500ms ease;
}
form > div .btn:hover, form > div .btn:focus {
  background-color: #0f1396;
  border-color: #0f1396;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.alternate-text {
  display: flex;
  align-items: center;
  margin: 1.5em 0;
  text-align: center;
}
.alternate-text::before, .alternate-text::after {
  content: "";
  flex: 1;
  border-bottom: 1px solid #bebebe;
}
.alternate-text::before {
  margin-right: 1em;
}
.alternate-text::after {
  margin-left: 1em;
}

.alternate-boxes {
  display: flex;
  justify-content: space-between;
  gap: 1em;
  margin-top: 1.5em;
}

.alternate-box {
  color: #0f1396;
  text-align: center;
  width: 100%;
  padding: 10px 20px;
  border: 1.5px solid #3a0f96;
  border-radius: 5px;
  cursor: pointer;
  transition: all 500ms ease;
}
.alternate-box svg {
  transition: transform 500ms ease;
}
.alternate-box:hover {
  border-color: #bebebe;
  background-color: rgba(190, 190, 190, 0.25);
}
.alternate-box:hover svg {
  transform: scale(1.25);
}
.quote-container {
  padding: 1em 0;
  position: relative;
}
.quote-container::before {
  content: "";
  position: absolute;
  top: -4.5em;
  left: -0.65em;
  width: 3.5em;
  height: 3.5em;
  background-color: #93f8e0;
  border-radius: 100%;
}
.quote-container::after {
  content: "";
  position: absolute;
  top: 0;
  left: 15px;
  height: 100%;
  width: 2px;
  background-color: rgba(255, 255, 255, 0.25);
}

.quote {
  color: #ffffff;
  font-size: 7em;
  font-weight: 600;
  line-height: 1;
}

.quote-small {
  color: #ebeef7;
  line-height: 180%;
  padding: 2em 0 0 6em;
  position: relative;
}
.quote-small::before {
  content: "";
  position: absolute;
  top: 2.75em;
  left: 1.2em;
  width: 3em;
  height: 2px;
  background-color: rgba(255, 255, 255, 0.25);
}

</style>