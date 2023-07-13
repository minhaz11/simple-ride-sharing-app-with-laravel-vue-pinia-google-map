<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">Driver and Car details</h1>
       

        <form @submit.prevent="saveDriver">
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input type="text" name="name" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Full Name"
                        v-model="driver.name"
                        required>
                    </div>
                    <div class="mt-2">
                        <input type="number" name="year" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Car Year"
                        v-model="driver.year"
                        required>
                    </div>
                    <div class="mt-2">
                        <input type="text" name="make" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Make"
                        v-model="driver.make"
                        required>
                    </div>
                    <div class="mt-2">
                        <input type="text" name="model" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Car Model"
                        v-model="driver.model"
                        required>
                    </div>
                    <div class="mt-2">
                        <input type="text" name="color" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Car Color"
                        v-model="driver.color"
                        required>
                    </div>
                    <div class="mt-2">
                        <input type="text" name="license_plate" class="mt-1 block w-full py-2 px-3 rounded-md border border-gray-300 shadow-sm" placeholder="Car license plate"
                        v-model="driver.license_plate"
                        required>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-3 text-white">
                        Submit
                    </button>
                </div>

            </div>
        </form>
    </div>
</template>
<script setup>
    import { reactive } from "vue";
    import { useRouter } from 'vue-router'
    import  http  from '../helpers/http.js'

    const router = useRouter();


    const driver = reactive({
        name: '',
        year: null,
        make: '',
        model: '',
        color: '',
        license_plate: ''
    })

    const saveDriver = async() => {
        try {
            const response = await http().post('/driver', driver)
            if(response.data.driver){
                router.push({ name: 'standby'})
            }
        } catch (error) {
            alert(error)
        }
    }

</script>
