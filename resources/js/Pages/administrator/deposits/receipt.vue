<template>
    <v-app id="inspire">
   <v-container>
     <v-row>
         <v-col md="8" offset-md="2">
             <v-card outlined flat>
                 <v-card-text>
             <v-row>
                 <v-col cols="8" class="text-center">
                   <v-img src="/img/logo.jpg" width="400"></v-img>
                 </v-col>
                         <v-col cols="4" class="pt-10">
                     <div class="text-right font-weight-bold">
                     <div>{{deposit.receiptnumber}}</div>
                     <div>{{deposit.created_at | formatDate }}</div>
                     <div>P2Pfinancing Pvt Ltd</div>
                     </div>
                 </v-col>
             </v-row>
             <v-divider></v-divider>
             <v-row class="mt-8">
                 <v-col cols="4">
                     <div>Receipt for :</div>
                 </v-col>
                 <v-col cols="8" class="text-right">
                    <div>{{deposit.user.name}} {{deposit.user.surname}}</div>
                     <div><small>{{deposit.user.email}}</small></div>
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
                         <td>{{deposit.created_at | formatDate }}</td>
                         <td>Cash Deposit</td>
                         <td>
                             USD${{deposit.amount}}
                         </td>
                     </tr>
                     <tr>
                         <td>{{deposit.created_at | formatDate }}</td>
                         <td>Service charger</td>
                         <td>
                            USD$ ({{deposit.charge}})
                         </td>
                     </tr>
                     <tr>
                         <td></td>
                         <td>Balance</td>
                         <td>
                             USD${{deposit.balance}}
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
    props:['deposit']
}
</script>

<style scoped>

</style>
