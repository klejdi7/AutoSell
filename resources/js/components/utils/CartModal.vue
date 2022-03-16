<template>

    <v-dialog v-model="dialog" transition="dialog-top-transition" width="650" height="auto" scrollable>

    	<template v-slot:activator="{ on, attrs }">
							
				<v-btn color="black" class="text-center mx-2" fab text v-bind="attrs" v-on="on">

					<v-badge color="green" :content="$root.cartItems">
						
								<v-icon> mdi-cart </v-icon>
					</v-badge>

				</v-btn>

    	</template>

		<v-card height="auto" color="white">

			<v-card-title class="headline">  Your Shopping Cart </v-card-title>
				
				<v-card-text v-if="errors"> {{errors.cart_msg}} </v-card-text>
			
						<v-row justify="center" class="mt-4" v-else>
    							
							<v-expansion-panels popout class="mb-4" >
      							
								<v-expansion-panel v-for="(item,i) in cart.cart" :key="i">

        							<v-expansion-panel-header> {{item.car}}   
										
										<v-chip class="ma-2 text-button" color="success" label  width="100">
											
											<v-icon left> mdi-currency-usd </v-icon>
												
												{{item.price_s}}
										</v-chip>
									
									</v-expansion-panel-header>
        								
										<v-expansion-panel-content>
          									
											<v-timeline align-top dense>

												<v-timeline-item small>

													<div>
														
														<div class="font-weight-normal">
															
															<strong class="text-subtitle-2 font-weight-bold">Name: {{item.car}}</strong>
														
														</div>
										
													</div>

												</v-timeline-item>

												<v-timeline-item small>

														<div>

															<div class="font-weight-normal">

																<strong class="text-subtitle-2 font-weight-bold">Price: ${{item.price_t}}</strong>

															</div>

														</div>

												</v-timeline-item>

												<v-timeline-item small>
										
													<div>

														<div class="font-weight-normal">

															<strong class="text-subtitle-2 font-weight-bold">Quantity: {{item.qty}}</strong>
														</div>

													</div>

												</v-timeline-item>

											</v-timeline>

											<v-btn color="success" class="ma-2" outlined @click="expand = !expand" > Edit item </v-btn>
											<v-btn color="red" class="ma-2" outlined @click="deleteCartItem(item.car_id)" > Remove item </v-btn>
											     
												<v-expand-x-transition>

													<div v-show="expand">

														<v-text-field v-model="qty" v-show="expand" class="mx-3" label="Quantity" ></v-text-field>
														<v-btn color="success"  class="ma-2" @click.stop="editItem(item.car_id)" @click="expand = !expand" > Update </v-btn>
													
													</div>

											</v-expand-x-transition>

        								</v-expansion-panel-content>
      							
								</v-expansion-panel>
    
							</v-expansion-panels>
							
							<v-alert dense type="info" v-if="!errors">  TOTAL: ${{cart.total}}  </v-alert>
  						
						</v-row>
					
					<v-card-actions>
						
						<v-spacer></v-spacer>
						
						<router-link to="/cart" tag="button">

						<v-btn color="green darken-1" v-show="this.$root.isLoggedin" text @click="dialog=false"> Checkout </v-btn>

                        </router-link>
						
						<v-btn color="green darken-1" text @click="dialog = false"> Close </v-btn>

				</v-card-actions>

		</v-card>

    </v-dialog>

</template>

<script>
  export default {

    data () {
      return {
        dialog: false,
        errors: null,
		cart: {},
      	expand: false,
		qty: "",
		count: null,
      }
    },

	watch: {
	dialog: function()
	{
		if(this.dialog == true){
			this.getCart();
		}
	}
	},

	mounted() {},

	methods: {
    getCart()
	{

		this.axios.get(`/cart/cart`).then(response => {

        this.cart = response.data;

    })

		.catch(e => {
		
			this.errors = e.response;
        
		});

	},
	deleteCartItem: function(id)
	{

		this.axios.delete(`/cart/removeItem/${id}`).then(response => {

			this.$emit(this.$root.getCart(), this.getCart());
			// this.$emit(this.getCart());					

        })
		.catch(e => {
			this.errors = e.response.data;
	});

	},

	editItem: function(id)
	{

		var qty = new FormData();
		qty.append('q', this.qty);

		this.axios.post(`/cart/updateItem/${id}`, qty).then(response => {
  
			this.$emit(this.getCart());
			this.expand = false;
			this.qty = null;
        })
		.catch(e => {
		
		});

	},

	},

  }
</script>