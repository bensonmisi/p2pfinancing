<template>
    <Layout title="Add User">
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
                                <v-toolbar-title class="white--text">Add User</v-toolbar-title>
                            </v-app-bar>
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
                                <v-row>
                                    <v-col cols="12">
                                        <v-select
                                            :items="roles"
                                            label="Select Role"
                                            item-text="name"
                                            item-value="id"
                                            outlined
                                            v-model="user.role"
                                            :rules="roleRules"
                                        >
                                        </v-select>
                                    </v-col>
                                </v-row>


                            </v-card-text>
                            <v-card-actions>
                                <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('users.index')">Cancel</inertia-link>
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
    props:['successMessage','errorMessage','roles'],
    components:{
        Layout
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
            roleRules:[v => !!v || 'Select Role'],
            countrylist:['Afghanistan', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', ' Bahrain', ' Bangladesh', ' Barbados', ' Belarus', ' Belgium', ' Belize', ' Benin', ' Bermuda', ' Bhutan', ' Bolivia', ' Bosnia and Herzegovina', ' Botswana', ' Bouvet Island', ' Brazil', ' British Indian Ocean Territory', ' Brunei Darussalam', ' Bulgaria', ' Burkina Faso', ' Burundi', ' Cambodia', ' Cameroon', ' Canada', ' Cape Verde', ' Cayman Islands', ' Central African Republic', ' Chad', ' Chile', ' China', ' Christmas Island', ' Cocos (Keeling Islands)', ' Colombia', ' Comoros', ' Congo', ' Cook Islands', ' Costa Rica', ' Cote D Ivoire (Ivory Coast)', ' Croatia (Hrvatska', ' Cuba', ' Cyprus', ' Czech Republic', ' Denmark', ' Djibouti', ' Dominica', ' Dominican Republic', ' East Timor', ' Ecuador', ' Egypt', ' El Salvador', ' Equatorial Guinea', ' Eritrea', ' Estonia', ' Ethiopia', ' Falkland Islands (Malvinas)', ' Faroe Islands', ' Fiji', ' Finland', ' France', ' France', ' Metropolitan', ' French Guiana', ' French Polynesia', ' French Southern Territories', ' Gabon', ' Gambia', ' Georgia', ' Germany', ' Ghana', ' Gibraltar', ' Greece', ' Greenland', ' Grenada', ' Guadeloupe', ' Guam', ' Guatemala', ' Guinea', ' Guinea-Bissau', ' Guyana', ' Haiti', ' Heard and McDonald Islands', ' Honduras', ' Hong Kong', ' Hungary', ' Iceland', ' India', ' Indonesia', ' Iran', ' Iraq', ' Ireland', ' Israel', ' Italy', ' Jamaica', ' Japan', ' Jordan', ' Kazakhstan', ' Kenya', ' Kiribati', ' Korea (North)', ' Korea (South)', ' Kuwait', ' Kyrgyzstan', ' Laos', ' Latvia', ' Lebanon', ' Lesotho', ' Liberia', ' Libya', ' Liechtenstein', ' Lithuania', ' Luxembourg', ' Macau', ' Macedonia', ' Madagascar', ' Malawi', ' Malaysia', ' Maldives', ' Mali', ' Malta', ' Marshall Islands', ' Martinique', ' Mauritania', ' Mauritius', ' Mayotte', ' Mexico', ' Micronesia', ' Moldova', ' Monaco', ' Mongolia', ' Montserrat', ' Morocco', ' Mozambique', ' Myanmar', ' Namibia', ' Nauru', ' Nepal', ' Netherlands', ' Netherlands Antilles', ' New Caledonia', ' New Zealand', ' Nicaragua', ' Niger', ' Nigeria', ' Niue', ' Norfolk Island', ' Northern Mariana Islands', ' Norway', ' Oman', ' Pakistan', ' Palau', ' Panama', ' Papua New Guinea', ' Paraguay', ' Peru', ' Philippines', ' Pitcairn', ' Poland', ' Portugal', ' Puerto Rico', ' Qatar', ' Reunion', ' Romania', ' Russian Federation', ' Rwanda', ' Saint Kitts and Nevis', ' Saint Lucia', ' Saint Vincent and The Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Seychelles', 'Sierra Leone', ' Singapore', ' Slovak Republic', ' Slovenia', ' Solomon Islands', ' Somalia', ' South Africa', ' S. Georgia and S. Sandwich Isls.', ' Spain', ' Sri Lanka', ' St. Helena', 'St. Pierre and Miquelon', 'Sudan', 'Suriname', 'Svalbard and Jan Mayen Islands', ' Swaziland', ' Sweden', ' Switzerland', ' Syria', ' Taiwan', ' Tajikistan', ' Tanzania', ' Thailand', ' Togo', ' Tokelau', ' Tonga', ' Trinidad and Tobago', ' Tunisia', ' Turkey', ' Turkmenistan', ' Turks and Caicos Islands', ' Tuvalu', ' Uganda', ' Ukraine', ' United Arab Emirates', ' United Kingdom (Britain / UK)', ' United States of America (USA)', ' US Minor Outlying Islands', ' Uruguay', ' Uzbekistan', ' Vanuatu', ' Vatican City State (Holy See)', ' Venezuela', ' Viet Nam', ' Virgin Islands (British)', 'Virgin Islands (US)', 'Wallis and Futuna Islands', 'Western Sahara', 'Yemen', 'Yugoslavia', 'Zaire', ' Zambia', 'Zimbabwe'],
            user:{
                name:'',
                surname:'',
                email:'',
                phone:'',
                city:'',
                country:'',
                role:'',
                password:'',
                password_confirmation:''

            },
        }
    },methods:{
        submit(){
            if(this.$refs.form.validate()){
                this.loading= true

                this.$inertia.post('/dashboard/users',this.user).then(()=>{
                    this.loading= false
                })
            }
        }
    }
}
</script>

