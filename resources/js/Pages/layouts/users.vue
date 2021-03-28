<template>
  <v-app id="inspire">

    <v-navigation-drawer
      class="deep-purple accent-4"
      dark
      v-model="drawer"
      app
    >
        <div>
            <v-img src="/img/small_logo.jpg"/>
        </div>


    <v-divider/>

      <v-list>

          <div v-for="module in modules" :key="module.id">
          <inertia-link :href="$route(module.link)" class=" v-list-item v-list-item--link theme--dark white--text">
              <v-list-item-icon>
                  <v-icon>{{module.icon}}</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                  {{module.name}}
              </v-list-item-content>
          </inertia-link>
          </div>





      </v-list>

      <template v-slot:append>
        <div class="pa-2">
          <v-btn block>
            Logout
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar app flat class="white grey--text">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title class="ml-0">{{title}}</v-toolbar-title>
      <v-spacer/>
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
    </v-app-bar>

    <v-main class="grey lighten-4">

      <slot />
    </v-main>
  </v-app>
</template>

<script>
import axios from 'axios';
  export default {
    props:['title'],
    data: () => ({
       drawer: null,
        items: [
          { title: 'Dashboard', icon: 'mdi-view-dashboard' },
          { title: 'Account', icon: 'mdi-account-box' },
          { title: 'Admin', icon: 'mdi-gavel' },
        ]
     }),
    watch: {
      title: {
        immediate: true,
        handler(title) {
          document.title = title
        },
      },
    },
    computed: {
      user() {
        return this.$page.props.user
      },modules(){
         return this.$page.props.modules
        }
    }
  }
</script>
<style scoped>
  .link_none{
    text-decoration: none;
  }
</style>
