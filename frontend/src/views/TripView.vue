<template lang="">
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">
           Waiting for a driver....
        </h1>

        
            <div class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left">
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                       <GMapMap  :zoom="14" ref="gMap" style="width: 100%; height: 300px" />
                    </div>
                </div>
                <div class="bg-white px-4 py-5 sm:p-6 text-right">
                    <span>When a driver accepts the trip, their info will apear here.</span>
                </div>
            </div>
       
    </div>
</template>
<script setup>
import { ref } from "vue";

const gMap = ref(null);


</script>
