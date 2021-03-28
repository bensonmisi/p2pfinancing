<template>
    <Layout title="Cash Disbursement">
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
                <v-col cols="12" md="8" offset-md="2">
                    <v-card>
                        <v-card-title>Confirm Collector</v-card-title>
                        <v-card-text>
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
                        </v-card-text>
                        <v-card-actions>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('disbursement.create')">Cancel</inertia-link>
                            <v-spacer></v-spacer>
                             <v-btn outlined rounded color="green" @click="submit">Confirm</v-btn>
                        </v-card-actions>
                    </v-card>

                </v-col>
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../layouts/users'
export default {
    props:['successMessage','errorMessage','withdraw'],
    components:{
        Layout
    },data(){
        return{
            loading:false,
        }
    },methods:{
        submit(){

                this.loading= true
                var data = {id:this.withdraw.id}
                this.$inertia.patch('/dashboard/disbursement/'+this.withdraw.id,data).then(()=>{
                    this.loading= false
                })

        }
    }
}
</script>
