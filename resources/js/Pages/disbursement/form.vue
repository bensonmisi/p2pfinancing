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
                <v-col cols="12" md="10" offset-md="1">
                    <v-form v-model="form" ref="form" lazy-validation>
                        <v-card flat outlined>
                            <v-app-bar color="blue">
                                <v-toolbar-title class="white--text">Cash Disbursement</v-toolbar-title>
                            </v-app-bar>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="natID"
                                            label="National ID Required"
                                            outlined
                                            :rules="natIDRules"
                                        >
                                        </v-text-field>
                                    </v-col>
                                </v-row>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="code"
                                            label="Collection Code"
                                            outlined
                                            :rules="codeRules"
                                        >
                                        </v-text-field>
                                    </v-col>

                                </v-row>
                            </v-card-text>
                            <v-card-actions>
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
    props:['successMessage','errorMessage'],
    components:{
        Layout
    },data(){
        return{
            natID:'',
            natIDRules:[v => !!v || 'National ID required'],
            code:'',
            codeRules:[v => !!v || 'Collection Code required'],
            loading:false,
        }
    },methods:{
        submit(){
            if(this.$refs.form.validate()){
                this.loading= true
                var data = {natID:this.natID,code:this.code}
                this.$inertia.post('/dashboard/disbursement',data).then(()=>{
                    this.loading= false
                })
            }
        }
    }
}
</script>

