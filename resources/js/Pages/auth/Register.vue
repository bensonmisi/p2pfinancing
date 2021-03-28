<template>
    <welcome_layout title="Register">
        <v-container>
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
                v-if="errors.mobile"
            >
                {{errors.mobile}}
            </v-alert>
            <v-alert
                border="top"
                color="red lighten-2"
                dark
                v-if="errorMessage"
            >
                {{errorMessage}}
            </v-alert>

            <v-row>
                <v-col cols="12" md="8" offset-md="2">
                    <v-form
                        ref="form"
                        v-model="valid"
                        lazy-validation>
                       <v-card>
                           <v-card-title>Register</v-card-title>
                           <v-card-text>
                               <v-row>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.name"
                                           label="Name"
                                           outlined
                                           :rules="NameRules"
                                       >
                                       </v-text-field>
                                   </v-col>

                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.surname"
                                           label="Surname"
                                           outlined
                                           :rules="SurnameRules"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.email"
                                           label="Email"
                                           outlined
                                           :rules="EmailRules"
                                       >
                                       </v-text-field>

                                   </v-col>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.phone"
                                           label="Phone"
                                           outlined
                                           :rules="PhoneRules"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12" md="6">
                                       <v-select
                                           :items="countrylist"
                                           label="Country"
                                           outlined
                                           v-model="user.country"
                                           :rules="countryRules"
                                       >
                                       </v-select>
                                   </v-col>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.city"
                                           label="City"
                                           outlined
                                           :rules="cityRules"
                                       >
                                       </v-text-field>
                                   </v-col>
                               </v-row>
                               <v-row>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.password"
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
                                   </v-col>
                                   <v-col cols="12" md="6">
                                       <v-text-field
                                           v-model="user.password_confirmation"
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
                                       </v-col>
                               </v-row>




                           </v-card-text>
                           <v-card-actions>
                                   <v-btn
                                       outlined
                                       rounded
                                       text
                                       class="red lighten-3 white--text"
                                   >
                                       Cancel
                                   </v-btn>
                                   <v-spacer/>
                                   <v-btn
                                       outlined
                                       rounded
                                       :loading="loading"
                                       :disabled="loading"
                                       text
                                       class="green lighten-3 white--text"
                                       @click="submitForm"
                                   >
                                       Submit
                                   </v-btn>
                           </v-card-actions>
                       </v-card>
                        <div  class="text-center mt-4 mb-2">
                            <inertia-link :href="$route('login')">Already got an acount ??</inertia-link>
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
    props:['errors','successMessage','errorMessage'],
    components:{
        welcome_layout
    },data(){
        return{
            valid:true,
            show1: false,
            show2: false,
            loading:false,
            NameRules:[
                v=> !!v || 'Name is required'
            ],
            SurnameRules:[
                v=> !!v || 'Surname is required'
            ],
            PhoneRules:[
                v=> !!v || 'Phone is required'
            ],
            countryRules:[
                v=> !!v || 'Country is required'
            ],
            cityRules:[
                v=> !!v || 'City is required'
            ],
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
                passwordMatch: v =>(!!v && v)=== this.user.password || `The passwords you entered don't match`,
            },
            countrylist:['Afghanistan', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', ' Bahrain', ' Bangladesh', ' Barbados', ' Belarus', ' Belgium', ' Belize', ' Benin', ' Bermuda', ' Bhutan', ' Bolivia', ' Bosnia and Herzegovina', ' Botswana', ' Bouvet Island', ' Brazil', ' British Indian Ocean Territory', ' Brunei Darussalam', ' Bulgaria', ' Burkina Faso', ' Burundi', ' Cambodia', ' Cameroon', ' Canada', ' Cape Verde', ' Cayman Islands', ' Central African Republic', ' Chad', ' Chile', ' China', ' Christmas Island', ' Cocos (Keeling Islands)', ' Colombia', ' Comoros', ' Congo', ' Cook Islands', ' Costa Rica', ' Cote D Ivoire (Ivory Coast)', ' Croatia (Hrvatska', ' Cuba', ' Cyprus', ' Czech Republic', ' Denmark', ' Djibouti', ' Dominica', ' Dominican Republic', ' East Timor', ' Ecuador', ' Egypt', ' El Salvador', ' Equatorial Guinea', ' Eritrea', ' Estonia', ' Ethiopia', ' Falkland Islands (Malvinas)', ' Faroe Islands', ' Fiji', ' Finland', ' France', ' France', ' Metropolitan', ' French Guiana', ' French Polynesia', ' French Southern Territories', ' Gabon', ' Gambia', ' Georgia', ' Germany', ' Ghana', ' Gibraltar', ' Greece', ' Greenland', ' Grenada', ' Guadeloupe', ' Guam', ' Guatemala', ' Guinea', ' Guinea-Bissau', ' Guyana', ' Haiti', ' Heard and McDonald Islands', ' Honduras', ' Hong Kong', ' Hungary', ' Iceland', ' India', ' Indonesia', ' Iran', ' Iraq', ' Ireland', ' Israel', ' Italy', ' Jamaica', ' Japan', ' Jordan', ' Kazakhstan', ' Kenya', ' Kiribati', ' Korea (North)', ' Korea (South)', ' Kuwait', ' Kyrgyzstan', ' Laos', ' Latvia', ' Lebanon', ' Lesotho', ' Liberia', ' Libya', ' Liechtenstein', ' Lithuania', ' Luxembourg', ' Macau', ' Macedonia', ' Madagascar', ' Malawi', ' Malaysia', ' Maldives', ' Mali', ' Malta', ' Marshall Islands', ' Martinique', ' Mauritania', ' Mauritius', ' Mayotte', ' Mexico', ' Micronesia', ' Moldova', ' Monaco', ' Mongolia', ' Montserrat', ' Morocco', ' Mozambique', ' Myanmar', ' Namibia', ' Nauru', ' Nepal', ' Netherlands', ' Netherlands Antilles', ' New Caledonia', ' New Zealand', ' Nicaragua', ' Niger', ' Nigeria', ' Niue', ' Norfolk Island', ' Northern Mariana Islands', ' Norway', ' Oman', ' Pakistan', ' Palau', ' Panama', ' Papua New Guinea', ' Paraguay', ' Peru', ' Philippines', ' Pitcairn', ' Poland', ' Portugal', ' Puerto Rico', ' Qatar', ' Reunion', ' Romania', ' Russian Federation', ' Rwanda', ' Saint Kitts and Nevis', ' Saint Lucia', ' Saint Vincent and The Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Seychelles', 'Sierra Leone', ' Singapore', ' Slovak Republic', ' Slovenia', ' Solomon Islands', ' Somalia', ' South Africa', ' S. Georgia and S. Sandwich Isls.', ' Spain', ' Sri Lanka', ' St. Helena', 'St. Pierre and Miquelon', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen Islands', ' Swaziland', ' Sweden', ' Switzerland', ' Syria', ' Taiwan', ' Tajikistan', ' Tanzania', ' Thailand', ' Togo', ' Tokelau', ' Tonga', ' Trinidad and Tobago', ' Tunisia', ' Turkey', ' Turkmenistan', ' Turks and Caicos Islands', ' Tuvalu', ' Uganda', ' Ukraine', ' United Arab Emirates', ' United Kingdom (Britain / UK)', ' United States of America (USA)', ' US Minor Outlying Islands', ' Uruguay', ' Uzbekistan', ' Vanuatu', ' Vatican City State (Holy See)', ' Venezuela', ' Viet Nam', ' Virgin Islands (British)', 'Virgin Islands (US)', 'Wallis and Futuna Islands', 'Western Sahara', 'Yemen', 'Yugoslavia', 'Zaire', ' Zambia', 'Zimbabwe'],
               user:{
                name:'',
                surname:'',
                email:'',
                phone:'',
                city:'',
                country:'',
                password:'',
                password_confirmation:''

            },
        }
    },methods:{
        submitForm(){
            this.loading = true
            if(this.$refs.form.validate()){
                this.$inertia.post('/register',this.user).then(()=>{
                    this.loading = false
                })
            }
        }
    }
}
</script>
