<template>
<Layout title="Add Post">
    <v-layout wrap>
        <v-flex xs12 sm6 offset-sm3>
            <v-card width="400px">
                <v-form v-model="valid" ref="form" lazy-validation>
                <v-card-title>
                    <div>
                        New Post
                    </div>
                    <v-spacer/>
                    <v-btn icon @click="addDialog = false"><v-icon>mdi-close</v-icon></v-btn>
                    </v-card-title>

                <v-card-text>
                     <div v-if="errors" class="red--text">{{ errors.title }}</div> 
                      <v-text-field label="Title" outlined v-model="title" :rules="titleRule"/>
                       
                      <v-textarea label="Body" outlined v-model="body" :rules="bodyRule"/>
                       <div v-if="errors" class="red--text">{{ errors.body }}</div> 
                </v-card-text>
                <v-card-actions>
                    <v-btn outlined rounded color="red" @click="addDialog = false">Cancel</v-btn>
                    <v-spacer/>
                    <v-btn 
                    outlined  
                    :loading="loading"
                    :disabled="loading"
                     rounded color="green" 
                     @click="addPost">
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
            title:'',
            body:'',
            valid:true,
            loading:false,
            addDialog:false,
            titleRule:[v=>!!v||'Title is required'],
            bodyRule:[v => !!v || 'Body is required' ]
        }
    },methods:{
        addPost(){
            if(this.$refs.form.validate()){
                this.loading = true;
                
                var formData ={title:this.title,body:this.body}
                this.$inertia.post('/dashboard/Posts',formData).then(()=>{
                     this.loading = false;
                      this.addDialog=false;
                })
               
            }
        }
    }
}
</script>