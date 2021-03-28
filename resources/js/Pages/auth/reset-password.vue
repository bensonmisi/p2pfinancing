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
                        border="top"
                        color="red lighten-2"
                        dark
                        v-if="errors.token"
                    >
                        {{errors.token}}
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

                                    <v-text-field
                                        v-model="email"
                                        label="Email"
                                        outlined
                                        :rules="EmailRules"

                                    >

                                    </v-text-field>
                                    <v-text-field
                                        v-model="password"
                                        outlined
                                        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                                        :rules="[rules.required, rules.min]"
                                        :type="show1 ? 'text' : 'password'"
                                        label="Password"
                                        hint="At least 8 characters"
                                        counter
                                        @click:append="show1 = !show1"
                                    >
                                    </v-text-field>
                                <v-text-field
                                    v-model="password_confirmation"
                                    outlined
                                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                    :rules="[rules.required, rules.min,rules.passwordMatch]"
                                    :type="show2 ? 'text' : 'password'"
                                    label="ConfirmPassword"
                                    hint="At least 8 characters"
                                    counter
                                    @click:append="show2 = !show2"
                                >
                                </v-text-field>

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
                                    Reset Password
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
            {{request}}
        </v-container>

    </welcome_layout>

</template>
<script>
import  welcome_layout  from '../Layout'
export  default {
    props:['errors','status','email','token'],
    components:{
        welcome_layout
    },data(){
        return{
            valid:true,
            show1: false,
            show2: false,
            loading:false,
            EmailRules:[
                v => !!v || 'Email is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',

            ],
            PasswordRules:[
                v=> !!v || 'Password is required'
            ],
            rules: {
                required: value => !!value || 'Required.',
                min: v => v.length >= 8 || 'Min 8 characters',
                passwordMatch: v =>(!!v && v)=== this.password || `The passwords you entered don't match`,
            },
            email:'',
            password_confirmation:'',
            password:'',
            token:''

        }
    },methods:{
        submitForm(){
            if(this.$refs.form.validate()){
                this.loading = true
                var data ={email:this.email,password:this.password,password_confirmation:this.password_confirmation,token:this.token}
                this.$inertia.post('/reset-password',data)
                    .then(()=>{
                        this.loading = false
                    })
            }
        }
    }
}
</script>
