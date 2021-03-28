<template>
 <Layout title="Posts">
     <v-container>
           <v-alert
      dense
      text
      type="success"
      v-if="successMessage"
    >
     {{successMessage}}
    </v-alert>
         <v-card>
             <v-card-title>

         <div class="title">Posts</div>
         <v-spacer/>
           <inertia-link href="/dashboard/Posts/create" class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small green--text">Add New</inertia-link>
             </v-card-title>
             <v-card-text>
                 <div v-for="post in  posts" :key="post.id">
                <v-layout wrap>
                    <v-flex xs12 sm10>
                        <b>{{post.title}}</b>
                        <p>{{post.body}}</p>
                    </v-flex>
                    <v-flex xs6 sm1>
                        <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small blue--text"  :href="`Posts/${post.id}/edit`">Edit</inertia-link>
                    </v-flex>
                      <v-flex xs6 sm1>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small red--text"  :href="`Posts/${post.id}`">Delete</inertia-link>
              
                    </v-flex>
                </v-layout>
                 </div>
              
              
             </v-card-text>
         </v-card>
     </v-container>

 </Layout>
</template>
<script>
import Layout from '../Layout.vue'
export default {
    components:{
     Layout,
    },
    props:['posts','successMessage']
}
</script>