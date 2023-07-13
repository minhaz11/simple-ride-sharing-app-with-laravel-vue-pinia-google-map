<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">
           Here's your trip.
        </h1>

        
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <GMapMap :center="location.destination.geometry"
                        
                        :zoom="11" ref="gMap" map-type-id="roadmap" style="width: 100%; height: 20rem">
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
                        @click.prevent="confirmTrip"
                     type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-white">Let's Go</button>
                </div>
            </div>
       
    </div>
</template>
<script setup>
    import { useLocationStore } from '../stores/location.js'
    import { useRouter } from 'vue-router'
    import { onMounted,ref } from 'vue';
    import http from '../helpers/http.js';

    const location = useLocationStore();
    const router = useRouter();

    const gMap = ref(null);

    onMounted(async() => {
        if(!location.destination.name) router.push({ name: 'FindRide'})

        await location.updateCurrentLocation()

        gMap.value.$mapPromise.then((map) => {
            let currentPoint = new google.maps.LatLng(location.currentLocation.geometry),
                destinationPoint = new google.maps.LatLng(location.destination.geometry),
               directionService = new google.maps.DirectionsService,
                directionDisplay = new google.maps.DirectionsRenderer({
                     map: map
                });
            
            directionService.route({
                origin: currentPoint,
                destination: destinationPoint,
                avoidTolls : false,
                avoidHighways : false,
                travelMode: google.maps.TravelMode.DRIVING
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionDisplay.setDirections(response);
                } else {
                    console.log('Directions request failed due to ' + status);
                }
            })
        })
    })


    const confirmTrip = async() => {
         try {
            const res = await http().post('/trip',{
                origin : location.currentLocation.geometry,
                destination : location.destination.geometry,
                destination_name : location.destination.name
            })

            router.push({ name: 'trip', params: { id: res.data.id }})
         } catch (error) {
            alert(error)
         }
    }
</script>
