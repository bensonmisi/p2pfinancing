<template>
    <user-layout title="loan Application">
        <v-container>
            <v-alert
                dense
                text
                v-if="successMessage"
                type="success"
            >
                {{successMessage}}
            </v-alert>
            <v-alert
                dense
                text
                v-if="errorMessage"
                type="error"
            >
                {{errorMessage}}
            </v-alert>

            <v-alert
                dense
                text
                v-if="errors.email"
                type="error"
            >
                {{errors.email}}
            </v-alert>

            <v-row>
                <v-col cols="12" md="6" offset-md="3">
                      <v-card>
                          <v-card-title>
                              <h4>Incomplete Loan Application</h4>
                          </v-card-title>
                          <v-card-text>
                              <v-alert
                                  outlined
                                  type="warning"
                                  prominent
                                  border="left"
                              >
                                  We have detected an incomplete loan application. What would want to do ?
                                </v-alert>

                          </v-card-text>
                          <v-card-actions>
                              <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default red--text" :href="$route('loanApplication.destroy','1')" method="DELETE" as="button" type="button">Discard</inertia-link>
                              <v-spacer/>
                              <inertia-link class="v-btn v-btn--outlined v-btn--rounded theme--light v-size--default blue--text" :href="$route('loanApplication.create')">Continue</inertia-link>

                          </v-card-actions>
                      </v-card>
                </v-col>
            </v-row>
        </v-container>
    </user-layout>
</template>

<script>
import userLayout from "../../layouts/users";
export default {
    props:['successMessage','errorMessage','errors'],
    components:{
        userLayout
    }
}
</script>


