<template>
    <user-layout title="Add Image">
        <v-container>
            <v-row>
                <v-col cols="12" sm="4">
                    <v-card>
                        <v-card-text class="text-center">
                            <v-progress-circular
                                :rotate="360"
                                :size="200"
                                :width="15"
                                :value="value"
                                color="green"
                            >
                                <div>
                                    <div>
                                        {{ value }}%
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
                                <inertia-link  class=" v-list-item v-list-item--link theme--light" :href="$route('collateralApplication.index')">
                                    <v-list-item-content class="green--text">
                                        Collateral Details
                                    </v-list-item-content>
                                    <v-list-item-action>
                                        <v-icon class="green--text">mdi-check</v-icon>
                                    </v-list-item-action>
                                </inertia-link>
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
                        v-if="errors.image"
                        type="error"
                    >
                        {{errors.image}}
                    </v-alert>

                    <v-layout wrap>
                        <v-flex xs12 sm6 offset-sm3>
                            <v-card width="400px">
                                <v-form v-model="valid" ref="form" lazy-validation>
                                    <v-card-title>
                                        <div>
                                            New Image
                                        </div>
                                        <v-spacer/>
                                        <v-btn icon ><v-icon>mdi-close</v-icon></v-btn>
                                    </v-card-title>

                                    <v-card-text>
                                        <v-file-input
                                            label="File input"
                                            outlined
                                            dense
                                            v-model="image"
                                            :rules="imageRule"
                                            accept="image/png, image/jpeg"
                                            placeholder="Click here to pick your image"
                                            prepend-icon="mdi-camera"
                                        ></v-file-input>
                                    </v-card-text>
                                    <v-card-actions>
                                        <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('collateralImages.show','1')">Cancel</inertia-link>
                                        <v-spacer/>
                                        <v-btn
                                            outlined
                                            :loading="loading"
                                            :disabled="loading"
                                            rounded color="green"
                                            @click="addImage">
                                            Submit
                                        </v-btn>
                                    </v-card-actions>
                                </v-form>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-col>
            </v-row>
        </v-container>


    </user-layout>
</template>

<script>
import userLayout from "../../layouts/users";
export default {
    props:['errorMessage','successMessage','errors','gallery','collateral_id'],
    components:{
        userLayout
    },data(){
        return{
            value:50,
            image:'',
            valid:true,
            loading:false,
            addDialog:false,
            imageRule:[v => !!v || 'image is required']


        }
    },methods: {
        addImage() {
            if (this.$refs.form.validate()) {
                this.loading = true;
                var formData = new FormData()
                formData.append('image', this.image)
                this.$inertia.post('/dashboard/collateralImages', formData).then(() => {
                    this.loading = false;
                    this.addDialog = false;
                })

            }
        }
    }
}
</script>


