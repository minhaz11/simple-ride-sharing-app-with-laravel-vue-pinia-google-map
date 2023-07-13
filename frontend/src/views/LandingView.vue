<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">UBER</h1>
        <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="flex justify-between">
                    <button
                     @click="startDriving"
                     class="rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white">Start Driving</button>

                    <button class="rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white" @click="findRide">Find A Ride</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>

import { useRouter } from 'vue-router' 
import  http  from '../helpers/http.js' 

const router = useRouter();

const findRide = () => {
    router.push({ name: 'FindRide'})
}

const startDriving = async() => {
    try {
        const response = await http().get('/driver')
        if(response.data.driver){
            router.push({ name: 'standby'})
        }else{
            router.push({ name: 'driver'})
        }
    } catch (error) {
        alert(error)
    }
}

</script>
