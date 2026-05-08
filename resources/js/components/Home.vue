<template>
  <div>
    <v-row>
      <v-col cols="4">
        <v-text-field v-model="SearchUser" class="ma-2" dense  append-inner-icon="mdi-magnify" density="compact" label="Search"
        variant="solo"
        hide-details
        single-line />
      </v-col>
      <v-spacer/>
        <v-btn @click="AddUpdate('ADD','')" class="ma-5"><v-icon>mdi-plus</v-icon>ADD</v-btn>
    </v-row>
    <v-card elevation="5" style="height: 500px;">
      <table border="1" style="width: 100%;margin-top: 1%;">
        <thead>
          <tr>
            <th>FULL NAME</th>
            <th>EMAIL</th>
            <th>ROLE NAME</th>
            <th>ROLE DESCRIPTION</th>
            <th>ACTION </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, i) in FilteredData" :key="i">
              <td>{{ user.full_name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.description }}</td>
              <td style="text-align: center;">
                <v-icon @click="AddUpdate('EDIT',user)" color="blue">mdi-file-edit</v-icon>
                <v-icon @click="AddUpdateSubmit()"color="red">mdi-trash-can</v-icon>
              </td>
          </tr>
        </tbody>
      </table>
    </v-card>
    <v-dialog v-model="updateAdd" persistent style="width: 650px; max-height: 90%; overflow-y: auto; margin-top: 100px">
      <v-card style="width: 500px;">
        <v-card-title style="background-color: aquamarine;">
          <v-row>
            <v-col cols="11">
              <h6>{{ UserTitle }} USER</h6>
            </v-col>
            <v-col cols="1">
                <v-icon @click="CloseAddUpdateDialog" size="small">mdi-close-box</v-icon>
            </v-col>
          </v-row>
        </v-card-title>
        <v-card-text>
        <v-text-field v-model="UserDetails.full_name" dense single-line ariant="solo" density="compact" outlined placeholder="full_name" />
        <v-text-field :disabled="UserTitle === 'EDIT'" v-model="UserDetails.email" dense single-line ariant="solo" density="compact" outlined placeholder="email" />
        <!-- <v-text-field dense single-line ariant="solo" density="compact" outlined placeholder="nominated_password" /> -->
        <v-text-field v-model="UserDetails.password" dense single-line ariant="solo" density="compact" outlined placeholder="password" />
        <!-- <v-select density="compact" single-line v-model="selectedRole" :items="roles" item-text="rolename" item-value="id" label="Select Role"></v-select>-->
        <v-select density="compact" single-line v-model="selectedRole" :items="['Front end Developer','Back end Developer','Full stack Developer']" label="Select Role"/>
      </v-card-text>
      <v-card-actions>
        <v-spacer/>
        <v-btn color="success" variant="flat" size="small" @click="AddUpdateSubmit()">SUBMIT</v-btn>
      </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="ErrorMessage" persistent style="width: 650px; max-height: 90%; overflow-y: auto; margin-top: 100px;">
      <v-card style="width: 500px;" >
        <v-card-title style="background-color: maroon;">
          <v-row>
            <v-col cols="11">
              <h3 style="color:white">INFORMATION</h3>
            </v-col>
            <v-col cols="1">
                <v-icon @click="CloseErrorMessage()" size="small" color="white">mdi-close-box</v-icon>
            </v-col>
          </v-row>
        </v-card-title>
        <v-card-text>
          <h3>{{ErrorDetails}}</h3>
        </v-card-text>
      </v-card>

    </v-dialog>

  </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'

