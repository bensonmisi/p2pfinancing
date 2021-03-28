<template>
    <Layout title="Add Module">
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
                            <v-toolbar-title class="white--text">Add Module</v-toolbar-title>
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
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="link"
                                        label="link Required"
                                        outlined
                                        :rules="linkRules"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="icon"
                                        label="icon Required"
                                        outlined
                                        :rules="iconRules"
                                    >
                                    </v-text-field>
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('modules.index')">Cancel</inertia-link>
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
    props:['successMessage','errorMessage'],
    components:{
        Layout
    },data(){
        return{
            name:'',
            loading:false,
            nameRules:[v => !!v || 'Name is required'],
            icon:'',
            iconRules:[v => !!v || 'Icon required'],
            link:'',
            linkRules:[v => !!v || 'Link required'],

        }
    },methods:{
        submit(){
             if(this.$refs.form.validate()){
                 this.loading= true
                 var data = {name:this.name,link:this.link,icon:this.icon}
                 this.$inertia.post('/dashboard/modules',data).then(()=>{
                     this.loading= false
                 })
             }
        }
    }
}
</script>

