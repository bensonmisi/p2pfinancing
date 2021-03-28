<template>
    <user-layout title="collateral Details">
        <v-container>
            <v-alert
                dense
                text
                v-if="successMessage"
                type="success"
            >
                {{successMessage}}
            </v-alert>
            <v-alert
                dense
                text
                v-if="errorMessage"
                type="error"
            >
                {{errorMessage}}
            </v-alert>

            <v-alert
                dense
                text
                v-if="errors.email"
                type="error"
            >
                {{errors.email}}
            </v-alert>
            <v-row>
                <v-col cols="12" sm="4">
                    <v-card>
                        <v-card-text class="text-center">
                            <v-progress-circular
                                :rotate="360"
                                :size="200"
                                :width="15"
                                :value="progressValue"
                                color="green"
                            >
                                <div>
                                    <div>
                                        {{ progressValue }}%
                                    </div>
                                    <div>Completed</div>
                                </div>
                            </v-progress-circular>

                            <v-list>
                                <inertia-link  class=" v-list-item v-list-item--link theme--light" :href="$route('loanApplication.create')">
                                    <v-list-item-content class="green--text">
                                        Loan Details
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-icon class="green--text">mdi-check</v-icon>
                                    </v-list-item-action>
                                </inertia-link>

                                <v-list-item>
                                    <v-list-item-content>
                                        Collateral Details
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-icon>mdi-check</v-icon>
                                    </v-list-item-action>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        Collateral Images
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-icon>mdi-check</v-icon>
                                    </v-list-item-action>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        Confirm
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-icon>mdi-check</v-icon>
                                    </v-list-item-action>
                                </v-list-item>
                            </v-list>
                        </v-card-text>
                    </v-card>

                </v-col>
                <v-col cols="12" sm="8">
                    <v-form ref="form" lazy-validation v-model="isFormValid">
                      <v-card>
                          <v-card-title>
                              Capture Collateral Details
                          </v-card-title>
                          <v-card-text>
                              <v-select
                                  outlined
                                  label="Select Collateral Type"
                                  v-model="type"
                                  :rules="typeRules"
                                  :items="typelist"
                                  item-text="name"
                                  item-value="id"
                                 >
                              </v-select>
                              <v-select
                                  outlined
                                  label="Select Currency"
                                  v-model="currency"
                                  :rules="currencyRules"
                                  :items="currencylist"
                                  item-text="name"
                                  item-value="id"
                              >
                              </v-select>
                              <v-text-field
                                  v-model="value"
                                  label="Estimate Value"
                                  outlined
                                  type="number"
                                  prefix="$"
                                  :rules="valueRules"
                              >
                              </v-text-field>
                              <v-card v-if="type">
                                  <v-card-title>
                                      <div>
                                          Collateral Properties
                                      </div>

                                  </v-card-title>
                                  <v-divider/>
                                  <v-card-text>

                                      <div v-if="type=='1'">
                                          <v-row>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="make"
                                                      label="Make"
                                                      outlined
                                                      :rules="makeRules"
                                                  ></v-text-field>
                                              </v-col>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="model"
                                                      label="Model"
                                                      outlined
                                                      :rules="modelRules"
                                                  ></v-text-field>
                                              </v-col>
                                          </v-row>

                                     <v-row>
                                         <v-col cols="12" sm="6">
                                             <v-select
                                                 outlined
                                                 label="Select Body Type"
                                                 v-model="bodytype"
                                                 :rules="bodytypeRules"
                                                 :items="bodytypelist"
                                             >
                                             </v-select>
                                         </v-col>
                                         <v-col cols="12" sm="6">
                                             <v-text-field
                                                 v-model="year"
                                                 label="Year"
                                                 outlined
                                                 :rules="yearRules"
                                             ></v-text-field>
                                         </v-col>
                                     </v-row>
                                        <v-row>
                                            <v-col cols="12" sm="6">
                                                <v-text-field
                                                    v-model="mileage"
                                                    label="Mileage"
                                                    outlined
                                                    :rules="mileageRules"
                                                ></v-text-field>
                                            </v-col>
                                            <v-col cols="12" sm="6">
                                                <v-select
                                                    outlined
                                                    label="Select Automative Condition"
                                                    v-model="condition"
                                                    :rules="conditionRules"
                                                    :items="conditionlist"
                                                >
                                                </v-select>
                                            </v-col>
                                        </v-row>
                                          <v-row>
                                              <v-col cols="12" sm="6">
                                                  <v-select
                                                      v-model="fuel"
                                                      label="Fuel Type"
                                                      :items="fueltypelist"
                                                      outlined
                                                      :rules="fuelRules"
                                                  ></v-select>
                                              </v-col>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="engine"
                                                      label="Engine Capacity"
                                                      outlined
                                                      :rules="engineRules"
                                                  ></v-text-field>
                                              </v-col>
                                          </v-row>


                                      </div>
                                      <div v-else-if="type=='3'">
                                          <v-row>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="brand"
                                                      label="Brand"
                                                      outlined
                                                      :rules="brandRules"
                                                  ></v-text-field>
                                              </v-col>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="model"
                                                      label="Model"
                                                      outlined
                                                      :rules="modelRules"
                                                  ></v-text-field>
                                              </v-col>
                                          </v-row>
                                          <v-row>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="releaseyear"
                                                      label="Release Year"
                                                      outlined
                                                      :rules="releaseyearRules"
                                                  ></v-text-field>
                                              </v-col>
                                              <v-col cols="12" sm="6">
                                                  <v-text-field
                                                      v-model="model"
                                                      label="Model"
                                                      outlined
                                                      :rules="modelRules"
                                                  ></v-text-field>
                                              </v-col>
                                          </v-row>
                                      </div>


                                  </v-card-text>
                                  <v-card-actions>
                                      <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('dashboard')">Cancel</inertia-link>
                                      <v-spacer/>
                                      <v-btn outlined rounded color="green" @click="submitForm">Submit</v-btn>
                                  </v-card-actions>
                              </v-card>
                          </v-card-text>
                      </v-card>
                    </v-form>
                  </v-col>
              </v-row>
        </v-container>
    </user-layout>
