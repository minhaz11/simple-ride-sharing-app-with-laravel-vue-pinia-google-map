<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">
           Here's your trip.
        </h1>

        
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <GMapMap :center="location.destination.geometry"
                        :options="options"
                        :zoom="11" map-type-id="terrain" style="width: 100%; height: 20rem">
                            <GMapCluster :zoomOnClick="true">
                            <!-- <GMapMarker :key="index" v-for="(m, index) in markers" :position="m.position" :clickable="true" :draggable="true"
                                @click="center = m.position" /> -->
                            <GMapMarker :position="location.destination.geometry" />
                            </GMapCluster>
                        </GMapMap>
                    </div>
                </div>
                <div class="bg-white px-4 py-5 sm:p-6 text-right">
                    <button
                    
                     type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-white">Let's Go</button>
                </div>
            </div>
       
    </div>
</template>
<script setup>
    import { useLocationStore } from '../stores/location.js'
    import { useRouter } from 'vue-router'
    import { onMounted } from 'vue';

    const location = useLocationStore();
    const router = useRouter();

    // onMounted(() => {
    //     if(!location.destination.name) router.push({ name: 'location'})

    //     // navigator.geolocation.getCurrentPosition((success) => {
    //     //     console.log(success);
    //     // },(error) => {
    //     //     console.log(error);
    //     // })
    // })
</script>
