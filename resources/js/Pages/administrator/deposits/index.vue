<template>
    <Layout title="Cash Deposits">
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

                            <div v-if="result">
                               <v-simple-table>
                                   <tbody>
                                   <tr><th>Name</th><td>{{result.name}}</td></tr>
                                   <tr><th>Surname</th><td>{{result.surname}}</td></tr>
                                   <tr><th>Email</th><td>{{result.email}}</td></tr>
                                   <tr><th>Phone</th><td>{{result.mobile}}</td></tr>
                                   <tr><th>City</th><td>{{result.city}}</td></tr>
                                   <tr><th>Country</th><td>{{result.country}}</td></tr>
                                   </tbody>
                               </v-simple-table>

                                <v-card class="mt-5">
                                    <v-app-bar flat>
                                        <v-toolbar-title>
                                            Users Deposits
                                        </v-toolbar-title>
                                        <v-spacer></v-spacer>
                                        <v-btn outlined rounded color="primary" @click="depositModel=true">New Deposit</v-btn>
                                    </v-app-bar>
                                    <v-card-text>
                                        <div v-if="result.deposits.length >0">
                                        <v-simple-table>
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Cashier</th>
                                                <th>
                                                    Amount
                                                </th>
                                                <th>
                                                    Charge
                                                </th>
                                                <th>
                                                    Balance
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="deposit in result.deposits" :key="deposit.id">
                                               <td>{{deposit.created_at | formatDate}}</td>
                                                <td>
                                                    <div>
                                                        {{deposit.cashier.name}} {{deposit.cashier.surname}}
                                                    </div>
                                                    <div>
                                                        <small>{{deposit.cashier.email}}</small>
                                                    </div>

                                                </td>
                                                <td class="blue--text">{{deposit.currency.name}}{{deposit.amount}}</td>
                                                <td class="red--text">{{deposit.currency.name}}{{deposit.charge}}</td>
                                                <td class="green--text">{{deposit.currency.name}}{{deposit.balance}}</td>
                                            </tr>
                                            </tbody>
                                        </v-simple-table>
                                        </div>
                                        <div v-else>
                                          <p class="pa-10 red lighten-5 red--text text-center">
                                                No Deposits found as yet
                                          </p>

                                        </div>
                                    </v-card-text>
                                </v-card>
                            </div>

                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <v-dialog v-model="depositModel" width="500px">
                <v-form ref="form" v-model="depositForm" lazy-validation>
                <v-card>
                    <v-app-bar>
                        <v-toolbar-title>Cash Deposit</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon><v-icon>mdi-close</v-icon></v-btn>
                    </v-app-bar>
                    <v-card-text class="pa-3">
                        <v-select outlined label="Select currency" :items="currencylist" item-value="id" item-text="name" v-model="currency" :rules="currencyRule"></v-select>
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
    props:['successMessage','errorMessage','result','errors','currencylist'],
    components:{
        Layout
    },
    data(){
        return{
            email:'',
            emailRule:[v => !!v || ' Enter email address'],
            isValid:true,
            loading:false,
            depositModel:false,
            depositForm:true,
            currency:'',
            currencyRule:[v => !!v || 'Select Currency'],
            amount:'',
            amountRule:[v => !!v || ' Enter amount']
        }
    },methods:{
        search(){
            if(this.$refs.searchForm.validate()){
                 this.loading=true
                  var data ={email:this.email}
                this.$inertia.post('/dashboard/deposits',data).then(()=>{
                    this.loading = false
                })
            }
        },submit(){
            if(this.$refs.form.validate()){
                this.loading = true;
                 var data ={user:this.result.id,amount:this.amount,currency:this.currency}
                this.$inertia.put('/dashboard/deposits/1',data).then(()=>{
                    this.loading=false
                    this.depositModel=false
                })
            }
        }
    }
}
</script>