</template>

<script>
import userLayout from "../../layouts/users";
export default {
    props:['successMessage','errorMessage','errors','typelist','currencylist','collateral'],
    components:{
        userLayout
    },data(){
        return{
            progressValue:25,
            type:this.collateral ? this.collateral.collateral_type_id:'',
            isFormValid:false,
            typeRules:[v=>!!v || 'Select Collateral Type'],
            currency:this.collateral ? this.collateral.currency_id:'',
            currencyRules:[v=>!!v ||'Select Currency'],
            value:this.collateral ? this.collateral.value:'',
            valueRules:[v => !!v || 'Enter Collateral Estimate value'],
            properties:[],
            make:this.collateral ? this.collateral.properties.make : '',
            model:this.collateral ? this.collateral.properties.model : '',
            bodytype:this.collateral ? this.collateral.properties.bodytype : '',
            mileage:this.collateral ? this.collateral.properties.mileage : '',
            year:this.collateral ? this.collateral.properties.year : '',
            condition:this.collateral ? this.collateral.properties.condition : '',
            fuel:this.collateral ? this.collateral.properties.fuel : '',
            engine:this.collateral ? this.collateral.properties.engine : '',
            fuelRules:[v => !!v || 'Fuel type required'],
            engineRules:[v => !!v || 'Engine size required'],
            bodytypeRules:[v => !!v || 'Automative Body Type'],
            yearRules:[ v => !!v || 'Manufacture Year is required'],
            makeRules:[ v => !!v || 'Automative make is required'],
            modelRules:[v => !!v || 'Automotive model is required'],
            mileageRules:[v => !!v || ' Mileage is Required'],
            conditionRules:[v => !!v || 'Select Automative Conditon'],
            releaseyearRules:[v=> !!v ||' Release Year'],
            brandRules:[v => !!v || 'Brand required'],
            bodytypelist:['Sedun','SUV','Pickup','Truck','Convertible','Coupe','Other'],
            conditionlist:['Brand New','< 1 year',' < 3 years','5< years'],
            fueltypelist:['Hybrid','Diesel','Electric','Petrol'],
            brand:this.collateral ? this.collateral.properties.brand : '',
            releaseyear:this.collateral ? this.collateral.properties.releaseyear : '',
            id:this.collateral ? this.collateral.id : '',



        }
    },methods:{
        submitForm(){
         if(this.$refs.form.validate()){
             var propertylist = {
                 make:this.make,
                 model:this.model,
                 bodytype:this.bodytype,
                 mileage:this.mileage,
                 year:this.year,
                 condition:this.condition,
                 fuel:this.fuel,
                 engine:this.engine,
                 brand:this.brand,
                 releaseyear:this.releaseyear

             }

             var data ={id:this.id,type:this.type,currency:this.currency,amount:this.value,properties:propertylist}
             this.$inertia.post('/dashboard/collateralApplication',data)
         }
        }
    }
}
</script>


