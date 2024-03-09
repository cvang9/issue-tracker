<template>
    
    <div v-if="isLoading" class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
         <div class=" ms-8 border-t-transparent border-solid animate-spin  rounded-full border-indigo-400 border-6 h-14 w-14"></div>
         <h1 class="text-indigo-400 mt-5 text-xl font-semibold" > loading chats .... </h1>
     </div>
  
    <div class="content" v-if="!isLoading">
      <div class="container">
        <div class="flex justify-center items-center">
       
          <!-- <div     class="mt-25 ms-20" style="width: 40vw;">
            <img    src="https://preview.colorlib.com/theme/bootstrap/signup-form-07/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid" />
          </div>    -->
           
          <div style="max-width: 60vw; min-width: 60vw;">
            <div style="margin-left: 250px; margin-top: 100px;">

                <div align="center" class="mb-7">
                   <span class="text-5xl text-indigo-500 me-2" > Chat</span> <span class="mb-7 text-5xl text-white bg-indigo-500 p-2 rounded-md" align="">Window</span>
                </div>  
                
                <div class="chat-log" id="chat-log" ref="hasScrolledToBottom">
                  <!-- Chat messages will appear here -->
                  <p v-for="(message, idx) in messages" :key="idx" class="mt-2 p-3 rounded-2xl " :class=" (message.role == 'resolver') ? ' bg-indigo-400 me-10 text-slate-50' : 'ms-10 text-indigo-500 bg-slate-100' " >{{ message.message }}</p>
                </div>

                <div class="input-container">
                    <input type="text" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-indigo-500 placeholder:text-gray-40" id="message-input" placeholder="Type your message..." v-model="newMessage" >
                    <button class=" mx-3 px-3 py-2 bg-indigo-400 text-slate-50 rounded-md" id="send-button" v-on:click="addMessage" >  Send</button>
                </div>
              </div>
          </div>
          
        </div>
      </div>
    </div>
    </template>
    <script>
        import { ref, onUpdated } from 'vue';
        // import axios from 'axios';
        import {  getCookie } from '../helper/CookieHelper.js';
        import { useRouter } from 'vue-router'
        import apiClient from '../services/api.js';
    
        export default{
            setup(){
    
                const route = useRouter();
                const role = ref(route.currentRoute._value.query.role);
                const id = ref(null);
                const friendId = ref(route.currentRoute._value.query.friendId);
                let messages = ref([])
                let newMessage = ref('')
                const isLoading = ref(true);
                const hasScrolledToBottom = ref(null);

                // Contains a user ID actually
                const user = ref(null)

                // Contains a hash value
                const hash = ref(null)



                
                if( role.value == 'user' )
                {
                    id.value = getCookie('userId');
                    apiClient.get('/api/users/'+ id.value)
                    .then(response => {
                        user.value = response.data.data.user_id;
                        hash.value = hashFunction(user.value, friendId.value);
                        console.log(user.value);
                        fetchMessages();
                    })
                    .catch(error => {
                        console.log(error);
                    });
                }
                else if( role.value == 'resolver' )
                {
                    id.value = getCookie('resolverId');
                    apiClient.get('/api/resolvers/'+ id.value)
                    .then(response => {
                        user.value = response.data.data.attributes.user_id;
                        hash.value = hashFunction(user.value, friendId.value);
                        console.log(user.value);
                        console.log(hash.value);
                        fetchMessages();
                    })
                    .catch(error => { 
                        console.log(error);
                    });
                }


                onUpdated(() => {
                    scrollBottom()
                })
                
                // Generating hash
               function hashFunction(a, b) {

                   let hash = a ^ b;
                   hash ^= (hash << 13) | (hash >>> 19);
                   hash ^= (hash << 5) | (hash >>> 27);
                   hash ^= (hash << 17);

                   return hash >>> 0; 
               }

               


                function fetchMessages() {
                    apiClient.get('/api/messages/' + hash.value)
                    .then(response => {
                        // console.log(response.data);
                        messages.value = response.data.data;
                        isLoading.value = false;
                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                }


                function scrollBottom() {

                    if(messages.value.length > 1){
                        let el = hasScrolledToBottom.value;
                          el.scrollTop = el.scrollHeight;
                    }        	
                }


                
                Echo.private('query-channel')
                  .listen('SendMessage', (e) => {

                    // console.log(e);

                        if( e.user.id != user.value && e.message.friend_id == user.value && e.user.id == friendId.value )
                        {
                            messages.value.push({
                            message: e.message.message,
                            user_id: e.user.id,
                            friend_id: e.message.friend_id,
                            role: e.user.role

                        })

                        }
                    });

    
    
    

                const addMessage = async()=> {

                    let user_message = {
                        user_id: user.value,
                        friend_id: friendId.value,
                        message: newMessage.value,
                        role: role.value,
                        hash: hash.value
                    };
                    messages.value.push(user_message);
                    apiClient.post('/api/messages', user_message).then(response => {
                      console.log(response.data);
                    });
                    newMessage.value = ''
                }
    
    
                return {
                    messages,
                    newMessage,
                    addMessage,
                    isLoading,
                    hasScrolledToBottom
                }
            }
        }
    </script>
    <style scoped >


          .chat-message {
            color: red;
          }
        
          
      
          .chat-container {
            width: 80%;
            width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
          }
      
          .chat-log {
            height: 500px;
            overflow-y: auto;
            padding: 10px;
            border-radius: 10px;
            background-color: #f4f4f4;
            color: #97979c;
          }
      
    
          .input-container {
            display: flex;
            margin-top: 20px;
          }
      
          /* .message-input {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
          } */
      
          .send-button {
            background-color: #97979c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.2s;
          }
      
          .send-button:hover {
            background-color: #333;
          }
       
        .message-input {
          flex-grow: 1;
          padding: 12px;
          border: none;
          border-radius: 5px;
          font-size: 14px;
        }
    
        .send-button {
          background-color: #1f4b9c;
          color: #fff;
          border: none;
          border-radius: 5px;
          padding: 8px 15px;
          margin-left: 10px;
          cursor: pointer;
          transition: background-color 0.2s;
        }
    
        .send-button:hover {
          background-color: #333;
        }
    
        /* Enhance the appearance of the chat log */
        .chat-log {
          border: 1px solid #ddd;
          padding: 10px;
          border-radius: 10px;
          background-color: #fff;
          color: #000;
          overflow-y: auto;
          max-height: 400px;
        }
      </style>