<template>
    <Layout title="Statement">
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
                            <v-toolbar-title class="white--text">Statement</v-toolbar-title>

                        </v-app-bar>
                        <v-card-text>
                            <v-card>
                                <v-card-text>
                                    <v-row>
                                        <v-col cols="10">
                                            <div class="headline">Withdrawable Balance</div>
                                        </v-col>
                                        <v-col cols="2" class="text-center">
                                            <div class="headline"><small>USD {{balance}}</small></div>
                                            <div v-if="balance >0">
                                                <inertia-link class="v-btn  v-btn--rounded theme--light v-size--small blue--text" :href="$route('statements.create')">withdraw</inertia-link>

                                            </div>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>
                            <div v-if="statements.length>0">
                                <v-simple-table>
                                    <thead>
                                    <tr>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr  v-for="statement in statements" :key="statement.id" :class="`${statement.status}`">
                                        <td>
                                            {{statement.created_at | formatDate}}
                                        </td>
                                        <td>
                                           {{statement.description}}
                                        </td>
                                         <td>
                                             {{ statement.amount}}
                                         </td>
                                         <td>
                                             {{statement.status}}
                                         </td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>

                            </div>
                            <div v-else>

                            </div>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>


        </v-container>
    </Layout>
</template>
<script>
import Layout from '../layouts/users'
export default {
    props:['successMessage','errorMessage','statements','balance'],
    components:{
        Layout
    }
}
</script>
<style scoped>
.Dr{
    color: #ff5722;
}
.Cr{

    color: #00c853;
}
</style>

