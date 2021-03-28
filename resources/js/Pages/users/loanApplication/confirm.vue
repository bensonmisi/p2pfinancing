<template>
    <user-layout title="Confirm">
        <v-row>
            <v-col cols="12" sm="4">
                <v-card>
                    <v-card-text class="text-center">
                        <v-progress-circular
                            :rotate="360"
                            :size="200"
                            :width="15"
                            :value="value"
                            color="green"
                        >
                            <div>
                                <div>
                                    {{ value }}%
                                </div>
                                <div>Completed</div>
                            </div>
                        </v-progress-circular>

                        <v-list>
                            <inertia-link  class=" v-list-item v-list-item--link theme--light" :href="$route('loanApplication.create')">
                                <v-list-item-content class="green--text">
                                    Loan Details
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon class="green--text">mdi-check</v-icon>
                                </v-list-item-action>
                            </inertia-link>
                            <inertia-link  class=" v-list-item v-list-item--link theme--light" :href="$route('collateralApplication.index')">
                                <v-list-item-content class="green--text">
                                    Collateral Details
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon class="green--text">mdi-check</v-icon>
                                </v-list-item-action>
                            </inertia-link>
                            <inertia-link  class=" v-list-item v-list-item--link theme--light" :href="$route('collateralImages.show',1)">
                                <v-list-item-content class="green--text">
                                    Collateral Images
                                </v-list-item-content>
                                <v-list-item-action>
                                    <v-icon class="green--text">mdi-check</v-icon>
                                </v-list-item-action>
                            </inertia-link>

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

        <v-container>
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
                <v-card-title>Confirm Loan Amount</v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <div v-if="loan.amount > calculated_loan">
                    <v-alert
                        dense
                        outlined
                        type="error"
                    >
                        Your Loan amount of USD <strong>{{loan.amount}}</strong> is more than the maximum amount based on your collateral value. Maximus loan applicable is <strong>USD {{calculated_loan}}</strong> please go to loan details and correct  your loan amount
                        <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('loanApplication.create')">Edit Loan</inertia-link>


                    </v-alert>
                    </div>
                    <v-row>
                        <v-col cols="12" sm="6">
                            <v-card>
                                <v-card-text class="text-center">
                                    <div class="subtitle-1">Reason for loan</div>
                                    <div class="subtitle-2 black--text">{{loan.reason}}</div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols="12" sm="6">
                            <v-card>
                                <v-card-text class="text-center">
                                    <div class="subtitle-1">Amount Requied</div>
                                    <div class="subtitle-2 black--text">USD{{loan.amount}}</div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>


                    <v-row class="mt-5">
                        <v-col cols sm="4">
                            <v-card>
                                  <v-card-text class="text-center">
                                    <div class="subtitle-1">Collateral Value</div>
                                    <div class="title blue--text">USD{{loan.collateral.value}}</div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols sm="4">
                            <v-card>
                                <v-card-text class="text-center">
                                    <div class="subtitle-1">Max % on Collateral</div>
                                    <div class="title red--text">{{percentage.value}} %</div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                        <v-col cols sm="4">
                            <v-card>
                                <v-card-text class="text-center">
                                    <div class="subtitle-1">Max Amount Applicable</div>
                                    <div class="title green--text">USD {{calculated_loan}} </div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-card-text>
                <v-card-actions>
                    <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('dashboard')">Discard</inertia-link>
                    <v-spacer/>
                    <div v-if="loan.amount <= calculated_loan">
                        <v-btn rounded outlined color="blue" class="white--text" @click="confirm" :loading="loading" :disabled="loading">confirm</v-btn>
                    </div>

                </v-card-actions>
            </v-card>


        </v-container>

            </v-col>
        </v-row>
    </user-layout>
</template>

<script>
import userLayout from "../../layouts/users";
export default {
    props:['successMessage','errorMessage','errors','loan','percentage'],
    components:{
        userLayout
    },data(){
        return{
            value:75,
            loading:false
        }
    },methods:{
       confirm(){
             this.loading = true;
              var formdata = {id:this.loan.id}
             this.$inertia.put('/dashboard/loanApplication/'+this.loan.id,formdata).then(()=>{
                 this.loading= false
             })
       }
    },
    computed:{
        calculated_loan(){
             return (this.loan.collateral.value * this.percentage.value)/100;
        }
    }
}
</script>



