<template>
    <Layout title="Users">
        <v-container>
            <div class="pa-3">
                <v-alert
                    type="error"
                    v-if="errorMessage"
                >
                    {{errorMessage}}
                </v-alert>
                <v-alert
                    type="success"
                    v-if="successMessage"
                >
                    {{successMessage}}
                </v-alert>
            </div>

            <v-row class="pa-3">
                <v-col md="12">
                    <v-card flat outlined>
                        <v-app-bar color="blue">
                            <v-toolbar-title class="white--text">Users</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default white--text" :href="$route('users.create')">Add User</inertia-link>

                        </v-app-bar>
                        <v-card-text>
                            <div class="pa-3">
                                <v-text-field
                                    v-model="filter"
                                    label="Search"
                                    outlined
                                >
                                </v-text-field>

                            </div>
                            <div v-if="users.data.length>0">
                                <div v-for="user in users.data" :key="user.id">
                                    <v-row class="pa-3">

                                        <v-col cols="6" sm="4">
                                            <div class="black--text">{{user.name}}</div>
                                            <div class="black--text">{{user.surname}}</div>
                                        </v-col>
                                        <v-col cols="6" sm="3">
                                            <div class="black--text">{{user.email}}</div>
                                            <div><small>{{user.mobile}}</small></div>
                                            <div><small>{{user.city}}</small></div>
                                        </v-col>
                                        <v-col cols="6" sm="3">
                                            <div class="black--text">{{user.role.name}}</div>
                                        </v-col>
                                        <v-col cols="6" sm="2" class="text-center">
                                            <v-menu offset-y>
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-btn
                                                        icon
                                                        v-bind="attrs"
                                                        v-on="on"
                                                    >
                                                        <v-icon>mdi-cog-outline</v-icon>
                                                    </v-btn>
                                                </template>
                                                <v-list>
                                                    <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('users.show',user.id)">

                                                        <v-list-item-icon><v-icon>mdi-pencil</v-icon></v-list-item-icon>
                                                        <v-list-item-title>Edit</v-list-item-title>
                                                    </inertia-link>

                                                    <inertia-link class="v-list-item v-list-item--link theme--light" type="button" method="DELETE" :href="$route('users.destroy',user.id)">
                                                        <v-list-item-icon><v-icon>mdi-delete</v-icon></v-list-item-icon>
                                                        <v-list-item-title>Delete</v-list-item-title>
                                                    </inertia-link>

                                                </v-list>
                                            </v-menu>
                                        </v-col>
                                    </v-row>
                                    <v-divider></v-divider>
                                </div>
                            </div>
                            <div v-else>
                                <v-alert
                                    text
                                    prominent
                                    type="error"
                                    icon="mdi-cloud-alert"
                                >
                                    No Users Found
                                </v-alert>
                            </div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../../layouts/users'
export default {
    props:['successMessage','errorMessage','users'],
    components:{
        Layout
    }
}
</script>

