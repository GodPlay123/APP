<template>
    <div class="d-flex justify-center align-center">
        <v-card style="width: 650px; max-height: 90%; overflow-y: auto; margin-top: 180px"> 
            <v-card-title>
                <v-row>
                    <v-col cols="6">
                        <br>
                        <center>
                            <img draggable="false" style="width: 230px;height: 230px;" :src="'img/LOGIN.png'" alt="LOGIN Logo"> 
                        </center>
                    </v-col>
                    <v-col cols="6" style="background-color: #7FFFD4;">
                        <br>
                        <h3 style="color: white;font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;text-align:center;">LOGIN</h3>
                        <br>
                        <v-text-field :error="errorUsername !== ''" :error-message="errorUsername ? errorUsername : '' " single-line ariant="solo" density="compact" v-model="account" color="#000000" outlined dense background-color="black" prepend-inner-icon="mdi-account" placeholder="EMAIL"/>
                        <v-text-field :error="errorPassword !== ''" :error-message="errorPassword ? errorPassword : ''" single-line ariant="solo" density="compact" v-model="password" color="#000000" :type="showPass ? 'text' : 'password'" outlined dense background-color="white" prepend-inner-icon="mdi-key" @click:append="showPass=!showPass" :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'" placeholder="PASSWORD"/>
                        <v-spacer/>
                        <v-btn style="float: right;color:#7FFFD4" @click="login()" dense><strong>LOGIN</strong></v-btn>
                    </v-col>
                </v-row>
            </v-card-title>
        </v-card>
    </div>
</template>
<script>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios'

export default {
    setup(){
        const account = ref('')
        const password = ref('')
        const showPass = ref(false)
        const router = useRouter()
        const errorUsername = ref('')
        const errorPassword = ref('')

        const login = () => {

        if (!account.value) {
            errorUsername.value = 'Please enter your email';
        }
        if (!password.value) {
            errorPassword.value = 'Please enter your password';
        }

        if (account.value && password.value) {
        axios.get(`http://localhost:8000/api/users?Status=login&username=${account.value}&password=${password.value}`)
            .then(res => {
                if (res.data === 'Not registered') {
                    errorUsername.value = res.data;
                } else if (res.data === 'Wrong password') {
                    errorPassword.value = res.data;
                } else {
                    localStorage.setItem('auth_token', 'your_token_here');
                    window.location.reload();
                    router.push('/home');
                }
            }); 
        }
        }

        return {showPass, login, account, password, errorUsername, errorPassword }
    }
} 
</script>
