<template>
    <Layout title="Assign Modules">
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
                <v-col md="12">
                    <v-card flat outlined>
                        <v-app-bar color="blue">
                            <v-toolbar-title class="white--text">{{ role.name }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default white--text" :href="$route('assign.edit',role.id)">Assign Module</inertia-link>

                        </v-app-bar>
                        <v-card-text>
                            <div v-if="role.modules.length>0">
                                <div v-for="module in role.modules" :key="module.id">
                                    <v-row class="pa-3">

                                        <v-col cols="6" sm="4">
                                            <div class="black--text">{{module.name}}</div>
                                        </v-col>
                                        <v-col cols="6" sm="4">
                                            <div class="black--text"><v-icon>{{module.icon}}</v-icon></div>
                                        </v-col>
                                        <v-col cols="6" sm="4" class="text-center">
                                           <v-btn rounded small outlined color="red" :loading="loading" :disabled="loading" @click="unassign(module.id)">unassing</v-btn>
                                        </v-col>
                                    </v-row>
                                    <v-divider></v-divider>
                                </div>
                            </div>
                            <div v-else>
                                <v-alert
                                    text
                                    prominent
                                    type="error"
                                    icon="mdi-cloud-alert"
                                >
                                    No Modules Found
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
import Layout from '../../../layouts/users'
export default {
    props:['successMessage','errorMessage','role'],
    data(){
       return{
           loading:false
       }
    },
    components:{
        Layout
    },methods:{
        unassign(id){
            var data ={module:id,role:this.role.id}
            this.loading = true;
            this.$inertia.put('/dashboard/assign/'+this.role.id,data).then(()=>{
                this.loading = false
            })

        }
    }
}
</script>

