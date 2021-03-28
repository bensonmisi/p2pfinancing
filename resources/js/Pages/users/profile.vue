<template>
   <Layout title="Profile Settings">
       <v-container>

           <v-row>
               <v-col cols="12" md="10" offset-md="1">
                   <v-alert
                       border="top"
                       color="red lighten-2"
                       dark
                       v-if="errors.email"
                   >
                       {{errors.email}}
                   </v-alert>
                   <v-alert
                       border="top"
                       color="red lighten-2"
                       dark
                       v-if="errorMessage"
                   >
                       {{errorMessage}}
                   </v-alert>
                   <v-form ref="userForm" lazy-validation v-model="userForm">
                       <v-card>
                           <v-card-title>User Profile</v-card-title>
                           <v-card-text>


                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="name"
                                           label="Name"
                                           outlined
                                           :rules="NameRules"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="surname"
                                           label="Surname"
                                           outlined
                                           :rules="SurnameRules"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="email"
                                           label="Email"
                                           outlined
                                           :rules="EmailRules"
                                       >
                                       </v-text-field>

                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="mobile"
                                           label="Mobile Number"
                                           outlined
                                           :rules="mobileRules"
                                       >
                                       </v-text-field>

                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="password"
                                           outlined
                                           :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                           :rules="[rules.required, rules.min]"
                                           :type="show1 ? 'text' : 'password'"
                                           label="Password"
                                           hint="At least 8 characters"
                                           counter
                                           @click:append="show1 = !show1"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12">
                                       <v-text-field
                                           v-model="password_confirmation"
                                           outlined
                                           :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                           :rules="[rules.required, rules.min,rules.passwordMatch]"
                                           :type="show2 ? 'text' : 'password'"
                                           label="ConfirmPassword"
                                           hint="At least 8 characters"
                                           counter
                                           @click:append="show2 = !show2"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>


                           </v-card-text>
                           <v-card-actions>
                               <v-spacer/> <v-btn outlined rounded :loading="loading" :disabled="loading" color="green" @click="updateUser">Update</v-btn>
                           </v-card-actions>
                       </v-card>
                   </v-form>
               </v-col>
           </v-row>
       </v-container>
   </Layout>
</template>

<script>
import Layout from '../layouts/users'
export default {
    props:['errors','errorMessage','successMessage','user'],
    components:{
        Layout
    },
    data(){
        return{
            loading:false,
            userForm:true,
            companyForm:true,
            show1:false,
            show2:false,
            name:this.user ?  this.user.name :'',
            surname: this.user ? this.user.surname : '',
            email: this.user ? this.user.email : '',
            mobile: this.user ? this.user.mobile: '',
            password:'',
            password_confirmation:'',
            NameRules:[
                v=> !!v || 'Name is required'
            ],
            SurnameRules:[
                v=> !!v || 'Surname is required'
            ],
            PhoneRules:[
                v=> !!v || 'Phone is required'
            ],
            PasswordRules:[
                v=> !!v || 'Password is required'
            ],
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 8 || 'Min 8 characters',
                passwordMatch: v =>(!!v && v)=== this.password || `The passwords you entered don't match`,
            },
            EmailRules:[
                v => !!v || 'Email is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',

            ],
            mobileRules:[
                v=> !!v || 'Mobile number is required'
            ]
        }
    },methods:{
        updateUser(){
           if(this.$refs.userForm.validate()){
               var  data = {name:this.name,surname:this.surname,email:this.email,mobile:this.mobile,password:this.password,password_confirmation:this.password_confirmation}
               this.loading = true;
               this.$inertia.post('/dashboard/profile',data).then(()=>{
                 this.loading= false;
               })
           }
        }
    }
}
</script>

