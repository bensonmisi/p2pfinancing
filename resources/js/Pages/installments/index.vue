<template>
    <Layout title="My Loan Repayment">
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
                <v-col md="12">
                    <v-card flat outlined>

                        <v-card-text class="pa-2">
                            <v-card class="mt-5">
                                    <v-app-bar flat>
                                        <v-toolbar-title>
                                            My Loan Installments
                                        </v-toolbar-title>
                                        <v-spacer></v-spacer>
                                    </v-app-bar>
                                    <v-card-text>
                                        <div v-if="installments.length >0">
                                            <v-simple-table>
                                                <thead>
                                                <tr>
                                                    <th>Expected Date</th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Paid
                                                    </th>
                                                    <th>
                                                        Balance
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="installment in installments" :key="installment.id">
                                                    <td>{{installment.expected_date | formatDate}}</td>
                                                    <td class="blue--text">USD {{installment.amount}}</td>
                                                    <td class="green--text">USD {{installment.paid}}</td>
                                                    <td class="red--text">USD {{computeBalance(installment.amount,installment.paid)}}</td>
                                                    <td>
                                                        <div v-if="computeBalance(installment.amount,installment.paid)">
                                                            <p class="red--text pt-2" v-if="installment.repayment_status">{{installment.repayment_status}}</p>
                                                        </div>
                                                        <div v-else>
                                                            <p class="green--text pt-2">PAID</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </v-simple-table>
                                        </div>
                                        <div v-else>
                                            <p class="pa-10 red lighten-5 red--text text-center">
                                                No Installments found as yet
                                            </p>

                                        </div>
                                    </v-card-text>
                                </v-card>


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
    props:['successMessage','errorMessage','installments'],
    components:{
        Layout
    },
    data(){
        return{
        }
    },methods:{
        computeBalance(amount,paid){
            return amount-paid
        }
    }
}
</script>

