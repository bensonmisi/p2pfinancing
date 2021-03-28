<template>
<Layout title="View Post">
    <v-layout wrap>
        <v-flex xs12 sm6 offset-sm3>
            <v-card width="400px">
                <v-form v-model="valid" ref="form" lazy-validation>
                <v-card-title>
                    <div>
                        Post
                    </div>
                    <v-spacer/>
                  
                    </v-card-title>

                <v-card-text>
                    <div class="title">{{post.title}}</div> 
                    <p>{{post.body}}</p>
                </v-card-text>
                <v-card-actions>
                      <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small blue--text"  :href="`${post.id}/edit`">Edit</inertia-link>
               
                    <v-spacer/>
                      <v-btn 
                    outlined  
                    :loading="loading"
                    :disabled="loading"
                     rounded
                      color="red" 
                      @click="deletePost">
                     delete
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
    props:['errors','post'],
    data(){
        return{
            title:this.post.title,
            body:this.post.body,
            valid:true,
            loading:false,
            addDialog:false,
            titleRule:[v=>!!v||'Title is required'],
            bodyRule:[v => !!v || 'Body is required' ]
        }
    },methods:{
        deletePost(){
        
            if(this.$refs.form.validate()){
                 this.loading =true
              
                this.$inertia.delete(`/dashboard/Posts/${this.post.id}`).then(()=>{
                    this.addDialog=false;
                    this.loading = false;
                })
               
            }
        }
    }
}
</script>