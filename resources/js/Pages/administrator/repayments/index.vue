<template>
    <Layout title="Loan Repayment">
        <v-container>
            <div class="pa-3">
                <v-alert
                    type="error"
                    v-if="errorMessage"
                >
                    {{errorMessage}}
                </v-alert>
                <v-alert
                    type="error"
                    v-if="errors.email"
                >
                    {{errors.email}}
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
                            <v-form ref="searchForm" v-model="isValid" lazy-validation>
                                <v-row>
                                    <v-col  cols="10">
                                        <v-text-field outlined label="Enter Email Address" v-model="email" :rules="emailRule"></v-text-field>
                                    </v-col>
                                    <v-col cols="2" class="pa-5">
                                        <v-btn outlined rounded color="green" :loading="loading" :disabled="loading" @click="search">Search</v-btn>
                                    </v-col>
                                </v-row>
                            </v-form>

                            <div v-if="client">
                                <v-simple-table>
                                    <tbody>
                                    <tr><th>Name</th><td>{{client.name}}</td></tr>
                                    <tr><th>Surname</th><td>{{client.surname}}</td></tr>
                                    <tr><th>Email</th><td>{{client.email}}</td></tr>
                                    <tr><th>Phone</th><td>{{client.mobile}}</td></tr>
                                    <tr><th>City</th><td>{{client.city}}</td></tr>
                                    <tr><th>Country</th><td>{{client.country}}</td></tr>
                                    </tbody>
                                </v-simple-table>

                                <v-card class="mt-5">
                                    <v-app-bar flat>
                                        <v-toolbar-title>
                                            Loan Installments
                                        </v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        <v-btn outlined rounded small @click="paymentModel=true">Make Payment</v-btn>

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
                            </div>

                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <v-dialog v-model="paymentModel" width="500px">
                <v-form ref="form" v-model="form" lazy-validation>
                    <v-card>
                        <v-app-bar>
                            <v-toolbar-title>Loan Repayment</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon><v-icon>mdi-close</v-icon></v-btn>
                        </v-app-bar>
                        <v-card-text class="pa-3">
                            <v-text-field outlined label="Amount" v-model="amount" :rules="amountRule"></v-text-field>
                        </v-card-text>

                        <v-card-actions>
                            <v-btn outlined rounded color="red">Cancel</v-btn>
                            <v-spacer></v-spacer>
                            <v-btn outlined rounded color="green" :loading="loading" :disabled="loading" @click="submit">Submit</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-form>
            </v-dialog>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../../layouts/users'
export default {
    props:['successMessage','errorMessage','installments','errors','client'],
    components:{
        Layout
    },
    data(){
        return{
            email:'',
            emailRule:[v => !!v || ' Enter email address'],
            isValid:true,
            loading:false,
            paymentModel:false,
            form:true,
            amount:'',
            amountRule:[v => !!v || ' Enter amount']
        }
    },methods:{
        search(){
            if(this.$refs.searchForm.validate()){
                this.loading=true
                var data ={email:this.email}
                this.$inertia.post('/dashboard/repayments',data).then(()=>{
                    this.loading = false
                })
            }
        },submit(){
            if(this.$refs.form.validate()){
                this.loading = true;
                var data ={user:this.client.id,amount:this.amount}
                this.$inertia.put('/dashboard/repayments/1',data).then(()=>{
                    this.loading=false
                    this.paymentFormModel=false
                })
            }
        },
        computeBalance(amount,paid){
            return amount-paid
        }
    }
}
</script>

