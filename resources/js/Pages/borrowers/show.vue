<template>
    <Layout title="Show loan">
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

            <v-row class="pa-1">
                <v-col cols="12" sm="6">

                    <v-card flat outlined class="mt-5">
                        <v-app-bar flat>
                            <v-toolbar-title>
                                <div class="headline">Loan Information</div>
                            </v-toolbar-title>
                        </v-app-bar>

                        <v-card-text>
                            <v-simple-table>
                                <tbody>
                                <tr>
                                    <th>
                                        Amount Required
                                    </th>
                                    <td>
                                        USD{{loan.amount}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                       0% Funded
                                    </th>
                                    <td>
                                        USD 0
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Collateral Type
                                    </th>
                                    <td>
                                        {{loan.collateral.type.name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Reason
                                    </th>
                                    <td>
                                        {{loan.reason}}
                                    </td>
                                </tr>
                                </tbody>
                            </v-simple-table>
                        </v-card-text>
                    </v-card>
                    <v-card flat outlined class="mt-5">
                        <v-app-bar flat>
                            <v-toolbar-title>
                                <div class="headline">Offers</div>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <inertia-link :href="$route('offers.show',loan.id)"  class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small green--text">Make Offer</inertia-link>
                        </v-app-bar>

                        <v-card-text>
                            <div v-if="loan.offers.length >0">
                            <v-simple-table>
                                <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="offer in loan.offers" :key="loan.id">
                                    <td>USD{{offer.amount}}</td>
                                    <td>{{offer.percentage}}%</td>
                                    <td><v-chip color="warning" small>{{offer.status}}</v-chip></td>
                                    <th>
                                        <div v-if="offer.user_id ==user.id">
                                            <inertia-link :href="$route('offers.edit',offer.id)"><v-icon>mdi-pencil</v-icon></inertia-link>
                                        </div>
                                    </th>
                                </tr>
                                </tbody>
                            </v-simple-table>
                            </div>
                            <div v-else>
                                <p class="pa-6 red--text red lighten-5 text-center">
                                    No Offers as yet
                                </p>
                            </div>

                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" sm="6">
                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                    <v-toolbar-title>Collateral Details</v-toolbar-title>
                                </v-app-bar>
                                <v-card-text>
                                    <v-carousel height="300">
                                        <v-carousel-item
                                            v-for="(item,i) in loan.collateral.images"
                                            :key="i"

                                            :src="computeImage(item.image)"
                                            reverse-transition="fade-transition"
                                            transition="fade-transition"
                                        ></v-carousel-item>
                                    </v-carousel>
                                    <v-simple-table>
                                        <tbody>
                                        <tr v-if="loan.collateral.properties.make">
                                            <th>Make</th>
                                            <td>{{loan.collateral.properties.make}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.model">
                                            <th>Model</th>
                                            <td>{{loan.collateral.properties.model}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.year">
                                            <th>Manufacture Year</th>
                                            <td>{{loan.collateral.properties.year}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.fuel">
                                            <th>Fuel Type</th>
                                            <td>{{loan.collateral.properties.fuel}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.brand">
                                            <th>Brand</th>
                                            <td>{{loan.collateral.properties.brand}}</td>
                                        </tr>
                                        <tr  v-if="loan.collateral.properties.make">
                                            <th>Engine</th>
                                            <td>{{loan.collateral.properties.engine}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.mileage">
                                            <th>Mileage</th>
                                            <td>{{loan.collateral.properties.mileage}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.bodytype">
                                            <th>Body Type</th>
                                            <td>{{loan.collateral.properties.bodytype}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.condition">
                                            <th>Ownership period</th>
                                            <td>{{loan.collateral.properties.condition}}</td>
                                        </tr>
                                        </tbody>
                                    </v-simple-table>
                                </v-card-text>
                            </v-card>

                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                    <v-toolbar-title>Collateral Evaluation Report</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                  </v-app-bar>
                                <v-card-text>
                                    <div v-if="loan.collateral.report">
                                        <v-simple-table>
                                            <thead>
                                            <tr>
                                                <th>Market Value</th><td>USD {{loan.collateral.report.market_value}}</td>
                                            </tr>
                                            <tr>
                                                <th>Comment</th><td>{{loan.collateral.report.market_value_comment}}</td>
                                            </tr>
                                            <tr>
                                                <th>liquidatable Score</th><td>{{loan.collateral.report.liquidatable_score}} %</td>
                                            </tr>
                                            <tr>
                                                <th>liquidatable Comment</th><td>{{loan.collateral.report.liquidatable_comment}}</td>
                                            </tr>
                                            <tr><th>Condition</th><td>{{loan.collateral.report.state}}</td></tr>
                                            <tr><th>Comment</th><td>{{loan.collateral.report.state_comment}}</td></tr>
                                            <tr><th>Ownership</th><td>{{loan.collateral.report.ownership}}</td></tr>
                                            <tr><th>Comment</th><td>{{loan.collateral.report.ownership_comment}}</td></tr>
                                            </thead>
                                        </v-simple-table>
                                    </div>
                                    <div v-else>
                                        <v-alert
                                            prominent
                                            type="error"
                                        >
                                            <v-row align="center">
                                                <v-col class="grow">
                                                    No Evaluation report added as yet
                                                </v-col>

                                            </v-row>
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
    props:['successMessage','errorMessage','loan','user'],
    components:{
        Layout
    },data(){
        return{
            validform:true,
            loading:false
        }
    },methods:{

        computeImage(image){
            return '/'+image;
        }
    }
}
</script>

