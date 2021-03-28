<template>
    <Layout title="Borrowers List">
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
                            <v-toolbar-title class="white--text">Borrowers List</v-toolbar-title>
                            <v-spacer></v-spacer>

                        </v-app-bar>
                        <v-card-text>
                            <div v-if="loans.length>0">
                                <div v-for="loan in loans" :key="loan.id">
                                    <v-row class="pt-2 pb-2">
                                        <v-col cols="12" sm="3"  :class="`pa-3 loan ${loan.status}`">
                                            <div><small>Purpose</small></div>
                                            <div class="black--text">{{loan.reason}}</div>
                                        </v-col>
                                        <v-col cols="6" sm="2">
                                            <div><small>Total Required</small></div>
                                            <div class="black--text">{{loan.currency.name}}{{loan.amount}}</div>
                                        </v-col>
                                        <v-col cols="6" sm="2">
                                            <div><small>Total Funded</small></div>
                                            <div class="black--text">{{loan.currency.name}} 0</div>
                                        </v-col>
                                        <v-col cols="6" sm="2">
                                            <div><small>Repayment Period</small></div>
                                            <div class="black--text">{{loan.repaymentperiod.name}}</div>
                                        </v-col>
                                        <v-col cols="12" sm="1" class="text-center">
                                            <div><small>Offers</small></div>
                                            <div> <v-chip>{{loan.offers.length}}</v-chip></div>
                                        </v-col>
                                        <v-col cols="12" sm="2" class="text-center">
                                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small green--text" :href="$route('borrowers.show',loan.id)">View</inertia-link>

                                        </v-col>
                                    </v-row>
                                    <v-divider></v-divider>
                                </div>

                            </div>
                            <div v-else>
                                <v-alert
                                    text
                                    prominent
                                    type="error"
                                    icon="mdi-cloud-alert"
                                >
                                   No Borrowers Found
                                </v-alert>
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
    props:['successMessage','errorMessage','loans'],
    components:{
        Layout
    }
}
</script>

