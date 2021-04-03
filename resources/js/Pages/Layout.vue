<template>
 <v-app id="inspire">
  <v-app-bar

      
      dense
      light
      app
      color="white"
      height="80"
    >
      <div class="pa-3">
          <v-img src="/img/small_logo.jpg" width="200" />
      </div>

      <v-spacer></v-spacer>
       <span class="hidden-sm-and-up">
          <v-app-bar-nav-icon @click="drawer = !drawer" ></v-app-bar-nav-icon>   
          </span> 

        <div v-if="!user"  class="hidden-sm-and-down">
        <inertia-link :href="$route('welcome')" class="pa-3 link blue--text">Home</inertia-link>
        <inertia-link :href="$route('about')" class="pa-3 link blue--text">About P2P</inertia-link>
        <inertia-link :href="$route('investing')" class="pa-3 link blue--text">Investing</inertia-link>
        <inertia-link :href="$route('borrowing')" class="pa-3 link blue--text">Borrowing</inertia-link>
        <inertia-link :href="$route('login')" class="pa-3 link blue--text">Login</inertia-link>
        <inertia-link :href="$route('register')" class="pa-3 link blue--text">Register</inertia-link>
        </div>
        <div v-else>
           <v-menu offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          text
          v-bind="attrs"
          v-on="on"
          icon
        >
        <v-icon>mdi-account</v-icon>
        </v-btn>
      </template>
      <v-list width="200px">
          <inertia-link :href="$route('profile.index')" class=" v-list-item v-list-item--link theme--light">
              <v-list-item-icon>
                  <v-icon>mdi-account</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                  Profile Settings
              </v-list-item-content>
          </inertia-link>

          <inertia-link href="/logout" method="post" as="button" type="button" class=" v-list-item v-list-item--link theme--light">
              <v-list-item-icon>
                  <v-icon>mdi-logout</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                  Logout
              </v-list-item-content>
          </inertia-link>


      </v-list>
    </v-menu>
        </div>



    </v-app-bar>
       <v-navigation-drawer right  app v-model="drawer" class="hidden-sm-and-up">
          <v-list>
            <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('welcome')">Home</inertia-link>
             <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('about')">About P2P</inertia-link>
             <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('investing')">Investing</inertia-link>
             <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('borrowing')">Borrowing</inertia-link>
             <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('login')">Login</inertia-link>
             <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('register')">Register</inertia-link>
           
          </v-list>
      </v-navigation-drawer>
    <v-main>

             <slot />

    </v-main>
    <v-footer class="grey darken-3 white--text">
      <v-container>
      <v-row>
        <v-col cols="12" md="6">
                    <div class="headline">About Us</div>
                    <div class="body-1 mt-3">P2Pfinancing is the first  peer to peer (P2P) lending platforms in Zimbabwe. It connects investors or lenders looking for high returns with creditworthy borrowers looking for short term personal loans.</div>
        </v-col>
        <v-col cols="12" md="3">
           <div class="headline">Quick links</div>
           <ul>
             <li class="pt-2 pb-2"><inertia-link :href="$route('welcome')" class="pa-3 link white--text">Home</inertia-link></li>
             <li class="pt-2 pb-2"><inertia-link :href="$route('about')" class="pa-3 link white--text">How it works</inertia-link></li>
             <li class="pt-2 pb-2"><inertia-link :href="$route('investing')" class="pa-3 link white--text mt-3">How to invest</inertia-link></li>
             <li class="pt-2 pb-2"><inertia-link :href="$route('borrowing')" class="pa-3 link white--text mt-3">How to borrow</inertia-link></li>
           </ul>
        </v-col>
        <v-col cols="12" md="3">
           <div class="headline">Contacts</div>
           <div class="body-1 mt-3">
             <div>Loans offers</div>
             <div>email: loans@p2pfinancing.co.zw</div>
             <div>Phone: +263775474661</div>
           </div>
            <div class="body-1 mt-3">
             <div>Investment offers</div>
             <div>email: investments@p2pfinancing.co.zw</div>
             <div>Phone: +263717377487</div>
           </div>

        </v-col>
      </v-row>
      </v-container>
      
    </v-footer>
    <v-footer class="grey darken-4 white--text">
     <v-container>
      <v-row>
        <v-col cols="12" md="8">
          <div><small>© Copyright 2021 | AnixSys Pvt. Ltd.
</small></div>
        </v-col>
      </v-row>
     </v-container>
    </v-footer>

 </v-app>
</template>

<script>
  export default {
    props:['title','user'],
    data(){
      return{
        drawer:false
      }
    },
    watch: {
      title: {
        immediate: true,
        handler(title) {
          document.title = title
        },
      },
    },
  }
</script>
<style scope>
.link{
    text-decoration: none;
}
</style>
