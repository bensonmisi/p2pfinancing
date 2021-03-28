<template xmlns="http://www.w3.org/1999/html">
    <Layout title="Make offer">
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

            <v-row class="pa-3">
                <v-col cols="12" md="8" offset-md="2">
                    <v-form v-model="form" ref="form" lazy-validation>
                        <v-card flat outlined>
                            <v-app-bar color="blue" flat>
                                <v-toolbar-title class="white--text">Make Loan Offer</v-toolbar-title>
                            </v-app-bar>
                            <v-card-text>
                                <v-card class="mb-3">
                                    <v-card-text>
                                        <v-row>
                                            <v-col cols="10">
                                               <div class="headline">Available Wallet Balance</div>
                                            </v-col>
                                            <v-col cols="2">
                                                <v-chip>USD {{balance}}</v-chip>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>
                                <v-card class="mb-3">
                                    <v-card-text>
                                        <v-row>
                                            <v-col cols="10">
                                                <div class="headline">Maximum you can offer</div>
                                                <div><small>A user can only give a mixmum of 30% of the required amount</small></div>
                                            </v-col>
                                            <v-col cols="2">
                                                <v-chip>USD {{loanable}}</v-chip>
                                            </v-col>
                                        </v-row>
                                    </v-card-text>
                                </v-card>

                                <div v-if="balance >0" class="mt-5">
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="amount"
                                            label="Enter Offer Amount"
                                            outlined
                                            type="number"
                                            prepend-inner-icon="mdi-currency-usd"
                                            :rules="amountRules"
                                        >
                                        </v-text-field>
                                        <v-select v-model="rate" outlined label="Select Interest Rate" :rules="rateRules" :items="getRate"></v-select>
                                    </v-col>
                                </v-row>
                                    <v-row v-if="amount">
                                        <v-col cols="4">
                                            <v-card outlined flat>
                                                <v-card-text>
                                          <div>USD{{amount}}</div>
                                            <div><small>Investment</small></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-card outlined flat>
                                                <v-card-text>
                                            <div>{{rate}}%</div>
                                            <div><small>Interest</small></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-card outlined flat>
                                                <v-card-text>
                                            <div>USD{{calculate}} </div>
                                            <div><small>ROI per month</small></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-col>
                                    </v-row>
                                </div>
                                <div v-else>
                                   <div class="pa-7 red--text red lighten-5 text-center">
                                       <div class="headline">Insufficient Fund</div>
                                       <div><small>In your investment wallet</small></div>
                                       <div><inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small red--text">How to top up</inertia-link></div>
                                   </div>

                                </div>
                            </v-card-text>
                            <v-card-actions v-if="balance >0">
                                <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('roles.index')">Cancel</inertia-link>
                                <v-spacer></v-spacer>
                                <v-btn rounded outlined color="green" :loading="loading" :disabled="loading" @click="submit">Submit</v-btn>
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
    props:['successMessage','errorMessage','balance','loan','loanable'],
    components:{
        Layout
    },data(){
        return{
            amount:'',
            loading:false,
            amountRules:[
                v=> !!v || 'Amount required',
                v => (v && v <= this.balance) || 'Amount must be less than or equal to '+this.balance,
                v => (v && v <= this.loanable) || 'Maximum offer permitted is : '+this.loanable
            ],
            rate:'',
            rateRules:[v=> !!v || 'Interest rate required'],
            form:true
        }
    },methods:{
        submit(){
            if(this.$refs.form.validate()){
                this.loading= true
                var data = {loan:this.loan,amount:this.amount,percentage:this.rate}
                this.$inertia.post('/dashboard/offers',data).then(()=>{
                    this.loading= false
                })
            }
        }
    },computed:{
         getRate(){
             var rate =[];
              var i =0;
             for (i=10;i<=30;i++){
                 rate.push(i)
             }
             return rate
         },calculate(){
             var amnt = this.amount !=='' ? this.amount : 0;
              var rte = this.rate !=='' ? this.rate :0;

              return amnt*(rte/100)
        }
    }
}
</script>

