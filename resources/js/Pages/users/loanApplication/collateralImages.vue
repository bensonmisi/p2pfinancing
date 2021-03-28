<template>
    <user-layout title="Collateral Images">
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
                        v-if="errors.email"
                        type="error"
                    >
                        {{errors.email}}
                    </v-alert>

                    <v-card>
                        <v-card-title>
                            <div>Gallery</div>
                            <v-spacer/>
                            <v-btn small color="green" outlined @click="addModel=true">Add Image</v-btn>

                        </v-card-title>
                        <v-card-text>
                            <div v-if="gallery.length >0">
                            <v-row>
                                <v-col
                                    v-for="pic in gallery"
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
                            </div>
                            <div v-else>
                                <v-alert
                                    text
                                    prominent
                                    type="error"
                                    icon="mdi-cloud-alert"
                                >No Images uploaded as yet</v-alert>
                            </div>
                        </v-card-text>
                        <v-card-actions v-if="gallery.length>0">
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('collateralApplication.index')">Back</inertia-link>
                            <v-spacer/>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default blue--text" :href="$route('loanApplication.show',2)">Proceed</inertia-link>


                        </v-card-actions>
                    </v-card>

                </v-col>
            </v-row>
        </v-container>
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
                <v-card-actions>
                    <v-btn small color="red" outlined rounded @click="galleryModel=false">Cancel</v-btn>
                    <v-spacer/>
                    <v-btn small color="green" outlined rounded  :loading="loading" :disabled="loading" @click="deleteImage">Delete</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog v-model="addModel" max-width="300">
            <v-card width="400px">
                <v-form v-model="valid" ref="form" lazy-validation>
                    <v-card-title>
                        <div>
                            New Image
                        </div>
                        <v-spacer/>
                        <v-btn icon @click="addModel=false" ><v-icon>mdi-close</v-icon></v-btn>
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
                        <v-btn small outlined color="red" @click="addModel=false">Cancel</v-btn>
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
        </v-dialog>

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
            galleryModel:false,
            addModel:false,
            valid:true,
            loading:false,
            imageRule:[v => !!v || 'image is required'],
            id:''


        }
    },methods:{
        showDialog(pic){
            this.galleryModel = true
            this.image = pic.image
            this.id = pic.id
        },
        addImage() {
            if (this.$refs.form.validate()) {
                this.loading = true;
                var formData = new FormData()
                formData.append('image', this.image)
                this.$inertia.post('/dashboard/collateralImages', formData).then(() => {
                    this.loading = false;
                    this.addModel = false;
                })

            }
        },
        deleteImage(){
            this.loading = true
            this.$inertia.delete('/dashboard/collateralImages/'+this.id).then(()=>{
                this.loading = false;
                this.galleryModel = false
            })
        }
    }
}
</script>


