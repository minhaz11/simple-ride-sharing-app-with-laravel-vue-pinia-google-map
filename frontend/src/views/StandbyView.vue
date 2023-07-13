<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">Waiting For a Ride Request</h1>
    
        <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
            <div class="bg-white px-4 py-5 sm:p-6">

            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted } from "vue";
    import Echo from "laravel-echo";
    import Pusher from "pusher-js";


    onMounted(() => {
        let echo = new Echo({
            broadcaster : 'pusher',
            key : 'key',
            cluster : 'mt1',
            wsHost:window.location.hostname,
            wsPort:6001,
            forceTLS:false,
            disableStats:true,
            enabledTransports:['ws','wss']
        })
        
        echo.channel('drivers').listen('TripCreated', (event) => {
            console.log('trip created')
        })
    })

</script>
