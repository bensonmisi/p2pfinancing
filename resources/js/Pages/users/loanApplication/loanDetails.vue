<template>
 <user-layout title="Loan Details">
   <v-container>
       <v-row>
           <v-col cols="12" sm="4">
               <v-card>
                   <v-card-text class="text-center">
                       <v-progress-circular
                           :rotate="360"
                           :size="200"
                           :width="15"
                           :value="value"
                           color="red"
                       >
                           <div>
                           <div>
                           {{ value }}%
                           </div>
                           <div>Completed</div>
                           </div>
                       </v-progress-circular>

                       <v-list>
                           <v-list-item>
                               <v-list-item-content>
                                   Loan Details
                               </v-list-item-content>
                               <v-list-item-action>
                                   <v-icon>mdi-check</v-icon>
                               </v-list-item-action>
                           </v-list-item>
                           <v-list-item>
                               <v-list-item-content>
                                   Collateral Details
                               </v-list-item-content>
                               <v-list-item-action>
                                   <v-icon>mdi-check</v-icon>
                               </v-list-item-action>
                           </v-list-item>
                           <v-list-item>
                               <v-list-item-content>
                                   Collateral Images
                               </v-list-item-content>
                               <v-list-item-action>
                                   <v-icon>mdi-check</v-icon>
                               </v-list-item-action>
                           </v-list-item>
                           <v-list-item>
                               <v-list-item-content>
                                  Confirm
                               </v-list-item-content>
                               <v-list-item-action>
                                   <v-icon>mdi-check</v-icon>
                               </v-list-item-action>
                           </v-list-item>
                       </v-list>
                   </v-card-text>
               </v-card>

           </v-col>
           <v-col cols="12" sm="8">
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
               <v-form ref="form" v-model="isValid" lazy-validation>
               <v-card>
                   <v-card-title>
                       Loan Details
                   </v-card-title>
                   <v-card-text>
                       <v-row>
                           <v-col cols="12" sm="6">
                               <v-text-field
                                   v-model="amount"
                                   label="Amount Required"
                                   outlined
                                   type="number"
                                   prefix="$"
                                   :rules="amountRules"
                               >
                               </v-text-field>
                           </v-col>
                           <v-col cols="12" sm="6">
                               <v-select
                                   v-model="currency"
                                   label="Select Currency"
                                   :items="currencylist"
                                   item-value="id"
                                   item-text="name"
                                   outlined
                                   :rules="currencyRules"
                               >
                               </v-select>
                           </v-col>
                       </v-row>
                       <v-row>
                           <v-col cols="12" sm="6">
                               <v-select
                                   outlined
                                   label="Repayment Period"
                                   :items="repaymentlist"
                                   :rules="repaymentRules"
                                   v-model="repayment"
                                   item-value="id"
                                   item-text="name"
                               >

                               </v-select>
                           </v-col>
                           <v-col cols="12" sm="6">
                               <v-select
                                   outlined
                                   :items="financinglist"
                                   v-model="financing"
                                   :rules="financingRules"
                                   item-value="id"
                                   item-text="name"
                                   label="Financing Period">

                               </v-select>
                           </v-col>
                       </v-row>
                       <v-row>
                           <v-col cols="12">
                       <v-textarea
                           v-model="reason"
                           label="Reason For Loan"
                           outlined
                           :rules="reasonRules"
                       >
                       </v-textarea>
                           </v-col>
                       </v-row>
                   </v-card-text>
                   <v-card-actions>
                       <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('dashboard')">Cancel</inertia-link>
                       <v-spacer/>
                       <v-btn outlined rounded color="green" @click="submitForm">Submit</v-btn>
                   </v-card-actions>
               </v-card>
               </v-form>
           </v-col>
       </v-row>
   </v-container>
     <v-dialog
         v-model="dialog"
         hide-overlay
         persistent
         width="300"
         height="50"
     >
         <v-card
             color="primary"
             dark
         >
             <v-card-text>
                 Please wait ....
                 <v-progress-linear
                     indeterminate
                     color="white"
                     class="mb-0"
                 ></v-progress-linear>
             </v-card-text>
         </v-card>
     </v-dialog>
 </user-layout>
</template>

<script>
 import userLayout from "../../layouts/users";
export default {
    props:['errorMessage','successMessage','errors','repaymentlist','financinglist','currencylist','pending'],
    components:{
        userLayout
    },data(){
        return{
            value:0,
            id:this.pending ? this.pending.id : '',
            reason: this.pending ? this.pending.reason : '',
            reasonRules:[v => !!v || 'Reason for loan'],
            amount:this.pending ? this.pending.amount : '',
            amountRules:[v => !!v || 'Amount required'],
            currency:this.pending ? this.pending.currency : '',
            currencyRules:[v => !!v || 'Select Currency'],
            financing:this.pending ? this.pending.financing : '',
            financingRules:[v => !!v || 'Select Financing Period'],
            repayment:this.pending ? this.pending.repayment : '',
            repaymentRules:[v => !!v || 'Select Repayment Period'],
            isValid:true,
            dialog:false

        }
    },methods:{
       submitForm(){
           if(this.$refs.form.validate()){
               this.dialog=true
               var data ={id:this.id,repaymentPeriod:this.repayment,financingPeriod:this.financing,reason:this.reason,currency:this.currency,amount:this.amount}
               this.$inertia.post('/dashboard/loanApplication',data).then(()=>{
                   this.dialog = false
               })
           }
       }
    }
}
</script>


