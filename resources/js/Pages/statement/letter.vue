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
                            <p><b>Dear {{user.name}} {{user.surname}}</b></p>
                            <p>Your withdrawal request was successfully initiated please visit an agent nearest to you and collect your cash </p>
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
                                     <td>{{withdraw.collection_date}}</td>
                                 </tr>
                                 <tr>
                                     <th>Amount</th>
                                     <td>USD{{withdraw.amount}}</td>
                                 </tr>
                                 </tbody>
                             </v-simple-table>
                            <p class="red--text pa-3">
                                PLEASE NOTE THE ABOVE MENTIONED PERSON IS NOW THE ONLY PERSON AUTHORIZED TO COLLECT THOSE FUNDS.PLEASE SEND THEM THE COLLECTION CODE. THEY SHOULD BRING THEIR NATIONAL ID ON THE COLLECTION DATE SPECIFIED

                            </p>

                            <v-divider></v-divider>



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
    props:['withdraw','user']
}
</script>

<style scoped>

</style>
