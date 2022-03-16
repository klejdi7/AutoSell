<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
@include('layouts.frontend.head')
<body>

    <div id="app">

        <v-app>

            <template>
           
                       <v-app-bar app color="white">
                        <v-toolbar-title class="font-weight-bold">

                            AUTOSCOUT <v-icon right color="red" class="text-h3"> mdi-car-hatchback </v-icon>

                         </v-toolbar-title>

                         <v-spacer></v-spacer>

                            <v-btn onclick="window.location='{{ url("admin") }}'"  text  v-if="this.$root.user.role == 1">ADMIN DASHBOARD</v-btn>

                            <router-link to="/" class="text-center mx-2" tag="button"> <v-btn text>HOME</v-btn> </router-link>    
       
                            <router-link to="/cart"  class="text-center mx-2" tag="button"> <v-btn text>CART</v-btn> </router-link>
       
                            <v-btn text onclick="window.location='{{ url("logout") }}'"  v-if="this.$root.isLoggedin">LOGOUT</v-btn>
       
                            <user-modal :title="'Login'" :action="'login'" v-if="this.$root.isLoggedin == false"></user-modal>
       
                            <user-modal :title="'Register'" :action="'register'" v-if="this.$root.isLoggedin == false"></user-modal>


                           <cart-modal ref="cart"></cart-modal>

                           </v-app-bar>
           
               			<v-main>
                    
                    <snack-bar></snack-bar>

               </v-main>

           </template>
        
        </v-app>

    </div>

        <script src="{{ asset('js/app.js?'.config('app.key')) }}"></script> 
        
    </body>

</html>
