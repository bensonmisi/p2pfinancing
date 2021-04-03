<template>
  <welcomeLayout title="p2pfinancing">
      <v-carousel  hide-delimiters  :show-arrows="false" continuous cycle>
          <v-carousel-item
              :src="slide1"
              reverse-transition="fade-transition"
      transition="fade-transition"
          >
          <v-row class="pa-5">
              <v-col cols="12" md="4" class="slide-content text-center">
          <div class="display-2">
            Grow your portifolio by giving others nano loans
          </div>
          <div class="headline mt-4">Earn between 10-25% for loans you offer over a period of 3 months</div>
           <div>
               <inertia-link :href="$route('investing')" class="mt-2 v-btn v-btn--outlined v-btn--rounded theme--dark v-size--default white--text">Learn How</inertia-link>
             
          </div>
              </v-col>
        </v-row>
          </v-carousel-item>
          <v-carousel-item
              :src="slide2"
              reverse-transition="fade-transition"
               transition="fade-transition"
          >
           <v-row class="pa-5">
              <v-col cols="12" md="4" class="slide-content text-center">
          <div class="display-2">
            Get loans easily with the lowest interest rate
          </div>
          <div class="headline mt-4">Get a loan for as low as  10-25% with little paper required</div>
          <div>
               <inertia-link :href="$route('borrowing')" class="mt-2 v-btn v-btn--outlined v-btn--rounded theme--dark v-size--default white--text">Learn How</inertia-link>
        
          </div>
              </v-col>
        </v-row>
          </v-carousel-item>
        
      </v-carousel>
      <v-row class="grey lighten-4">
          <v-col cols="12" class="pa-0">
      <v-container>
          
          <v-row class="pa-2">
             <v-col cols="12" md="3" class=" bdright">
                 
                       <div class="pa-4 text-center">
                       <div>

                       </div>
                       <div class="headline">USD {{invested}}</div>
                       <div>Invested</div>
                       
                       </div>
                 
                           
            </v-col> 
               <v-col cols="12" md="3" class="bdright">
                   <div class="pa-4 text-center">
                       <div>

                       </div>
                       <div class="headline">USD {{borrowed}}</div>
                       <div>Borrowered</div>
                       
                       </div>
                            
            </v-col>  
             <v-col cols="12" md="3" class="bdright">
                   <div class="pa-4 text-center">
                       <div>

                       </div>
                       <div class="headline">{{interests}}%</div>
                       <div>Avg Interest</div>
                       
                       </div>          
            </v-col>  
             <v-col cols="12" md="3">
                 <div class="pa-4 text-center">
                       <div>

                       </div>
                       <div class="headline">{{total}}</div>
                       <div>Accounts</div>
                       
                       </div>              
            </v-col>  
          </v-row>
      </v-container>
          </v-col>
      </v-row>
      <v-row class='mt-10'>
          <v-col cols="12" md="6" offset-md="3" class="text-center">
              <div class="display-1">What is P2P financing</div>
              <div class="mt-3">
                  Peer-to-peer (P2P) financing enables individuals to obtain loans directly from other individuals, cutting out the financial institution as the middleman.This will result in borrowers getting loans with the lowest interest rates and investors  getting a higher return on investment as the parties will agree on the rates. Our platforms connects borrowers directly to investors.
              </div>
              <div>
                  <inertia-link :href="$route('about')" class="v-btn v-btn--has-bg v-btn--rounded theme--light v-size--default success">Learn how</inertia-link>
                  
              </div>
          </v-col>
      </v-row>
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
                    <inertia-link class="v-btn v-btn--block v-btn--outlined v-btn--rounded theme--light v-size--default" :href="$route('register')">Get Started</inertia-link>
                
                </v-col>
            </v-row>
      </v-container>
      </div>
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
  </welcomeLayout>
</template>

<script>
import  welcomeLayout  from '../Layout'
export default {
    props:['invested','borrowed','interests','accounts','total'],
 components:{
  welcomeLayout
 },
    data(){
     return{
         items: [
             {
                 src: 'img/slide1.jpg',
             },
             {
                 src: 'img/slide2.jpg',
             },
             {
                 src: 'img/mobile1.jpg',
             }
         ],
     }
    },computed:{
        slide1(){
              switch (this.$vuetify.breakpoint.name)
               {
                case 'xs': return 'img/mobile1.jpg'
                case 'sm': return 'img/mobile1.jpg'
                case 'md': return 'img/mobile1.jpg'
                case 'lg': return 'img/slide1.jpg'
                case 'xl': return  'img/slide1.jpg'
                }
          },
          slide2(){
              switch (this.$vuetify.breakpoint.name)
               {
                case 'xs': return 'img/mobile2.jpg'
                case 'sm': return 'img/mobile2.jpg'
                case 'md': return 'img/mobile2.jpg'
                case 'lg': return 'img/slide2.jpg'
                case 'xl': return  'img/slide2.jpg'
                }
          }
    }
}
</script>

<style scoped>
  .slide-content{
      margin-top: 100px;

  }.bdright{
      border-right: 1px solid rgb(207, 207, 207);    
  }.icon-size{
      width: 100px;
  }
</style>
