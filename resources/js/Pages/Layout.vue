<template>
 <v-app id="inspire">
  <v-app-bar
      color="deep-purple accent-4"
      dense
      dark
      app
    >
      <v-app-bar-nav-icon></v-app-bar-nav-icon>

      <v-toolbar-title>{{title}}</v-toolbar-title>

      <v-spacer></v-spacer>

        <inertia-link :href="$route('login')" class="pa-3 link white--text">Login</inertia-link>
        <inertia-link :href="$route('register')" class="pa-3 link white--text">Register</inertia-link>



    </v-app-bar>
    <v-main>
        <v-container>
             <slot />
        </v-container>
    </v-main>

 </v-app>
</template>

<script>
  export default {
    props: {
      title: String,
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
