<template>
    <Layout title="Report">
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
                        <v-app-bar color="blue">
                            <v-toolbar-title class="white--text">Report</v-toolbar-title>
                            <v-spacer></v-spacer>
                           <v-btn outlined rounded small>Date Filter</v-btn>
                        </v-app-bar>
                        <v-card-text>
                            <v-tabs>
                                <v-tab href="#deposits">Deposits</v-tab>
                                <v-tab>Withdrawals</v-tab>
                                <v-tab>Investments</v-tab>

                                <v-tab-item id="deposits" key="deposits">
                                    <v-container fluid>
                                        <v-row>
                                            <v-col cols="12">
                                               <v-simple-table>
                                                   <thead>
                                                   <tr>
                                                       <th>Date</th>
                                                       <th> Amount </th>
                                                       <th> Charge</th>
                                                       <th> Agent</th>
                                                   </tr>
                                                   </thead>
                                                   <tbody>
                                                   <tr v-for ="deposit in data.deposits" :key="deposit.id">
                                                       <td>
                                                           {{deposit.created_at | formatDate }}
                                                       </td>
                                                       <td>
                                                          USD{{deposit.amount}}
                                                       </td>
                                                       <td>
                                                           USD{{deposit.charge}}
                                                       </td>
                                                       <td>
                                                           {{deposit.cashier.name}}{{deposit.cashier.surname}}
                                                       </td>
                                                   </tr>
                                                   </tbody>
                                               </v-simple-table>
                                            </v-col>
                                        </v-row>
                                    </v-container>
                                </v-tab-item>
                                    <v-tab-item>
                                        <v-container fluid>
                                            <v-row>
                                                <v-col cols="12">
                                                   Withdrawals
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-tab-item>
                                    <v-tab-item>
                                        <v-container fluid>
                                            <v-row>
                                                <v-col cols="12">
                                                   Investments
                                                </v-col>
                                            </v-row>
                                        </v-container>
                                    </v-tab-item>

                            </v-tabs>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../../layouts/users'
export default {
    props:['successMessage','errorMessage','data'],
    components:{
        Layout
    }
}
</script>

