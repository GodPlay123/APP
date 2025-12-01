<template>
    <v-card elevation="5">
      <v-card-title>PROJECTS:</v-card-title>
        <v-row style="margin: 1%;">
            <v-col
            v-for="(item, i) in projects"
            :key="i"
            cols="6"
            >
                <v-card elevation="5">
                    <v-card-title>
                        {{ item.projectName }}
                    </v-card-title>
                    <v-card-text v-if="showinformation && textInformation == item.value">
                        {{ item.projectDetails }}
                    </v-card-text>
                    <v-card-actions>
                    <v-spacer/>
                        <v-icon @click="ShowDetails(item.value,showinformation ? 'Close' : 'Open')"> 
                            {{showinformation && textInformation == item.value ? 'mdi-chevron-down' : 'mdi-chevron-up'}}
                        </v-icon>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row> 
    </v-card>
</template>
<script>

import { ref } from 'vue'

export default {
    setup() {

        const showinformation = ref(false)
        const textInformation = ref('')
        const projects = ref([
        {
            projectName: "I-Cube Packing Arrangement (WALL)",
            projectDetails: "I am part of the team developing the Wall module for our cube-packaging project.\n I created a page that allows clients to select all the required wall components needed to build their wall configuration.\nOnce the selection is complete, the system generates a printable sheet that includes a QR code.\n\nThis QR code is then passed to the production team. When scanned, it displays all the registered items required for that specific wall.\nThe production team can then pick the correct components and attach the appropriate sticker to each part, ensuring that when the wall reaches the assembly stage, it can be built accurately and completed without any mistakes.",
            value: "IPAC"
        },
        {
            projectName: "Emergency Response Team",
            projectDetails: "I developed the Emergency Response Team module, which helps team leaders easily add and remove active firefighters and assign their positions.\nThe system supports multiple teams—from Team A up to Team G—each with different members and a designated leader.\n\nEvery team can be printed on A3 paper with its original organizational chart. These charts are displayed on each wall as a reminder of who to contact during an emergency.",
            value: "ERT"
        },
        {
            projectName: "Work In Progress",
            projectDetails: "This module is still a work in progress and is being built to help us maximize raw materials and reduce overall cost.\nCurrently, some materials can produce only two usable pieces, while the remaining offcuts are discarded.\nWith this system, the required material sizes for each house will be optimized to minimize waste and ensure all usable parts are fully utilized.\n\nThe system will generate multiple stickers showing the correct sizing and layout for each material.\nThese stickers will be placed on the cutting materials and will include important information such as part size, house code, and classification.\nThis allows the production team to clearly identify where each part belongs and stay organized during the cutting and assembly process.",
            value: "WIP"
        },
        {
            projectName: "Container Design Phase 2",
            projectDetails: "Container Design – Part 2 was developed to prevent issues where items are forgotten during loading and are not delivered to their designated country. Such mistakes are costly for the company, so this system ensures that all materials are included before the container is shipped.\n\nIn this system, the entire container layout is displayed, showing its size and available space. Users can search for a house code, and all required materials for that house will appear on the left side of the screen. These items can then be arranged inside the container—similar to a Tetris layout—based on their size and position.\n\nOnce the arrangement is finalized, the logistics team will begin loading the items one by one. Each item has a sticker with a barcode, and the loader will scan the item as it is placed in its designated position. The system automatically updates the status and greys out the loaded item to indicate it has been placed.\n\nWhen all items are fully loaded, the system notifies the team that the container is ready for sealing and shipment. This process helps prevent incomplete shipments and saves significant costs by ensuring no materials are left behind.",
            value: "CDP"
        },
        ])

        const ShowDetails = (value,info) => {
            if(info == "Open"){
                showinformation.value = true
                textInformation.value = value
            }
            else{
                showinformation.value = false
                textInformation.value = ''
            }
        }    
        return {projects,showinformation,textInformation,ShowDetails}
    }
}
</script>