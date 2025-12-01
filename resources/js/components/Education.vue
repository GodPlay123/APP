<template>
  <div>
    <v-card elevation="5">
      <v-card-title>EDUCATIONAL ATTAINMENT:</v-card-title>
      <v-row style="margin: 1%;">
        <v-col
          v-for="(item, i) in educationList"
          :key="i"
          cols="6"
        >
          <v-card style="width: 100%; height: 200px " elevation="5">
            <v-card-title :style="{ backgroundColor: item.color, color: 'white' }">
              {{ item.level }}
            </v-card-title>
            <br />
            <v-card-subtitle>
              <v-icon>mdi-school</v-icon> {{ item.school }}
            </v-card-subtitle>
            <v-card-text>
              <template v-if="item.course">
                <h3><v-icon>mdi-certificate</v-icon> COURSE : {{ item.course }}</h3>
              </template>
              <h3><v-icon>mdi-calendar-month</v-icon> YEARS : {{ item.years }}</h3>
              <h3><v-icon>mdi-map-marker</v-icon> ADDRESS : {{ item.address }}</h3>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>

<script>
import { ref } from 'vue'

export default {
  setup() {
    const educationList = ref([
      {
        level: 'ELEMENTARY',
        school: 'DAVID P. JIMENEZ ELEMENTARY SCHOOL',
        years: '2007-2013',
        address: 'Wawa I, Rosario, Cavite',
        color: 'green',
      },
      {
        level: 'HIGH SCHOOL',
        school: 'ROSARIO INSTITUTE',
        years: '2013-2017',
        address: 'C. Abueg St. Rosario, Cavite',
        color: 'blue',
      },
      {
        level: 'SENIOR HIGH SCHOOL',
        school: 'ROSARIO INSTITUTE',
        course: 'ACCOUNTANCY, BUSINESS AND MANAGEMENT (ABM)',
        years: '2017-2019',
        address: 'C. Abueg St. Rosario, Cavite',
        color: 'blue',
      },
      {
        level: 'COLLEGE',
        school: 'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',
        course: 'DIPLOMA IN INFORMATION, COMMUNICATION AND TECHNOLOGY (DICT)',
        years: '2021-2024',
        address: 'Maragondon, Cavite',
        color: 'maroon',
      },
    ])

    return {educationList}
  }
}
</script>
