<template>
    <Layout title="Show loan">
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
                        <v-app-bar flat class="blue lighten-2">
                            <v-toolbar-title>
                                <div class="headline">Loan Details</div>
                            </v-toolbar-title>
                                <v-spacer></v-spacer>
                                <v-menu
                                    left
                                    bottom
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            icon
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon>mdi-dots-vertical</v-icon>
                                        </v-btn>
                                    </template>

                                    <v-list>
                                        <v-list-item
                                            v-for="n in 5"
                                            :key="n"
                                            @click="() => {}"
                                        >
                                            <v-list-item-title>Option {{ n }}</v-list-item-title>
                                        </v-list-item>
                                    </v-list>
                                </v-menu>

                        </v-app-bar>
                        <v-card-text>
                            <v-card flat outlined>
                                <v-app-bar flat>
                                    <v-toolbar-title>
                                        <div class="headline">Personal Information</div>
                                    </v-toolbar-title>
                                </v-app-bar>
                                <v-card-text>
                                    <v-simple-table>
                                        <tbody>
                                        <tr><th>Name</th><td>{{loan.user.name}}</td></tr>
                                        <tr><th>Surname</th><td>{{loan.user.surname}}</td></tr>
                                        <tr><th>Mobile</th><td>{{loan.user.mobile}}</td></tr>
                                        <tr><th>Email</th><td>{{loan.user.email}}</td></tr>
                                        <tr><th>City</th><td>{{loan.user.city}}</td></tr>
                                        <tr><th>Country</th><td>{{loan.user.country}}</td></tr>
                                        </tbody>
                                    </v-simple-table>
                                </v-card-text>
                            </v-card>

                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                    <v-toolbar-title>
                                        <div class="headline">Loan Information</div>
                                    </v-toolbar-title>
                                </v-app-bar>

                                <v-card-text>
                         <v-row>
                             <v-col cols="12" md="12">
                                 <div class="grey--text"><small>Reason</small></div>
                                 <div>{{loan.reason}}</div>
                             </v-col>
                         </v-row>
                            <v-row>
                                <v-col cols="12" sm="3">
                                    <div class="subtitle-1">Collateral Type</div>
                                    <div class="subtitle-2 black--text">{{loan.collateral.type.name}}</div>
                                </v-col>
                                <v-col cols="12" sm="3">
                                    <div class="subtitle-1">Collateral Value</div>
                                    <div class="subtitle-2 black--text">USD{{loan.amount}}</div>
                                </v-col>
                                <v-col cols="12" sm="3">
                                    <div class="subtitle-1">Amount Required</div>
                                    <div class="subtitle-2 black--text">USD{{loan.amount}}</div>
                                </v-col>
                                <v-col cols="12" sm="3">
                                    <div class="subtitle-1">Status</div>
                                    <div class="subtitle-2 black--text">{{loan.status}}</div>
                                </v-col>
                            </v-row>
                                </v-card-text>
                            </v-card>
                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                  <v-toolbar-title>Collateral Details</v-toolbar-title>
                                </v-app-bar>
                                <v-card-text>
                                    <v-simple-table>
                                        <tbody>
                                        <tr v-if="loan.collateral.properties.make">
                                            <th>Make</th>
                                            <td>{{loan.collateral.properties.make}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.model">
                                            <th>Model</th>
                                            <td>{{loan.collateral.properties.model}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.year">
                                            <th>Manufacture Year</th>
                                            <td>{{loan.collateral.properties.year}}</td>
                                        </tr>
                                          <tr v-if="loan.collateral.properties.fuel">
                                              <th>Fuel Type</th>
                                              <td>{{loan.collateral.properties.fuel}}</td>
                                          </tr>
                                        <tr v-if="loan.collateral.properties.brand">
                                            <th>Brand</th>
                                            <td>{{loan.collateral.properties.brand}}</td>
                                        </tr>
                                        <tr  v-if="loan.collateral.properties.make">
                                            <th>Engine</th>
                                            <td>{{loan.collateral.properties.engine}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.mileage">
                                            <th>Mileage</th>
                                            <td>{{loan.collateral.properties.mileage}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.bodytype">
                                            <th>Body Type</th>
                                            <td>{{loan.collateral.properties.bodytype}}</td>
                                        </tr>
                                        <tr v-if="loan.collateral.properties.condition">
                                            <th>Ownership period</th>
                                            <td>{{loan.collateral.properties.condition}}</td>
                                        </tr>
                                        </tbody>
                                    </v-simple-table>
                                </v-card-text>
                            </v-card>
                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                    <v-toolbar-title>Collateral Images</v-toolbar-title>
                                </v-app-bar>
                                <v-card-text>
                                    <v-row>
                                        <v-col
                                            v-for="pic in loan.collateral.images"
                                            :key="pic.id"
                                            class="d-flex child-flex"
                                            cols="4"
                                        >
                                            <v-img
                                                :src="`/${pic.image}`"
                                                :lazy-src="`/${pic.image}`"
                                                aspect-ratio="1"
                                                class="grey lighten-2"
                                                @click="showDialog(pic)"
                                            >
                                                <template v-slot:placeholder>
                                                    <v-row
                                                        class="fill-height ma-0"
                                                        align="center"
                                                        justify="center"
                                                    >
                                                        <v-progress-circular
                                                            indeterminate
                                                            color="grey lighten-5"
                                                        ></v-progress-circular>
                                                    </v-row>
                                                </template>
                                            </v-img>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>
                            <v-card flat outlined class="mt-5">
                                <v-app-bar flat>
                                    <v-toolbar-title>Evaluation Report</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-btn small outlined rounded color="success" v-if="!loan.collateral.report" @click="evaluationModel=true">Add Report</v-btn>
                                </v-app-bar>
                                <v-card-text>
                                    <div v-if="loan.collateral.report">
                                      <v-simple-table>
                                          <thead>
                                          <tr>
                                              <th>Market Value</th><td>USD {{loan.collateral.report.market_value}}</td>
                                          </tr>
                                          <tr>
                                              <th>Comment</th><td>{{loan.collateral.report.market_value_comment}}</td>
                                          </tr>
                                          <tr>
                                              <th>liquidatable Score</th><td>{{loan.collateral.report.liquidatable_score}} %</td>
                                          </tr>
                                          <tr>
                                              <th>liquidatable Comment</th><td>{{loan.collateral.report.liquidatable_comment}}</td>
                                          </tr>
                                          <tr><th>Condition</th><td>{{loan.collateral.report.state}}</td></tr>
                                          <tr><th>Comment</th><td>{{loan.collateral.report.state_comment}}</td></tr>
                                          <tr><th>Ownership</th><td>{{loan.collateral.report.ownership}}</td></tr>
                                          <tr><th>Comment</th><td>{{loan.collateral.report.ownership_comment}}</td></tr>
                                          </thead>
                                      </v-simple-table>
                                    </div>
                                    <div v-else>
                                        <v-alert
                                            prominent
                                            type="error"
                                        >
                                            <v-row align="center">
                                                <v-col class="grow">
                                                   No Evaluation report added as yet
                                                </v-col>
                                                <v-col class="shrink">
                                                    <v-btn @click="evaluationModel=true">Add Report</v-btn>
                                                </v-col>
                                            </v-row>
                                        </v-alert>
                                    </div>
                                </v-card-text>
                            </v-card>

                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>

            <v-dialog v-model="galleryModel" width="600">
                <v-card width="600">
                    <v-card-title>
                        <div>
                            Image View
                        </div>
                        <v-spacer/>
                        <v-btn icon @click="galleryModel=false"><v-icon>mdi-close</v-icon></v-btn>
                    </v-card-title>
                    <v-card-text>
                        <v-img
                            :lazy-src="`/${image}`"
                            :src="`/${image}`"
                        ></v-img>
                    </v-card-text>

                </v-card>
            </v-dialog>

            <v-dialog v-model="evaluationModel"  width="900px">
                <v-form ref="form" v-model="validform" lazy-validation>
                <v-card>
                   <v-app-bar color="primary"  dark flat>
                       <v-toolbar-title>Evaluation Report</v-toolbar-title>
                       <v-spacer></v-spacer>
                       <v-btn icon @click="evaluationModel=false"><v-icon>mdi-close</v-icon></v-btn>
                   </v-app-bar>
                    <v-card-text class="pa-3">
                        <v-text-field outlined label="Market Value" prepend-inner-icon="mdi-currency-usd" v-model="marketvalue" :rules="marketvalueRule"></v-text-field>
                        <v-textarea outlined label="Comment by value" v-model="marketvaluecomment" :rules="marketvaluecommentRule"></v-textarea>
                        <v-text-field outlined label="liquidatable Percentage" type="number" v-model="liquidatableScore" :rules="liquidatableScoreRule"></v-text-field>
                        <v-textarea outlined label="liquidatable Comment" v-model="liquidatableComment" :rules="liquidatableCommentRule"></v-textarea>
                        <v-select :items="statelist" label="Collateral Condition" outlined v-model="state" :rules="stateRule"></v-select>
                        <v-textarea outlined label="Comment condition" v-model="statecomment" :rules="statecommentRule"></v-textarea>
                        <v-select :items="ownershiplist" label="Ownership" outlined v-model="ownership" :rules="ownershipRule"></v-select>
                        <v-textarea outlined label="Comment on owndership" v-model="ownershipcomment" :rules="ownershicommentRule"></v-textarea>
                        <v-select :items="statuslist" label="Loan status" outlined v-model="status" :rules="statusRule"></v-select>

                    </v-card-text>
                    <v-card-actions>
                        <v-btn rounded outlined color="red" dark @click="evaluationModel=false">Cancel</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn rounded outlined color="green" @click="submitForm" :loading="loading" :disabled="loading">Submit</v-btn>
                    </v-card-actions>
                </v-card>
                </v-form>
            </v-dialog>
        </v-container>
    </Layout>
</template>
<script>
import Layout from '../../layouts/users'
export default {
    props:['successMessage','errorMessage','loan'],
    components:{
        Layout
    },data(){
        return{
            validform:true,
            galleryModel:false,
            evaluationModel:false,
            image:'',
            statelist:['Fair','Good','Excellent'],
            ownershiplist:['Verified','Unverified'],
            statuslist:['BLOCKED','PUBLISHED'],
            marketvalue:'',
            marketvalueRule:[v => !!v || ' Martket value required'],
            marketvaluecomment:'',
            marketvaluecommentRule:[v => !!v || 'Comment on market value please'],
            liquidatableScore:'',
            liquidatableScoreRule:[v => !!v || 'Enter liquidatability score'],
            liquidatableComment:'',
            liquidatableCommentRule:[v => !!v || 'Enter liquidatability  comment'],
            state:'',
            stateRule:[v => !!v || 'Select  Collateral Condition'],
            statecomment:'',
            statecommentRule:[v => !!v || 'Comment on collateral comment '],
            ownership:'',
            ownershipRule:[v => !!v || 'Select ownership status'],
            ownershipcomment:'',
            ownershicommentRule:[v => !!v || ' Comment on ownership status'],
            statusRule:[v => !!v || 'Select loan status'],
            status:'',
            loading:false
        }
    },methods:{
        showDialog(pic){
            this.galleryModel = true
            this.image = pic.image
        },submitForm(){
            if(this.$refs.form.validate()){
                this.loading=true
                var data ={ status:this.status,marketvalue:this.marketvalue,marketvaluecomment:this.marketvaluecomment,liquidatablescore:this.liquidatableScore,liquidatablecomment:this.liquidatableComment,state:this.state,statecomment:this.statecomment,ownership:this.ownership,ownershipcomment:this.ownershipcomment,loan:this.loan.id,collateral:this.loan.collateral.id}
                this.$inertia.post('/dashboard/loan-evaluation',data).then(()=>{
                    this.loading=true
                })
            }
        }

    }
}
</script>

