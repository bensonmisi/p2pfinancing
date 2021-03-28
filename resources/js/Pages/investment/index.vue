<template xmlns="http://www.w3.org/1999/html">
    <Layout title="My Investments">
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
                <v-col cols="12" md="10" offset-md="1">
                    <v-card>
                        <v-app-bar color="primary"  flat>
                            <v-toolbar-title class="white--text">My Investments</v-toolbar-title>
                        </v-app-bar>
                        <v-card-text>
                            <div v-if="investments.length >0">
                            <v-simple-table>
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total Invested</th>
                                    <th>Expected Repayments</th>
                                    <th>Total Expected ROI</th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="invest in investments" :key="invest.id">
                                    <td>{{invest.created_at | formatDate}}</td>
                                    <td>USD{{invest.amount}}</td>
                                    <td>
                                        USD {{ computeTotals(invest.installments).totalexpected}}
                                    </td>
                                    <td>
                                       USD {{computeTotals(invest.installments).totalexpected -invest.amount }}
                                    </td>
                                </tr>
                                </tbody>
                            </v-simple-table>
                            </div>
                            <div v-else>
                                <p class="pa-10 red lighten-5 red--text text-center">
                                    No investments found as yet
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
    props:['successMessage','errorMessage','investments'],
    components:{
        Layout
    },data(){
        return{

        }
    },methods:{
      computeTotals(installments){
          var totalexpected = 0
          var totalpaid =0

          installments.forEach((install)=>{
              totalexpected =  Math.round(totalexpected) + Math.round(install.amount)
              install.repayments.forEach((repay)=>{
                  totalpaid = Math.round(totalpaid) +Math.round(repay.amount)
              })
          })

          return {totalexpected: totalexpected,totalpaid:totalpaid}
      }
    }
}
</script>

