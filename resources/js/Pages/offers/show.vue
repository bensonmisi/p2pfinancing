<template xmlns="http://www.w3.org/1999/html">
    <Layout title="Make offer">
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
            <v-row>
                <v-col cols="10" offset-md="1">
                    <v-card>
                        <v-card-text>
                            <inertia-link :href="$route('dashboard')">Dashboard</inertia-link> / Offers
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <v-row class="pa-3">
                <v-col cols="12" md="10" offset-md="1">
                   <v-card>
                       <v-card-title>
                           <div class="headline">Amount Required</div>
                           <v-spacer></v-spacer>
                           <v-chip>USD{{balance}}</v-chip>
                       </v-card-title>
                       <v-divider></v-divider>
                       <v-card-text>
                    <div v-if="offers.length >0">
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
                            <tr v-for="offer in offers" :key="offer.id">
                                <td>USD{{offer.amount}}</td>
                                <td>{{offer.percentage}}%</td>
                                <td><v-chip color="warning" small>{{offer.status}}</v-chip></td>
                                <td>
                                    <div v-if="offer.status=='PENDING'">
                                        <v-btn rounded color="success" @click="submitData('ACCEPTED',offer.id)" :loading="loading" :disabled="loading">ACCEPT</v-btn>   <v-btn rounded color="error" @click="submit('DECLINE',offer.id)" :loading="loading" :disabled="loading">DECLINE</v-btn>
                                    </div>
                                </td>
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
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../layouts/users'
export default {
    props:['successMessage','errorMessage','offers','balance'],
    components:{
        Layout
    },data(){
        return{
            amount:'',
            loading:false
        }
    },methods:{
        submitData(status,id){
            var data = {status:status,id:id}
            this.loading = true
            this.$inertia.patch('/dashboard/offers/1',data).then(()=>{
              this.loading=false
            })
        }
    }
}
</script>

