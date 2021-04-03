<template>
   <Layout title="Login">
        
       <v-layout>
           <v-flex sm6 md6 xs12 offset-sm3 class="mt-10">
               <v-alert
                   dense
                   text
                   v-if="successMessage"
                   type="success"
               >
                  {{successMessage}}
               </v-alert>
               <v-alert
                   dense
                   text
                   v-if="errorMessage"
                   type="error"
               >
                   {{errorMessage}}
               </v-alert> 

                   <v-alert
                       dense
                       text
                       v-if="errors.email"
                       type="error"
                   >
                       {{errors.email}}
                   </v-alert>
                   <v-card>
              <v-layout wrap>
                  <v-flex  class="text-center pa-10">
                        <v-form ref="login" v-model="valid" lazy-validation>
                      <div class="display-1"> LOGIN </div>
                        <v-text-field
                         outlined
                         label="Email"
                         class="mt-5"

                         filled
                         v-model="email"
                         :rules="emailRule"
                         />
                          <v-text-field
                            v-model="password"
                            label="Password"
                            :append-icon="showPass ? 'mdi-eye' : 'mdi-eye-off'"
                            @click:append="showPass = !showPass"
                            required
                            outlined

                            filled
                            :rules="passwordRule"
                            :type="showPass ? 'text' : 'password'"
                        ></v-text-field>
                        <v-btn
                            rounded
                            depressed
                            class="primary"
                            block
                            :loading="loading"
                            :disabled="loading"
                             @click="login"
                         >
                         SIGN IN
                         </v-btn>
                        <p class="mt-5"><inertia-link href="/register">Do not have an account ?</inertia-link></p>
                        <p><inertia-link href="/forgot-password">Forgot your password ?</inertia-link></p>
                        </v-form>
                  </v-flex>
                   
              </v-layout>

               </v-card>
           </v-flex>

       </v-layout>

   </Layout>
</template>
<script>
import Layout from '../Layout.vue'
export default {
    props:['errors','errorMessage','successMessage'],
     components:{
         Layout
     },data(){
         return{
             showPass:false,
             password:'',
             email:'',
             loading:false,
             valid:true,
             emailRule:[v => !!v || 'Email is required'],
             passwordRule:[v => !!v || 'Password is required']
         }
     },methods:{
         login(){
              if(this.$refs.login.validate()){
                  this.loading = true
                  var formdata ={email:this.email,password:this.password}
                  this.$inertia.post('/login',formdata).then(()=>{
                      this.loading = false
                  })
              }
         }
     }
}
</script>
