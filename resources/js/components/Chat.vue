<template>
    
  
    <div class="content">
      <div class="container">
        <div class="flex justify-center items-center">
       
          <div class="mt-25 ms-20" style="max-width: 30vw;">
            <img src="https://preview.colorlib.com/theme/bootstrap/signup-form-07/images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid" />
           </div>
    
          <div style="max-width: 70vw;">
              <div style="margin-left: 250px; margin-top: 100px; " >
                <div class="chat-log" id="chat-log">
                  <!-- Chat messages will appear here -->
                  <p v-for="(message, idx) in messages" :key="idx" class="mt-2 p-3 rounded-2xl " :class=" (message.role == 'resolver') ? ' bg-indigo-400 me-10 text-slate-50' : 'ms-10 text-indigo-500 bg-slate-100' " >{{ message.message }}</p>
                </div>
                <div class="input-container">
                    <input type="text" class="message-input" id="message-input" placeholder="Type your message..." v-model="newMessage" >
                    <button class=" mx-3 px-3 py-2 bg-indigo-400 text-slate-50 rounded-md" id="send-button" v-on:click="addMessage" >  Send</button>
                </div>
              </div>
          </div>
          
        </div>
      </div>
    </div>
        <!-- <div class="chat card">
            <div class="scrollable card-body" ref="hasScrolledToBottom">
                <template v-for="message in messages" >
                    <div class="message message-receive" v-if="user.id != message.user.id">
                        <p>
                            <strong class="primary-font">
                                {{ message.user.name }} :
                            </strong>
                            {{ message.message }}
                        </p>
                    </div>
                    <div class="message message-send" v-else>
                        <p>
                            <strong class="primary-font">
                                {{ message.user.name }} :
                            </strong>
                            {{ message.message }}
                        </p>
                    </div>
                </template>
            </div>
    
            <div class="chat-form input-group">
                <input id="btn-input" type="text" name="message" class="form-control input-sm message-" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="addMessage">
    
                <span class="input-group-btn">
                    <button class="btn btn-primary" id="btn-chat" @click="addMessage">
                        Send
                    </button>
                </span>
            </div>
    
        </div> -->
    </template>
    <script>
        import { ref, onMounted,onUpdated } from 'vue';
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

                // Contains a user ID actually
                const user = ref(null)
                
                if( role.value == 'user' )
                {
                    id.value = getCookie('userId');
                    apiClient.get('/api/users/'+ id.value)
                    .then(response => {
                        user.value = response.data.data.user_id;
                        // console.log(user.value);
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
                        // console.log(user.value);
                    })
                    .catch(error => { 
                        console.log(error);
                    });
                }

                apiClient.get('/api/messages').then(response => {
                        console.log(response.data.data);
                        messages.value = response.data.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    })


                
                // let hasScrolledToBottom = ref('')
    
    
    
                // onMounted(() =>{
                //     fetchMessages()
                // })
    
                // onUpdated(() => {
                //     scrollBottom()
                // })
                
                Echo.private('query-channel')
                  .listen('SendMessage', (e) => {

                    // console.log(e);

                        if( e.user.id != user.value && e.message.friend_id == user.value )
                        {
                           messages.value.push({
                            message: e.message.message,
                            user_id: e.user.id,
                            friend_id: e.message.friend_id,
                            role: e.user.role
                        })

                        }
                    });

    
    
    
                // const fetchMessages = async()=> {
                //     apiClient.get('/api/messages').then(response => {
                //         console.log(response.data.data);
                //         messages.value = response.data;
                //     });
                // }
    
                const addMessage = async()=> {
                    let user_message = {
                        user_id: user.value,
                        friend_id: friendId.value,
                        message: newMessage.value,
                        role: role.value
                    };
                    messages.value.push(user_message);
                    apiClient.post('/api/messages', user_message).then(response => {
                      console.log(response.data);
                    });
                    newMessage.value = ''
                }
    
                // const scrollBottom = () =>{
                //     if(messages.value.length > 1){
                //         let el = hasScrolledToBottom.value;
                //           el.scrollTop = el.scrollHeight;
                //     }        	
                // }
    
                return {
                    messages,
                    newMessage,
                    addMessage
                    // fetchMessages,
                    // hasScrolledToBottom,
                    // clickSendButton: clickSendButton
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
      
          .message-input {
            flex-grow: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
          }
      
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