export default {
  setup() {
    const UserDatafiles = ref([])
    const updateAdd = ref(false)
    const selectedRole = ref('')
    const UserTitle = ref(null)
    const UserRole = ref([])
    const UserDetails = ref({})
    const SearchUser = ref('')

    const ErrorMessage = ref(false)
    const ErrorDetails = ref('')

    const CloseErrorMessage = () => {
      ErrorMessage.value = false
    }

    const roles = [
      { id: 1, rolename: 'Front end Developer' },
      { id: 2, rolename: 'Back end Developer' },
      { id: 3, rolename: 'Full stack Developer' },
    ]

    const AddUpdate = (mode,data) => {
        updateAdd.value = true
        UserTitle.value = mode
        if(mode === 'ADD'){
          UserDetails.value = {
            full_name: '',
            email: '',
            password: ''
          }

        }else if(mode === 'EDIT'){
          const selectedRoleObj = roles.find(role => role.id === data.id);
          console.log(data);
            UserDetails.value = {
            full_name: data.full_name,
            email: data.email,
            password: data.password,
          }
            selectedRole.value = selectedRoleObj.rolename
        }
    }

    const CloseAddUpdateDialog = () => {
        updateAdd.value = false
        UserTitle.value = null
        UserDetails.value = {
          full_name: '',
          email: '',
          password: ''
        }
        selectedRole.value = ''

    }

    const AddUpdateSubmit = () => {
      const selectedRoleObj = roles.find(role => role.rolename === selectedRole.value);
      if(UserTitle.value === 'ADD'){
        
          if(selectedRoleObj && UserDetails.value.full_name && UserDetails.value.email && UserDetails.value.password){
            if(UserDetails.value.password.length < 8){
              ErrorMessage.value = true
              ErrorDetails.value = 'Minimum Password 8'
            }else{
              axios.post('http://localhost:8000/api/users', {
                full_name: UserDetails.value.full_name,
                email: UserDetails.value.email,
                password: UserDetails.value.password,
                role: selectedRoleObj.id
              }).then(res => {
                if(res.data == 'Email has already been used'){
                  ErrorMessage.value = true
                  ErrorDetails.value = res.data
                }else{
                  ErrorMessage.value = true
                  ErrorDetails.value = res.data
                  CloseAddUpdateDialog()
                  fetchUsers()
                }
                
              }).catch(err => console.error(err));
            }
          }else{
              ErrorMessage.value = true
              ErrorDetails.value = 'Please Complete the fill up'
          }
        
      }
      else if(UserTitle.value === 'EDIT'){
          axios.put(`http://localhost:8000/api/users/update`, {
            full_name: UserDetails.value.full_name,
            email: UserDetails.value.email,
            password: UserDetails.value.password,
            role: selectedRoleObj.id
          }).then(res => {
              ErrorMessage.value = true
              ErrorDetails.value = res.data
              CloseAddUpdateDialog()
              fetchUsers()
          }).catch(err => console.error(err));
      }
      else{
          axios.put(`http://localhost:8000/api/users/delete`).then(res => {
              ErrorMessage.value = true
              ErrorDetails.value = res.data
              CloseAddUpdateDialog()
              fetchUsers()
          }).catch(err => console.error(err));
      }
    }

    onMounted(() => {
      fetchUsers()
    })

    const fetchUsers = () => {
      axios
        .get(`http://localhost:8000/api/users`)
        .then((res) => {
          UserDatafiles.value = res.data
        })
        .catch((err) => console.error(err))
    }

    const FilteredData = computed(() => {
      if (!SearchUser.value) {
        return UserDatafiles.value;
      } else {
        const search = SearchUser.value.toLowerCase();
        return UserDatafiles.value.filter((data) => {
          return (
            data.full_name.toLowerCase().includes(search) ||
            data.email.toLowerCase().includes(search)
          );
        });
      }
    });

    return {CloseErrorMessage,ErrorDetails, ErrorMessage, fetchUsers, FilteredData, SearchUser, UserDatafiles, updateAdd, selectedRole, roles, AddUpdate, CloseAddUpdateDialog, UserTitle, UserRole, UserDetails, AddUpdateSubmit }
  }
}
</script>
<style scoped>
  table {
    border : 1px solid black;
    border-collapse : collapse;
  }
  th,tr,td{
    border : 1px solid black;
  }
  th{
    background-color: aquamarine;
  }
</style>