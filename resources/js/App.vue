<template>
 	
	 <v-app id="inspire">
    
		<v-navigation-drawer v-model="drawer" app class="pt-4" color="grey lighten-3" >

			<v-btn class="d-block text-center mx-auto mb-9">HOME</v-btn>
			<v-btn class="d-block text-center mx-auto mb-9">CARS</v-btn>
			<v-btn class="d-block text-center mx-auto mb-9">CART</v-btn>

			<login-modal ></login-modal>
			<v-btn class="d-block text-center mx-auto mb-9">REGISTER</v-btn>

    	</v-navigation-drawer>

			<v-app-bar app color="white">
      			<v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
				<v-toolbar-title class="font-weight-bold">
					AUTOSCOUT <v-icon right color="red" class="text-h3"> mdi-car-hatchback </v-icon>
					</v-toolbar-title>
					<v-spacer></v-spacer>
    			<cart-modal></cart-modal>
   	 		</v-app-bar>

    <v-main>
 <router-view style="padding:20px" > </router-view>
    </v-main>
  </v-app>
</template>

<script>

  export default
{
    data () {
      return {
        drawer: false,
      }
  },
}
</script>