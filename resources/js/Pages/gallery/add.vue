<template>
<Layout title="Add Image">
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
                     <div v-if="errors" class="red--text">{{ errors.image }}</div> 
                       <v-file-input
                            label="File input"
                            outlined
                            dense
                            v-model="image"
                            :rules="imageRule"
                        ></v-file-input>
                </v-card-text>
                <v-card-actions>
                    <v-btn outlined rounded color="red" @click="addDialog = false">Cancel</v-btn>
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
</Layout>
</template>
<script>
import Layout from '../Layout.vue'
export default {
    components:{
     Layout,
    },
    props:['errors'],
    data(){
        return{
            image:'',
            valid:true,
            loading:false,
            addDialog:false,
            imageRule:[v => !!v || 'image is required' ]
        }
    },methods:{
        addImage(){
            if(this.$refs.form.validate()){
                this.loading = true;                
                var formData = new FormData()
                formData.append('image',this.image)
                this.$inertia.post('/dashboard/Gallery',formData).then(()=>{
                     this.loading = false;
                      this.addDialog=false;
                })
               
            }
        }
    }
}
</script>