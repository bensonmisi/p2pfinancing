<template>
    <welcomeLayout  title="borrowers">
         <div>
         <v-container>
             <v-card>
                 <v-card-text>
                     <div class="d-flex">
                        <div><inertia-link :href="$route('welcome')">Home</inertia-link></div><div class="ml-3">></div><div class="ml-3">Borrowers</div>
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
                       <div class="body-1">Monthly Installments(USD)</div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
      </v-container>
                 </v-card-text>
             </v-card>

             <v-card outlined class="mt-8">
                 <v-card-text>
             <v-row>
                 <v-col cols="12" md='10' offset-md="1" class="text-center">
                      <div class="display-1">Anyone can apply for a loan</div>
          <div class="body mt-3">One can apply a loan for various reason from  medical expenses , school fees , funeral expensive or you might be a business owner whose looking to finance his or her business. Tring to access funds from our banking system might not be difficult especially if you do not meet their document requirements such as proof of residence, conformation of employeement, bank statement etc.</div> 
            <div class="body mt-3">Our platform  allows anyone to apply for financing ,it connects borrowers and investors. A borrower will get a loan with the lowest interest rates bacause investors will be able to outbid each other on your loan request </div>    
                 </v-col>
             </v-row>
                 </v-card-text>
             </v-card>
                 <div class='mt-10'>
      <v-row>
         <v-col cols="12" md="6" offset-md="3"  class="text-center mt-10 ">
          <div class="display-1">How to borrow</div>
          <div class="body mt-3">An individual can easily borrow on our platform by following 6 easy steps</div>         
         </v-col>
      </v-row>
      <v-container class="mt-4">
       <v-row>
                <v-col cols="12" md="4">
                    <v-card 
                     class="green darken-4"
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
                     class="green darken-4"
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
                     class="green darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">3.</div>
                          <div class="headline mt-4">Create Loan Request</div>
                          <div class="mt-4">Fill in an online form input the amount required , repayment period and reason for loan</div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
              <v-row>
                <v-col cols="12" md="4">
                    <v-card 
                     class="green darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">4.</div>
                          <div class="headline mt-4">Collateral Details</div>
                          <div class="mt-4">Capture details and upload images of your collateral. Bring your collateral for physical evaluation</div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <v-card 
                     class="green darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">5.</div>
                          <div class="headline mt-4">Recieve Offer</div>
                          <div class="mt-4">Once your loan request has been published you will start to receive loan offers, accept the one you prefer</div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                     <v-card 
                     class="green darken-4"
                     dark>
                        <v-card-text class="text-center white--text">
                          <div class="display-3">6.</div>
                          <div class="headline mt-4">Withdraw Funds</div>
                          <div class="mt-4">Once you have accepted an offer it will be credited to your wallet and  you can initiate a cash withdrawal</div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" md="2" offset-md="5">
                    <inertia-link class="v-btn v-btn--block v-btn--outlined v-btn--rounded theme--light v-size--default" :href="$route('register')">Get Started</inertia-link>
                  
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

            return Math.round((this.amount + totalroi)/this.months)
        }
    }
}
</script>