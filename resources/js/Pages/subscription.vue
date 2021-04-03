<template>
   <welcomeLayout title="Subscription">
       <v-container>
             <div class="pa-3">
                <v-alert
                    type="error"
                    v-if="errorMessage"
                >
                    {{errorMessage}}
                </v-alert>
                <v-alert
                    type="success"
                    v-if="successMessage"
                >
                    {{successMessage}}
                </v-alert>
            </div>
             <v-row>
                 <v-col cols="12" md="6" offset-md="3">
                     <v-card class="text-center">
                         <v-card-text>
                           <div class="headline">Subscription</div>                           
                         <v-divider></v-divider>
                         <div class="d-flex mt-10 justify-center">
                             <div><small>ZWL</small></div><div class="display-1">{{fee.amount}}</div>
                             
                         </div>
                         <div class="headline mt-2">Lifetime</div>
                         <div class="mt-5">
                             This is a once-off membership subscription that is meant to prevent ghosts accounts(these are users who just create accounts without any intention to use the service).
                         </div>
                         <div class="mt-4 headline">Select Payment Method</div>
                             <v-card class="mt-4">
                                    <v-card-text>
                                <v-row>
                                    <v-col cols="6" sm="3">
                                        <v-img
                                        lazy-src="/img/ecocash.jpg"
                                        max-height="50"
                                        max-width="100"
                                        src="/img/ecocash.jpg"
                                    ></v-img>
                                    </v-col>
                                    <v-col cols="6" sm="6">
                                        <div class="headline">ecocash</div>
                                    </v-col>
                                    <v-col cols="12" sm="3">
                                       <v-btn small rounded depressed color="primary" @click="showDialog('ECOCASH')">Select</v-btn>
                                    </v-col>
                                </v-row>
                                    </v-card-text>
                                </v-card>
                                <v-card class="mt-4">
                                    <v-card-text>
                                        <v-row>
                                            <v-col cols="6" sm="3">
                                                <v-img
                                                    lazy-src="/img/onemoney.jpg"
                                                    max-height="50"
                                                    max-width="100"
                                                    src="/img/onemoney.jpg"
                                                ></v-img>
                                            </v-col>
                                            <v-col cols="6" sm="6">
                                                <div class="headline">onemonay</div>
                                            </v-col>
                                            <v-col cols="12" sm="3">
                                              <v-btn small rounded depressed color="primary" @click="showDialog('ONEMONEY')">Select</v-btn>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                         </v-card-text>
                     </v-card>
                 </v-col>
             </v-row>
             <v-dialog v-model="paymentDialog" max-width="400">
                 <v-form ref="form" v-model="form" lazy-validation>
                 <v-card max-width="400">
                     <v-app-bar :class="`${mode}`">
                         <v-toolbar-title>{{mode}}</v-toolbar-title>
                     </v-app-bar>
                           <v-card-text class="pa-4">

                            <v-text-field
                                v-model="phone"
                                label="Mobile Number"
                                outlined
                                :rules="phoneRules"
                            >
                            </v-text-field>
                     </v-card-text>
                     <v-card-actions>
                         <v-btn rounded depressed color="error" @click="paymentDialog=false">Cancel</v-btn>
                         <v-spacer></v-spacer>
                         <v-btn rounded depressed color="success" :disabled="loading" :loading="loading" @click="process">Submit</v-btn>
                     </v-card-actions>
                 </v-card>
                 </v-form>
             </v-dialog>
             <v-dialog v-model="confirmDial" max-width="400" v-if="successMessage">
                   <v-card>
                    <v-app-bar class="cyan accent-4 white--text">
                        <v-toolbar-title>Confirm Payment</v-toolbar-title>
                    </v-app-bar>
                    <v-card-text class="text-center">
                        <p class="text-lg font-weight-bold">1 PLEASE CHECK YOUR PHONE AND ENTER YOUR PIN TO AUTHORIZE THE TRANSACTION</p>
                        <p class="text-lg font-weight-bold">2 WHEN YOU HAVE AUTHORIZED THE TRANSACTION PLEASE PRESS BUTTON BELOW TO COMPLETE THE TRANSACTION</p>

                        <v-btn rounded color="success" block :loading="loading" :disabled="loading" @click="confirmPayment">I completed Payment</v-btn>
                         <v-btn rounded outlined color="error" block class="mt-2" @click="restart">I don't receive anything on my phone</v-btn>

                    </v-card-text>
                </v-card>
             </v-dialog>
       </v-container>
   </welcomeLayout>
</template>
<script>
import  welcomeLayout  from './Layout'
export default {
    props:['fee','user','errorMessage','successMessage'],
    components:{
     welcomeLayout
    },data(){
        return{
            mode:'',
            paymentDialog:false,
            confirmDial:false,
            phone:"",
            phoneRules:[v => !!v || this.mode+' Phone number  required'],
            loading:false,
            form:true
        }
    },methods:{
        showDialog(mode){
            this.mode = mode
            this.paymentDialog = true
        },process(){
          if(this.$refs.form.validate()){
              this.loading = true
              var data ={phone:this.phone,mode:this.mode}
              this.$inertia.post('/subscription',data).then(()=>{
               this.loading = false
               this.confirmDial = true
              })
          }
        },confirmPayment(){
           this.loading = true
           this.$inertia.get('/subscription/create').then(()=>{
               this.loading = false
               this.confirmDial = false
           })
        },restart(){
            this.loading=false
            this.confirmDial = false
            this.paymentDialog = true
        }
    }
}
</script>
<style scoped>
 .ECOCASH{
     background-color: #00b0ff;
     color: mintcream;
 }
 .ONEMONEY{
     background-color: orange;
     color: white;
 }
</style