<template>
    <v-app id="inspire">
        <v-container>
            <v-row>
                <v-col md="8" offset-md="2">
                    <v-card outlined flat>
                        <v-card-text>
                            <v-row>
                                <v-col md="4" offset-md="4" class="text-center">
                                    <v-img src="/img/logo.jpg" width="400"></v-img>
                                </v-col>

                            </v-row>
                            <v-divider></v-divider>
                            <v-row class="mt-8">
                                <v-col md="4" offset-md="4" class="text-center">
                                    <div>Loan Repayment Receipt</div>
                                    <div><small>{{client.name}}{{client.surname}}</small></div>
                                    <div>{{installment.receiptnumber}}</div>
                                    <div>{{installment.created_at | formatDate }}</div>
                                </v-col>

                            </v-row>
                            <v-divider></v-divider>
                            <div class="mt-5">
                                <v-simple-table>
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{installment.created_at | formatDate }}</td>
                                        <td>loan Repayment</td>
                                        <td>
                                            USD${{installment.amount}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td>Remaining Loan Balance</td>
                                        <td>
                                            USD${{balance}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </v-simple-table>

                            </div>
                        </v-card-text>
                    </v-card>
                    <inertia-link :href="$route('dashboard')">Back</inertia-link>
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props:['installment','balance','client']
}
</script>

<style scoped>

</style>
