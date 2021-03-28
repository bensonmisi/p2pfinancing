<template>
    <div>
          <Layout title="Gallery">
            <v-container>
                <v-card>
                    <v-card-title>
                        <div>Gallery</div>
                        <v-spacer/>
                         <inertia-link href="/dashboard/Gallery/create" class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--small green--text">Add New</inertia-link>
       
                    </v-card-title>
                    <v-card-text>
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
        @click="showDialog(pic.image)"
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
            </v-container>
        </layout>
        <v-dialog v-model="galleryModel" width="600">
            <v-card width="600">
                <v-card-title>Image View</v-card-title>
                <v-card-text>
                    <v-img
                    :lazy-src="`/${image}`"
                    max-height="300"
                    max-width="500"
                    :src="`/${image}`"
                    ></v-img>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>
 <script>
    import Layout from '../layouts/users'
 export default {
     props:['gallery'],
     components:{
         Layout
     },data(){
         return{
             image:'',
             galleryModel:false,
         }
     },methods:{
         showDialog(image){
               this.galleryModel = true
               this.image = image
         }
     }
 }
 </script>