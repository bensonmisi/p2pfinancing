<template>
    <Layout title="Withdrawal">
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
                    <v-form v-model="form" ref="form" lazy-validation>
                        <v-card flat outlined>
                            <v-app-bar color="blue">
                                <v-toolbar-title class="white--text">Cash Withdrawal</v-toolbar-title>
                                <v-spacer></v-spacer>
                                <div class="white--text text-right">
                                    <div><small>Wallet Balance: USD {{balance}}</small></div>
                                    <div v-if="amount"><small>Withdrawable USD {{balance - calculateCharge}}</small></div>
                                </div>
                            </v-app-bar>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="amount"
                                            label="Enter Amount"
                                            outlined
                                            type="number"
                                            :rules="amountRules"
                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-menu
                                            ref="menu"
                                            v-model="menu"
                                            :close-on-content-click="false"
                                            :return-value.sync="date"
                                            transition="scale-transition"
                                            offset-y
                                            min-width="auto"
                                        >
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-text-field
                                                    v-model="date"
                                                    label="Pick Date of Collection"
                                                    readonly
                                                    outlined
                                                    v-bind="attrs"
                                                    v-on="on"
                                                ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                v-model="date"
                                                no-title
                                                scrollable
                                            >
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="menu = false"
                                                >
                                                    Cancel
                                                </v-btn>
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="$refs.menu.save(date)"
                                                >
                                                    OK
                                                </v-btn>
                                            </v-date-picker>
                                        </v-menu>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="name"
                                            label="Collector Name"
                                            outlined
                                            :rules="nameRules"
                                        >
                                        </v-text-field>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="surname"
                                            label="Collector Surname"
                                            outlined
                                            :rules="surnameRules"
                                        >
                                        </v-text-field>
                                    </v-col>
                                    </v-row>
                                <v-row>
                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="phone"
                                            label="Collector Phone"
                                            outlined
                                            :rules="phoneRules"
                                        >
                                        </v-text-field>
                                    </v-col>

                                    <v-col cols="6">
                                        <v-text-field
                                            v-model="natid"
                                            label="Collector National ID"
                                            outlined
                                            :rules="natidRules"
                                        >
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                                <div v-if="amount">
                                <div v-if="amount>0 && calculateBalance >= 0">
                                <v-row>

                                    <v-col>
                                        <v-simple-table>
                                            <tbody>
                                            <tr class="blue--text">
                                                <th>Amount</th><td>USD${{amount}}</td>
                                            </tr>
                                            <tr class="red--text">
                                                <th>Withdrawal Charge</th><td>USD${{calculateCharge}}</td>
                                            </tr>
                                            <tr class="green--text">
                                                <th>Balance</th><td>USD${{calculateBalance}}</td>
                                            </tr>
                                            </tbody>
                                        </v-simple-table>
                                    </v-col>
                                </v-row>
                                </div>
                                <div v-else>
                                    <p class="pa-5 text-center red--text red lighten-5">
                                        Maximum withdrawable amount  is USD {{balance - calculateCharge}}
                                    </p>
                                </div>
                                </div>

                            </v-card-text>
                            <v-card-actions v-if="amount>0 && calculateBalance >= 0">
                                <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('roles.index')">Cancel</inertia-link>
                                <v-spacer></v-spacer>
                                <v-btn rounded outlined color="green" :loading="loading" :disabled="loading" @click="submit">Submit</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-form>
                </v-col>
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../layouts/users'
export default {
    props:['successMessage','errorMessage','balance','charge'],
    components:{
        Layout
    },data(){
        return{
            form:true,
            amount:'',
            loading:false,
            amountRules:[
                v=> !!v || 'Amount required',
                v => (v && v <= this.balance) || 'Amount must be less than or equal to '+this.balance
            ],
            nameRules:[v => !!v || 'Name is required'],
            surnameRules:[v => !!v || 'Name is required'],
            natidRules:[v => !!v || 'National ID required'],
            phoneRules:[v => !!v || 'National ID required'],
            date: '',
            menu: false,
            name:'',
            surname:'',
            phone:'',
            natid:'',

        }
    },methods:{
        submit(){
            if(this.$refs.form.validate()){
                this.loading= true
                var data = {amount:this.amount,collector_name:this.name,collector_surname:this.surname,collector_phone:this.phone,collector_natid:this.natid,collection_date:this.date}
                this.$inertia.post('/dashboard/statements',data).then(()=>{
                    this.loading= false
                })
            }
        }
    },computed:{
        calculateCharge(){
            var charge = Math.round(this.amount*(this.charge.percentage/100));
            return  charge > 0 ? charge : 1;
        },
        calculateBalance(){
            var amnt = Math.round(this.amount) + this.calculateCharge;
            return Math.round(this.balance)-amnt
        }
    }
}
</script>

