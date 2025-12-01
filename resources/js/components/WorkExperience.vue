<template>
    <v-div>
        <v-card elevation="15" style="height: 350px;">
        <v-card-title>WORK EXPERIENCE:</v-card-title>
            <v-row style="margin: 2px;">
                <v-col cols="3">
                    <v-tabs
                    v-model="tab"
                    direction="vertical"
                    show-arrows
                    >
                    <v-tab value="hrd">HRD SINGAPORE PTE LTD</v-tab>
                    <v-tab value="shein">SHEIN PHILIPPINES</v-tab>
                    </v-tabs>
                </v-col>

                <v-col cols="9">
                    <v-window v-model="tab">
                        <v-window-item value="hrd">
                            <v-card style="background-color: antiquewhite;">
                            <v-card-title>HRD SINGAPORE PTE LTD (2022-2024)</v-card-title>
                            <v-card-text>
                                ROLE :<b>JUNIOR PROGRAMMER</b><br><br>
                                WORK DESCRIPTION :<br><br>
                                We are assigned to develop a new system and maintain an existing one — an in-house website for our sister company — to help lessen time consumption and maximize the use of raw materials.
                                <br><br>
                                We also receive problem calls and provide solutions by going to the actual production area to check the website or inspect the database and debug the root cause of the issue.
                            </v-card-text>
                            </v-card>
                        </v-window-item>

                        <v-window-item value="shein">
                            <v-card style="background-color: antiquewhite;">
                            <v-card-title>SHEIN PHILIPPINES(2024 - PRESENT)</v-card-title>
                            <v-card-text>
                                ROLE : <b>CUSTOMER SERVICE REPRESENTATIVE</b><br><br>
                                WORK DESCRIPTION :<br><br>
                                Provided excellent customer support by handling inquiries, processing orders, tracking shipments, and resolving product or delivery issues through email. 
                                <br><br>
                                Ensured customer satisfaction by delivering timely, accurate information and empathetic solutions, contributing to improved customer retention and positive feedback.
                            </v-card-text>
                            </v-card>
                        </v-window-item>
                    </v-window>
                </v-col>
            </v-row>
        </v-card>
    </v-div>
</template>

<script>
import { ref } from 'vue'

export default {
    setup() {
        const tab = ref('hrd')

        return {tab};
    }
}
</script>
