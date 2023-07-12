
<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4" v-if="!waitingOnVerification">Enter Your Phone Number</h1>
        <h1 class="text-3xl font-semibold mb-4" v-else>Enter the verification code</h1>

        <form @submit.prevent="handleLogin" v-if="!waitingOnVerification">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" name="phone" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="105678910"
                        v-maska
                        data-maska="###########"
                        v-model="credentials.phone"
                        required>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3 text-white">
                        Continue
                    </button>
                </div>

            </div>
        </form>
        <form @submit.prevent="handleVerification" v-else>
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" name="login_code" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="123456"
                        v-maska
                        data-maska="######"
                        v-model="credentials.login_code"
                        required>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3 text-white">
                        Continue
                    </button>
                </div>

            </div>
        </form>
        
    </div>
</template>

<script setup>
    import { vMaska} from 'maska'
    import { ref, reactive, onMounted} from 'vue'
    import  axios  from 'axios'
    import { useRouter } from 'vue-router'

    const router = useRouter();

    const credentials = reactive({
        phone: null,
        login_code: null
    })

    onMounted(() => {
        if (localStorage.getItem('token')) {
            router.push({name: 'index'})
        }
    })

    const waitingOnVerification = ref(false)

    const handleLogin = () => {
        axios.post('http://127.0.0.1:8000/api/login', credentials)
        .then(response => {
            waitingOnVerification.value = true;
        }).catch(error => {
            console.log(error.response.data)
            alert(error.response.data.message)
        })
    }

    const handleVerification = async() => {
       try {
            const response = await axios.post('http://127.0.0.1:8000/api/login/verify', credentials)

            localStorage.setItem('token', response.data)

            router.push({name: 'start'})

       } catch (error) {
           console.log(error.response.data)
           alert(error.response.data.message)
       }
       
    }

</script>
