<template>

<div class="login-box">
    <div class="login-box-formbox">
      <div class="login-box-signup">
        Do have an account? <router-link to="/login?role=user">Login</router-link>
      </div>
      <div class="login-box-login">


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

          <div
              id="FileUpload"
              class="relative mb-5.5 block w-full cursor-pointer appearance-none rounded border-2 border-dashed border-primary bg-gray py-4 px-4 dark:bg-meta-4 sm:py-7.5"
            >
              <input
                type="file"
                accept="image/*"
                class="absolute inset-0 z-50 m-0 h-full w-full cursor-pointer p-0 opacity-0 outline-none"
                name="image"
                id="fileInput"
                v-on:change="handleFileChange"
              />
              <div class="flex flex-col items-center justify-center space-y-3">
                <span
                  class="flex h-10 w-10 items-center justify-center rounded-full border border-stroke bg-white dark:border-strokedark dark:bg-boxdark"
                >
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M1.99967 9.33337C2.36786 9.33337 2.66634 9.63185 2.66634 10V12.6667C2.66634 12.8435 2.73658 13.0131 2.8616 13.1381C2.98663 13.2631 3.1562 13.3334 3.33301 13.3334H12.6663C12.8431 13.3334 13.0127 13.2631 13.1377 13.1381C13.2628 13.0131 13.333 12.8435 13.333 12.6667V10C13.333 9.63185 13.6315 9.33337 13.9997 9.33337C14.3679 9.33337 14.6663 9.63185 14.6663 10V12.6667C14.6663 13.1971 14.4556 13.7058 14.0806 14.0809C13.7055 14.456 13.1968 14.6667 12.6663 14.6667H3.33301C2.80257 14.6667 2.29387 14.456 1.91879 14.0809C1.54372 13.7058 1.33301 13.1971 1.33301 12.6667V10C1.33301 9.63185 1.63148 9.33337 1.99967 9.33337Z"
                      fill="#3C50E0"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.5286 1.52864C7.78894 1.26829 8.21106 1.26829 8.4714 1.52864L11.8047 4.86197C12.0651 5.12232 12.0651 5.54443 11.8047 5.80478C11.5444 6.06513 11.1223 6.06513 10.8619 5.80478L8 2.94285L5.13807 5.80478C4.87772 6.06513 4.45561 6.06513 4.19526 5.80478C3.93491 5.54443 3.93491 5.12232 4.19526 4.86197L7.5286 1.52864Z"
                      fill="#3C50E0"
                    />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.99967 1.33337C8.36786 1.33337 8.66634 1.63185 8.66634 2.00004V10C8.66634 10.3682 8.36786 10.6667 7.99967 10.6667C7.63148 10.6667 7.33301 10.3682 7.33301 10V2.00004C7.33301 1.63185 7.63148 1.33337 7.99967 1.33337Z"
                      fill="#3C50E0"
                    />
                  </svg>
                </span>
                <p class="text-sm font-medium">
                  <span class="text-primary">Click to upload</span> or drag and drop
                </p>
                <p class="mt-1.5 text-sm font-medium">SVG, PNG, JPG or GIF</p>
                <p class="text-sm font-medium">(max, 800 X 800px)</p>
              </div>
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
        const selectedFile = ref(null);


        const handleFileChange = () => {
            const fileInput = document.getElementById('fileInput');
            selectedFile.value = fileInput.files[0];
       };
        

        const handleSubmitButton = async() => {


            const formDataObject = new FormData();
            formDataObject.append('name', name.value);
            formDataObject.append('email',  email.value);
            formDataObject.append('password', password.value);
            formDataObject.append('file', selectedFile.value);


            try {

                const response = await axios.post('/register', formDataObject );

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
            handleSubmitButton,
            handleFileChange
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