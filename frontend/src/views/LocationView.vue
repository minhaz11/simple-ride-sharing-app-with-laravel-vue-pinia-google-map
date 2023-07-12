<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">
            Where are you going ?
        </h1>

        <form >
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <!-- <input type="text" placeholder="My destination" class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm" name="location"> -->
                        <GMapAutocomplete
                            placeholder="This is a placeholder"
                            @place_changed="setPlace"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm"
                            >
                        </GMapAutocomplete>
                    </div>
                </div>
                <div class="bg-white px-4 py-5 sm:p-6">
                    <button
                     @click.prevent="handleSelectLocation"
                     type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-white">Find A Ride</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script setup>

import { useRouter } from 'vue-router'
import { useLocationStore } from '../stores/location.js'

const router = useRouter();
const location = useLocationStore();

function setPlace(e) { 
    location.$patch({
        destination : {
            name:e.name,
            address : e.formatted_address,
            geometry : {
                lat : e.geometry.location.lat(),
                lng : e.geometry.location.lng()
            }
        }
    })
}

function handleSelectLocation() {
    if(!location.destination.name) return alert('Please select a destination')
    router.push({ name: 'map'})
}

</script>
