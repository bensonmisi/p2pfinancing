<template>
    <Layout title="Update Role">
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
                <v-col cols="12" md="4" offset-md="4">
                    <v-form v-model="form" ref="form" lazy-validation>
                        <v-card flat outlined>
                            <v-app-bar color="blue">
                                <v-toolbar-title class="white--text">Update Role</v-toolbar-title>
                            </v-app-bar>
                            <v-card-text>
                                <v-row>
                                    <v-col cols="12">
                                        <v-text-field
                                            v-model="name"
                                            label="Name Required"
                                            outlined
                                            :rules="nameRules"
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
import Layout from '../../layouts/users'
export default {
    props:['successMessage','errorMessage','role'],
    components:{
        Layout
    },data(){
        return{
            name:this.role ? this.role.name :'',

            loading:false,
            nameRules:[v => !!v || 'Name is required']
        }
    },methods:{
        submit(){
            if(this.$refs.form.validate()){
                this.loading= true
                var data = {name:this.name,id:this.role.id}
                this.$inertia.post('/dashboard/roles',data).then(()=>{
                    this.loading= false
                })
            }
        }
    }
}
</script>

