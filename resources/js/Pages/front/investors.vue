<template>
    <welcomeLayout  title="investors">
         <div>
         <v-container>
             <v-card>
                 <v-card-text>
                     <div class="d-flex">
                        <div><inertia-link :href="$route('welcome')">Home</inertia-link></div><div class="ml-3">></div><div class="ml-3">Investing</div>
                     </div>
                 </v-card-text>
             </v-card>
             <v-card class="mt-5">
                 <v-card-title>Investment Calculator</v-card-title>
                 <v-card-text>
                    <v-container fluid>
        <v-row>
                <v-col cols="12">
            <v-slider
      v-model="amount"
      label="Amount(USD)"
      max="10000"
      min="50"
      step="10"
      thumb-color="orange"
      thumb-label="always"
    ></v-slider>
          </v-col>
      

            <v-col cols="12">
            <v-slider
      v-model="months"
      label="Duration(months)"
      max="12"
      min="1"
      thumb-color="blue"
      thumb-label="always"
    ></v-slider>
          </v-col>

          <v-col cols="12">
            <v-slider
      v-model="interest"
      label="Interest(%)"
      max="30"
      min="10"
      thumb-color="green"
      thumb-label="always"
    ></v-slider>
          </v-col>
        </v-row>

        <v-row>
            <v-col cols="6" md="3">
                <v-card flat outlined>
                    <v-card-text class="text-center">
                       <div class="headline">{{amount}}</div>
                       <div class="body-1">Amount(USD)</div>
                    </v-card-text>
                </v-card>
            </v-col>
             <v-col cols="6" md="3">
               <v-card flat outlined>
                    <v-card-text class="text-center">
                       <div class="headline">{{interest}}</div>
                       <div class="body-1">Interest(%)</div>
                    </v-card-text>
                </v-card>
            </v-col>
             <v-col cols="6" md="3">
                 <v-card flat outlined>
                    <v-card-text class="text-center">
                       <div class="headline">{{months}}</div>
                       <div class="body-1">Duration(Months)</div>
                    </v-card-text>
                </v-card>
            </v-col>
             <v-col cols="6" md="3">
                  <v-card flat outlined>
                    <v-card-text class="text-center">
                       <div class="headline">{{calculateInvestment}}</div>
                       <div class="body-1">ROI(USD)</div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
      </v-container>
                 </v-card-text>
             </v-card>
             <v-card class="mt-5" flat>
                 <v-card-title>How we protect your investment</v-card-title>
                 <v-card-text>
                       <div class="body-1 mt-2">
                          Like all other investment schemes peer to peer financing has its own risks. The major one being of borrowers default on ther repayments, we have however tried to minimize that risk, by making the followin measures
                       </div>
                       <v-row class="mt-2">
                           <v-col cols="12" md="4">
                               <v-card>
                                   <v-card-text class="text-center">
                                       <div class="display-2">1.</div>
                                       <div class="headline">Collateral Base loans</div>
                                       <div class="body-1">All loan applications on our platform are collateral based and a borrower will sign all necessary legal documents that permits us to liquidate  in to retrieve the investors funds</div>
                                   </v-card-text>
                               </v-card>
                           </v-col>
                                 <v-col cols="12" md="4">
                               <v-card>
                                   <v-card-text class="text-center">
                                       <div class="display-2">2.</div>
                                       <div class="headline">Collateral Evaluation</div>
                                       <div class="body-1">Before publishing a loan on our platform we would have vetted the borrowers collateral. We vet ownership authenticity, collateral market value and liquidability ratio </div>
                                   </v-card-text>
                               </v-card>
                           </v-col>
                                <v-col cols="12" md="4">
                               <v-card>
                                   <v-card-text class="text-center">
                                       <div class="display-2">3.</div>
                                       <div class="headline">Collateral Handling</div>
                                       <div class="body-1">Before your funds are disbursed the borrower has to surrender his collateral into our possession  and sign necessary documents that gives us permission to liquidate the asset</div>
                                   </v-card-text>
                               </v-card>
                           </v-col>
                       </v-row>
                 </v-card-text>
             </v-card>

                   <div class='mt-10 grey lighten-4'>
      <v-row>
         <v-col cols="12" md="6" offset-md="3"  class="text-center mt-10 ">
          <div class="display-1">How to invest</div>
          <div class="body mt-3">An individual can easily invest on our platform by following 6 easy steps</div>         
         </v-col>
      </v-row>
      <v-container class="mt-4">
       <v-row>
                <v-col cols="12" md="4">
                    <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">1.</div>
                          <div class="headline mt-4">Create Account</div>
                          <div class="mt-4">Get started by creating an account which will require to fill a simple online form</div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                      <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">2.</div>
                          <div class="headline mt-4">Pay Subscription</div>
                          <div class="mt-4">Our platform will required a once off non-refundable subscription fee</div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                       <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">3.</div>
                          <div class="headline mt-4">Wallet Funding</div>
                          <div class="mt-4">In order to start make loan offers  you will need to fund your investment wallet</div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
              <v-row>
                <v-col cols="12" md="4">
                    <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">4.</div>
                          <div class="headline mt-4">Scroll Request list</div>
                          <div class="mt-4">Scroll through our published loan request lists, view and carefully read our review on the each loan request collateral </div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">5.</div>
                          <div class="headline mt-4">Make Offer</div>
                          <div class="mt-4">Once you have identified a loan request that you want to invest, make an offer by inputting the amount and interest rate</div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                     <v-card 
                     class="blue darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">6.</div>
                          <div class="headline mt-4">Final</div>
                          <div class="mt-4">Once your has been accepted by the borrower will remit your funds and our system will generate loan installment repayment dates</div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="2" offset-md="5">
                     <div><inertia-link :href="$route('register')" class="mt-3 v-btn v-btn--outlined v-btn--rounded theme--light v-size--default">Get Started</inertia-link></div>
                              
                </v-col>
            </v-row>
      </v-container>
      </div>
         </v-container>
         </div>
    </welcomeLayout>
</template>
<script>
import  welcomeLayout  from '../Layout'
export default {
    props:['fee'],
    components:{
        welcomeLayout
    },  data () {
      return {
        amount: 50,
        months: 1,
        interest: 0,
      }
    },computed:{
        calculateInvestment(){
            var interest = this.interest/100;
            var roi =   this.amount * interest;

            var totalroi =  roi * this.months

            return Math.round(this.amount + totalroi)
        }
    }
}
</script>
