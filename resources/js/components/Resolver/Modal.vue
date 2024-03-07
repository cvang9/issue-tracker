<template>
  <div
    class="fixed inset-0 p-4 flex flex-wrap justify-end items-end w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]"
  >
    <div class="w-full max-w-lg bg-white shadow-lg rounded-md p-6 relative">
      <div class="flex items-center pb-3 border-b">
        <h3 class="text-xl font-semibold flex-1">Chat Box</h3>
        <svg
          @click="toogle"
          xmlns="http://www.w3.org/2000/svg"
          class="w-3.5 ml-2 cursor-pointer shrink-0 fill-black hover:fill-red-500"
          viewBox="0 0 320.591 320.591"
        >
          <path
            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
            data-original="#000000"
          ></path>
          <path
            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
            data-original="#000000"
          ></path>
        </svg>
      </div>
      <div v-if="isLoading" class="chat-log" id="chat-log">
        <div role="status">
          <svg
            aria-hidden="true"
            class="absolute right-1/2 bottom-1/2 w-15 h-15 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
            viewBox="0 0 100 101"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
              fill="currentColor"
            />
            <path
              d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
              fill="currentFill"
            />
          </svg>
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <div v-else class="chat-log" id="chat-log" ref="hasScrolledToBottom">
        <!-- Chat messages will appear here -->
        <p
          v-for="(message, idx) in messages"
          :key="idx"
          class="mt-2 p-3 rounded-2xl"
          :class="
            message.role == 'resolver'
              ? 'ms-10 text-indigo-500 bg-slate-100 '
              : 'bg-indigo-400 me-10 text-slate-50s'
          "
        >
          {{ message.message }}
        </p>
      </div>

      <div class="input-container">
        <input
          type="text"
          class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-indigo-500 placeholder:text-gray-40"
          id="message-input"
          placeholder="Type your message..."
          v-model="newMessage"
        />
        <button
          class="mx-3 px-3 py-2 bg-indigo-400 text-slate-50 rounded-md"
          id="send-button"
          v-on:click="addMessage"
        >
          Send
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { ref, onUpdated } from 'vue'
// import axios from 'axios';
import { getCookie } from '../../helper/CookieHelper.js'
import { useRouter } from 'vue-router'
import apiClient from '../../services/api.js'

export default {
  props: ['role', 'friendId'],
  emit: ['toogle'],
  setup(props, { emit }) {
    const route = useRouter()
    console.log(props)
    // const role = ref(route.currentRoute._value.query.role)
    const role = ref(props.role)
    console.log(role.value)
    const id = ref(null)
    // const friendId = ref(route.currentRoute._value.query.friendId)
    const friendId = ref(props.friendId)
    console.log(friendId.value)
    let messages = ref([])
    let newMessage = ref('')
    const isLoading = ref(true)
    const hasScrolledToBottom = ref(null)

    // Contains a user ID actually
    const user = ref(null)

    // Contains a hash value
    const hash = ref(null)

    if (role.value == 'user') {
      id.value = getCookie('userId')
      apiClient
        .get('/api/users/' + id.value)
        .then((response) => {
          user.value = response.data.data.user_id
          hash.value = hashFunction(user.value, friendId.value)
          console.log(user.value)
          fetchMessages()
        })
        .catch((error) => {
          console.log(error)
        })
    } else if (role.value == 'resolver') {
      id.value = getCookie('resolverId')
      apiClient
        .get('/api/resolvers/' + id.value)
        .then((response) => {
          user.value = response.data.data.attributes.user_id
          hash.value = hashFunction(user.value, friendId.value)
          console.log(user.value)
          console.log(hash.value)
          fetchMessages()
        })
        .catch((error) => {
          console.log(error)
        })
    }

    onUpdated(() => {
      scrollBottom()
    })

    // Generating hash
    function hashFunction(a, b) {
      let hash = a ^ b
      hash ^= (hash << 13) | (hash >>> 19)
      hash ^= (hash << 5) | (hash >>> 27)
      hash ^= hash << 17

      return hash >>> 0
    }

    function fetchMessages() {
      apiClient
        .get('/api/messages/' + hash.value)
        .then((response) => {
          // console.log(response.data);
          messages.value = response.data.data
          isLoading.value = false
        })
        .catch(function (error) {
          console.log(error)
        })
    }

    function scrollBottom() {
      if (messages.value.length > 1) {
        let el = hasScrolledToBottom.value
        el.scrollTop = el.scrollHeight
      }
    }

    Echo.private('query-channel').listen('SendMessage', (e) => {
      // console.log(e);

      if (e.user.id != user.value && e.message.friend_id == user.value && e.user.id == friendId.value ) {
        messages.value.push({
          message: e.message.message,
          user_id: e.user.id,
          friend_id: e.message.friend_id,
          role: e.user.role
        })
      }
    })

    const addMessage = async () => {
      let user_message = {
        user_id: user.value,
        friend_id: friendId.value,
        message: newMessage.value,
        role: role.value,
        hash: hash.value
      }
      messages.value.push(user_message)
      apiClient.post('/api/messages', user_message).then((response) => {
        console.log(response.data)
      })
      newMessage.value = ''
    }
    function toogle() {
      emit('toogle')
    }
    return {
      messages,
      newMessage,
      addMessage,
      isLoading,
      hasScrolledToBottom,
      toogle
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