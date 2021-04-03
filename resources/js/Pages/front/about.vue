<template>
     <welcomeLayout title="About">
         <div>
         <v-container>
             <v-card>
                 <v-card-text>
                     <div class="d-flex">
                        <div><inertia-link :href="$route('welcome')">Home</inertia-link></div><div class="ml-3">></div><div class="ml-3">About P2P</div>
                     </div>
                 </v-card-text>
             </v-card>
             <v-card class="mt-3" flat>
                 <v-card-text>
                  <v-row>
                      <v-col cols="12">
                       <div class="headline"> What is Peer to Peer Financing ?</div>
                       <div class="body-1 mt-2">
                           In a country like Zimbabwe where 90% of the population is in the informal sector funding can be hard to find, as they cannot meet the requirements of formal financial institutions. 
Peer to Peer financing  is the process of lending money to individuals or businesses through our platforms. Anyone can become a lender and earn interest paid by the individual or business who has accepted thier loan offers.
                       </div>
                       <div class="body-1 mt-3">

Peer to peer platform is taking the banking model and revamping it entirely to create a favorable lending and borrowing climate. Peer to peer platforms function completely online, hence lenders can earn a higher rate of interest on their investments and the borrowers can get better rates.
                       </div>
                      </v-col>
                  </v-row>
                  <v-row>
                      <v-col cols="12">
                       <div class="headline"> How does Peer to Peer Lending work?</div>
                       <div class="body-1 mt-2">
An individual or business who is looking for a loan goes to a P2P platforms like p2pfinancing to borrow money. They upload their collateral, once their collateral is vetting ,verified ownership authenticity their loan request is approved and listed. Individual  lenders can look at the loan request, view the collateral that the borrower has forwarded and read the evaluation report on the collateral liquidability written by our team of evaluators, they can make loan offers with  amount and interest rate to that borrower.
                       </div>
                       <div class="body-1 mt-3">
 The borrower can the look at  offers  and choose the one that best suits them. If the borrower accepts an offer they will bring  their collateral and collect funds. Once a borrower collect funds our platform will automatically calculate repayment  dates and amounts every month. These repayments cover principal and interest which the lenders receive.
                       </div>
                      </v-col>
                      
                  </v-row>
                  <v-row>
                      <v-col cols="12">
                       <div class="headline"> Is P2P Financing a Pyramid Scheme ?</div>
                       <div class="body-1 mt-2">
                       The world (Zimbabwe included) has been hit by several pyramid schemes that promises people fast riches and quick returns  only to collapse and dupe people of thier hard earned money. P2P financing  is nothing close to a  pyramid scheme as it adopts a routine that has been part of our culture for a longtime, Growing up if a mother borrowed mealie meal from their neighbour  they were given in a container, when the mother returns the container she has to return it with the mealie meal hard pressed and running over.
                       This is the same concept that we are automating  when a person or business requires financial aid our platform connects  him or her to people who are not known to him or her in order quickly get help. In order to protect the helper we will require the borrower to offer some collateral  as an assurance that they will pay back.
                       Our platform connect real people with real financial needs
                       </div>
                      </v-col>
                  </v-row>
                  <v-row>
                      <v-col cols="12">
                       <div class="headline"> Is investing on our platform safe?</div>
                       <div class="body-1 mt-2">
                          Like all other investment schemes peer to peer financing has its own risks. The major one being of borrowers default on ther repayments, we have however tried to minimize that risk, by making the borrower sign  all the legal paperwork that will allow us to liquidate thier collateral in order to  cover investors  money
                       </div>
                      </v-col>
                  </v-row>

                  
                          <v-sheet height="200" color="primary" class="mt-5 pa-10 white--text">
                              <v-row>
                                <v-col cols="12" md="6" class="text-center" offset-md="3">
                                    <div class="headline">Get started today and start earning </div>
                                    <div class="body-2 mt-2">Our platform guarantees borrowers the lowest interest rates and lenders the highest return on investment</div>
                                    <div><inertia-link :href="$route('register')" class="white--text mt-3 v-btn v-btn--outlined v-btn--rounded theme--light v-size--default">Get Started</inertia-link></div>
                                </v-col>
                            </v-row>
                          </v-sheet>
                      
                 </v-card-text>
             </v-card>
         </v-container>
         </div>
     </welcomeLayout>
</template>
<script>
import  welcomeLayout  from '../Layout'
export default {
 components:{
  welcomeLayout
 }

}
</script>