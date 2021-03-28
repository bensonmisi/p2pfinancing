<template>
    <Layout title="Roles">
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
                            <v-toolbar-title class="white--text">Roles</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default white--text" :href="$route('roles.create')">Add Role</inertia-link>

                        </v-app-bar>
                        <v-card-text>
                            <div v-if="roles.length>0">
                                <v-simple-table>
                                    <thead>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr  v-for="role in roles" :key="role.id">
                                        <td>
                                            {{role.name}}
                                        </td>
                                        <td>
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
                                                    <inertia-link class="v-list-item v-list-item--link theme--light" :href="$route('roles.show',role.id)">

                                                        <v-list-item-icon><v-icon>mdi-pencil</v-icon></v-list-item-icon>
                                                        <v-list-item-title>Edit</v-list-item-title>
                                                    </inertia-link>
                                                    <inertia-link class="v-list-item v-list-item--link theme--light":href="$route('assign.show',role.id)">
                                                        <v-list-item-icon><v-icon>mdi-account-check</v-icon></v-list-item-icon>
                                                        <v-list-item-title>Modules</v-list-item-title>
                                                    </inertia-link>
                                                    <inertia-link class="v-list-item v-list-item--link theme--light" type="button" method="DELETE" :href="$route('roles.destroy',role.id)">
                                                        <v-list-item-icon><v-icon>mdi-delete</v-icon></v-list-item-icon>
                                                        <v-list-item-title>Delete</v-list-item-title>
                                                    </inertia-link>

                                                </v-list>
                                            </v-menu>
                                        </td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>

                            </div>
                            <div v-else>
                                <v-alert
                                    text
                                    prominent
                                    type="error"
                                    icon="mdi-cloud-alert"
                                >
                                    No Roles Found
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
    props:['successMessage','errorMessage','roles'],
    components:{
        Layout
    }
}
</script>

