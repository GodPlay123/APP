<template>
  <v-app>

    <!-- APP BAR -->
    <v-app-bar
      v-if="isAuthenticated"
      style="background-color:aquamarine"
    >

      <!-- TOGGLE DRAWER -->
      <v-app-bar-nav-icon @click="drawer = !drawer" />

      <v-toolbar-title>MY PORTFOLIO</v-toolbar-title>

    </v-app-bar>

        <!-- SIDE NAVIGATION DRAWER -->
        <v-navigation-drawer
        v-model="drawer"
        app
        >

        <!-- PROFILE -->
        <div class="d-flex flex-column align-center pa-4">

            <v-avatar size="120" class="mb-3" style="border: 1px solid black;">
            <v-img src="/images/quianbarrios.jpg" />
            </v-avatar>

            <h3 class="text-center">QUIAN G. BARRIOS</h3>

            <div class="text-center text-caption">
            <div>
                <v-icon size="small">mdi-email</v-icon>
                quianbarrios@gmail.com
            </div>
            <div>
                <v-icon size="small">mdi-phone</v-icon>
                0915-472-1707
            </div>
            </div>

        </div>

        <v-divider />

        <!-- NAV ITEMS -->
        <v-list density="compact">

            <v-subheader>MY DETAILS</v-subheader>

            <v-list-item
            v-for="(item, i) in Details"
            :key="i"
            :to="item.to"
            @click="drawer = false"
            >
            <v-list-item-title>
                {{ item.text }}
            </v-list-item-title>
            </v-list-item>

        </v-list>

        </v-navigation-drawer>
        
        <!-- <v-app-bar app clipped-left style="background-color:aquamarine" v-if="isAuthenticated">
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>MY PORTFOLIO</v-toolbar-title>
        <v-spacer /> 
            <v-menu offset-y transition="slide-y-transition" bottom rounded v-model="logoutStat">
                <template v-slot:activator="{ on }">
                    <span v-on="on" @click="logoutStat = !logoutStat">
                        <v-icon color="black" class="mt-2">mdi-chevron-down</v-icon>
                    </span>
                </template>
                <v-list dense class="mt-7">
                    <v-list-item @click="Logout">
                        <v-list-item-title> 
                            <h5 style="margin-left: -25px;" @click="Logout()"><v-icon>mdi-logout</v-icon> LOGOUT</h5>
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu> 
        </v-app-bar> -->

        <v-main class="ma-2">
            <router-view></router-view>
        </v-main>

    </v-app>    
</template>
<script>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';

export default{
    setup(){
        const drawer = ref(false);
        const logoutStat = ref(false);
        const router = useRouter();

        const Details = ref([
            {text : 'HOME', to : 'home'},
            {text : 'PROJECTS', to : 'project'},
            {text : 'EDUCATION', to : 'education'},
            {text : 'WORK EXPERIENCE', to : 'experience'},
            {text : 'SKILLS', to : 'skills'},
        ]);

        const isAuthenticated = computed(() => {
            return !!localStorage.getItem('auth_token');
        });

         const Logout = () => {
            localStorage.removeItem('auth_token');
            window.location.reload()
            router.push('/login');
        };

        return { drawer, Details, logoutStat, Logout, isAuthenticated }
    }
}
</script>