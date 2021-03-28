<template>
<Layout title="Dashboard">
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
       <v-layout wrap>
           <v-flex sm3 xs12  class="pa-3">
               <v-card flat outlined>
                   <v-card-text>
                       <v-layout wrap>
                           <v-flex sm6 xs6 class="text-center">
                               <v-icon x-large color="light-blue darken-3">mdi-hand-heart</v-icon>
                           </v-flex>
                           <v-flex sm6 xs6 class="text-right">
                               <div>Total Deposits</div>
                              <div class="title">USD{{totalDeposits}}</div>
                           </v-flex>
                       </v-layout>

                   </v-card-text>
               </v-card>
           </v-flex>
           <v-flex sm3 xs12 class="pa-3">
                  <v-card flat outlined>
                   <v-card-text>
                       <v-layout wrap>
                           <v-flex sm6 xs6 class="text-center">
                               <v-icon x-large color="cyan lighten-1">mdi-handshake</v-icon>
                           </v-flex>
                           <v-flex sm6 xs6 class="text-right">
                               <div>Total Invested</div>
                              <div class="title">USD{{computeTotals().totalinvested}}</div>
                           </v-flex>
                       </v-layout>

                   </v-card-text>
               </v-card>
           </v-flex>
            <v-flex sm3 xs12 class="pa-3">
                   <v-card flat outlined>
                   <v-card-text>
                       <v-layout wrap>
                           <v-flex sm6 xs6 class="text-center">
                               <v-icon x-large color="purple darken-2">mdi-cash-multiple</v-icon>
                           </v-flex>
                           <v-flex sm6 xs6 class="text-right">
                               <div>ROI</div>
                              <div class="title">USD{{computeTotals().totalexpected-computeTotals().totalinvested}}</div>
                           </v-flex>
                       </v-layout>

                   </v-card-text>
               </v-card>
           </v-flex>
            <v-flex sm3 xs12 class="pa-3">
                <v-card flat outlined>
                   <v-card-text>
                       <v-layout wrap>
                           <v-flex sm6 xs6 class="text-center">
                               <v-icon x-large color="pink darken-1">mdi-wallet-outline</v-icon>
                           </v-flex>
                           <v-flex sm6 xs6 class="text-right">
                               <div>Wallet</div>
                              <div class="title">${{balance}}</div>
                           </v-flex>
                       </v-layout>
                   </v-card-text>

               </v-card>
           </v-flex>
       </v-layout>

       <v-row class="pa-3">
        <v-col md="12" >
            <v-card flat outlined>
                <v-app-bar color="blue" flat>
                    <v-toolbar-title class="white--text">My Loans</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default white--text" :href="$route('loanApplication.create')">Request Loan</inertia-link>

                </v-app-bar>
                <v-card-text>
                    <div v-if="loans.length>0">
                    <div v-for="loan in loans" :key="loan.id">
                  <v-row class="pt-2 pb-2">

                      <v-col cols="6" sm="2">
                          <div><small>Total Required</small></div>
                          <div class="black--text">{{loan.currency.name}}{{loan.amount}}</div>
                      </v-col>
                      <v-col cols="6" sm="2">
                          <div><small>Total Funded</small></div>
                          <div class="black--text">{{loan.currency.name}} {{totalFunded(loan.offers)}}</div>
                      </v-col>
                      <v-col cols="6" sm="2">
                          <div><small>Period</small></div>
                          <div class="black--text">{{loan.repaymentperiod.name}}</div>
                      </v-col>
                      <v-col cols="6" sm="2" class="text-center">
                          <div><small>Status</small></div>
                          <div class="black--text"><small>{{loan.status}}</small></div>
                      </v-col>
                      <v-col cols="12" sm="2" class="text-center">
                          <div><small>Offers</small></div>
                          <div> {{loan.offers.length}}</div>
                      </v-col>
                      <v-col cols="12" sm="2" class="text-center pa-3">
                          <div><inertia-link class="deep-purple darken-1 white--text v-btn v-btn--has-bg theme--light v-size--small" :href="$route('loanApplication.edit',loan.id)">View Offers</inertia-link>  </div>

                      </v-col>
                  </v-row>
                        <v-divider></v-divider>
                    </div>
                    </div>
                    <div v-else>
                        <p class="pa-6 red--text red lighten-5 text-center">
                          You haven't applied for a loan as yet
                        </p>
                    </div>
                </v-card-text>
            </v-card>
        </v-col>
       </v-row>

           <v-row class="pa-3">
        <v-col md="12" >
            <v-card flat outlined>
                <v-app-bar color="success" flat>
                    <v-toolbar-title class="white--text">My Investments</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default white--text" :href="$route('borrowers.index')">Borrowers list</inertia-link>

                </v-app-bar>
                <v-card-text>
                    <div v-if="offers.length >0">
                        <v-simple-table>
                            <thead>
                            <tr>
                                <th>Amount</th>
                                <th>Rate</th>
                                <th>Repayment Period</th>
                                <th>Total ROI</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="offer in offers" :key="offer.id">
                                <td>USD{{offer.amount}}</td>
                                <td>{{offer.percentage}}%</td>
                                <td>{{offer.loan.repaymentperiod.name}}</td>
                                <td>USD{{calculate(offer.amount,offer.loan.repaymentperiod.value,offer.percentage)}}</td>
                                <td><v-chip :class="`${offer.status}`" small>{{offer.status}}</v-chip></td>
                                <th>

                                </th>
                            </tr>
                            </tbody>
                        </v-simple-table>
                    </div>
                    <div v-else>
                        <p class="pa-6 red--text red lighten-5 text-center">
                            No Investment as yet
                        </p>
                    </div>
                </v-card-text>
            </v-card>
        </v-col>
       </v-row>

    </v-container>
</Layout>
</template>
<script>
import Layout from '../layouts/users'
export default {
    props:['successMessage','errorMessage','loans','totalDeposits','balance','offers'],
   components:{
       Layout
   },methods:{
        calculate(amount,period,rate){
           return Math.round(amount*(rate/100)*period)
        },totalFunded(offers){
            var total = 0;
            if(offers.length >0) {
                offers.forEach((offer) => {
                    if (offer.status === 'ACCEPTED') {
                        total = total + offer.amount
                    }
                })
            }
            return total
        },
        computeTotals(){
            var totalexpected = 0
            var totalinvested=0
            var totalpaid =0
           this.offers.forEach((offer)=>{
               if(offer.status === 'ACCEPTED') {
                   totalinvested = Math.round(totalinvested) + Math.round(offer.amount)
                   offer.installments.forEach((install) => {
                       totalexpected = Math.round(totalexpected) + Math.round(install.amount)
                       install.repayments.forEach((repay) => {
                           totalpaid = Math.round(totalpaid) + Math.round(repay.amount)
                       })
                   })
               }
            })


            return {totalexpected: totalexpected,totalpaid:totalpaid,totalinvested:totalinvested}
        }
    }
}
</script>
<style scoped>
.ACCEPTED{
    color: green;
}
.PENDING{
    color: red;
}
.loan.AWAITING{
    border-left: 4px solid #d38014;
}
.loan.ACTIVE{
    border-left: 4px solid #1E88E5;
}
.loan.PAID{
    border-left: 4px solid #43A047;
}
.status.AWAITING{
 color: #ffffff;
    background-color: #d38014 ;
}
.status.ACTIVE{
 color: #1E88E5;
}
.status.PAID{
    color: #43A047;
}
</style>
