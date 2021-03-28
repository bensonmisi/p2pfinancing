<template>
    <welcome_layout title="Forgot Password">
        <v-container>
            <v-row>
                <v-col
                    cols="12"
                    md="6"
                    offset-md="3"
                >
                    <v-alert
                        border="top"
                        color="red lighten-2"
                        dark
                        v-if="errors.email"
                    >
                        {{errors.email}}
                    </v-alert>
                    <v-alert
                        dense
                        text
                        type="success"
                        v-if="status"
                    >
                        {{status}}
                    </v-alert>

                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation>
                        <v-card>
                            <v-card-title>
                                <h3>Forgot Password</h3>
                            </v-card-title>
                            <v-divider/>
                            <v-card-text>
                                <div class="pa-8 overline">
                                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.

                                <v-text-field
                                    v-model="user.email"
                                    label="Email"
                                    outlined
                                    :rules="EmailRules"

                                >

                                </v-text-field>
                                </div>

                            </v-card-text>
                            <v-card-actions>


                                <v-btn
                                    outlined
                                    block
                                    rounded
                                    text
                                    class="green lighten-3 white--text"
                                    @click="submitForm"
                                    :loading="loading"
                                    :disabled="loading"
                                >
                                    Email Password Reset Link
                                </v-btn>

                            </v-card-actions>

                        </v-card>
                        <div  class="text-center mt-4 mb-2">
                            <inertia-link :href="$route('register')">Do not have an acount ??</inertia-link>
                        </div>
                        <div class="text-center">
                            <inertia-link :href="$route('password.request')">Forgot Passowrd ??</inertia-link>
                        </div>


                    </v-form>
                </v-col>
            </v-row>
        </v-container>

    </welcome_layout>

</template>
<script>
import  welcome_layout  from '../Layout'
export  default {
    props:['errors','status'],
    components:{
        welcome_layout
    },data(){
        return{
            valid:true,
            loading:false,
            show1: false,
            EmailRules:[
                v => !!v || 'Email is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',

            ],
            PasswordRules:[
                v=> !!v || 'Password is required'
            ],
            user:{
                email:''
            },
        }
    },methods:{
        submitForm(){
            if(this.$refs.form.validate()){
                this.loading = true
                this.$inertia.post('/forgot-password',this.user)
                    .then(()=>{
                        this.loading = false
                    })
            }
        }
    }
}
</script>
