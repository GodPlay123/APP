<template>
  <v-card elevation="5">
    <v-card-title>SKILLS:</v-card-title>
    <table width="100%" style="border-collapse: collapse;">
      <tr v-for="item in pagedSkills" :key="item.skillsName">
        <td style="width: 25%;" :style="`background-color:${item.color}`">
            <div style="display: flex; justify-content: center; align-items: center;margin: 2%;">
                <v-img :src="`/images/${item.skillsName}.png`" style="width: 80px; height: 80px;" />
            </div>
        </td>
        <td style="width: 25%;text-align: center;" :style="`background-color:${item.color}`">{{ item.skillsName }}</td>
        <td style="width: 50%;">
          <!-- Progress bar -->
            <div style="margin: 2%;">
                <div class="progress-wrapper">
                    <div class="progress-bar" :style="{ width: item.skillsLevel }"></div>
                    <span class="progress-text">{{ item.skillsLevel }}</span>
                </div>
            </div>
        </td>
      </tr>
    </table>
    <v-pagination v-model="currentPage" :length="totalPages" :total-visible="5" class="mt-4"></v-pagination>
  </v-card>
</template>

<script>
import { ref, computed } from "vue";

export default {
  setup() {
    const skills = [
      { skillsName: "PHP", skillsLevel: "75%",color : "#add8e6" },
      { skillsName: "CSS", skillsLevel: "80%",color : "#add8e6" },
      { skillsName: "HTML", skillsLevel: "90%",color : "#eebf90" },
      { skillsName: "Javascript", skillsLevel: "85%",color : "#eeee90" },
      { skillsName: "Vue 2", skillsLevel: "90%",color : "#90ee90" },
      { skillsName: "Vue 3", skillsLevel: "90%",color : "#90ee90" },
      { skillsName: "Laravel 8", skillsLevel: "85%",color : "#eebf90" },
      { skillsName: "Laravel 12", skillsLevel: "80%",color : "#eebf90" },
      { skillsName: "Vuetify 2", skillsLevel: "90%",color : "#add8e6" },
      { skillsName: "GITLAB", skillsLevel: "90%",color : "#eebf90" },
      { skillsName: "RESTful API", skillsLevel: "90%",color : "#eebf90" },
      { skillsName: "EXCEL", skillsLevel: "80%",color : "#90ee90" },
    ];

    const itemsPerPage = 5;
    const currentPage = ref(1);

    const totalPages = computed(() => Math.ceil(skills.length / itemsPerPage));

    const pagedSkills = computed(() => {
      const start = (currentPage.value - 1) * itemsPerPage;
      const end = start + itemsPerPage;
      return skills.slice(start, end);
    });

    return { pagedSkills, currentPage, totalPages };
  },
};
</script>

<style scoped>
table, tr, td {
  border:1px solid black;
  border-collapse: collapse;
}
.progress-wrapper {
  position: relative;
  background-color: gray;
  height: 20px;
  border-radius: 10px;
  width: 100%;
  overflow: hidden;
}

.progress-bar {
  background-color: #048BA8;
  height: 100%;
  border-radius: 10px 0 0 10px;
}

.progress-text {
  position: absolute;
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  font-size: 12px;
  font-weight: bold;
  line-height: 20px;
  color: #fff;
}
</style>
