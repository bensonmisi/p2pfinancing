<template>
    <v-app id="inspire">
        <v-container>
            <v-row>
                <v-col md="8" offset-md="2">
                    <v-card outlined flat>
                        <v-card-text>
                            <v-row>
                                <v-col md="8" offset-md="2" class="text-center">
                                    <v-img src="/img/logo.jpg" width="400"></v-img>
                                </v-col>

                            </v-row>
                            <v-divider></v-divider>
                            <p class="headline text-center mt-3 mb-3">Letter of collection </p>
                            <v-simple-table>
                                <tbody>
                                <tr>
                                    <th> Collector Name:</th>
                                    <td> <b>{{withdraw.collector_name}}</b> <b>{{withdraw.collector_surname}}</b></td>
                                </tr>
                                <tr>
                                    <th>Collector National ID :</th>
                                    <td>  {{withdraw.collector_natid}}</td>
                                </tr>
                                <tr>
                                    <th>Collection Code</th>
                                    <td>  {{withdraw.collection_code}}</td>
                                </tr>
                                <tr>
                                    <th>Collection Date</th>
                                    <td>{{withdraw.updated_at}}</td>
                                </tr>
                                <tr>
                                    <th>Amount Collected</th>
                                    <td>USD{{withdraw.amount}}</td>
                                </tr>
                                </tbody>
                            </v-simple-table>

                            <v-row class="mt-8">
                                <v-col md="6">
                                   <v-card outlined>
                                       <v-card-text>
                                           <div class="pa-10">
                                               <div class="headline grey--text text-center">SIGNATURE</div>
                                           </div>

                                       </v-card-text>
                                   </v-card>
                                </v-col>
                                <v-col md="6">
                                    <v-card outlined>
                                        <v-card-text>
                                            <div class="pa-10 text-center">
                                                <div class="headline grey--text">STAMP</div>
                                            </div>

                                        </v-card-text>
                                    </v-card>
                                </v-col>
                            </v-row>





                        </v-card-text>
                    </v-card>
                    <inertia-link :href="$route('dashboard')">Back</inertia-link>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props:['withdraw']
}
</script>

<style scoped>

</style>
