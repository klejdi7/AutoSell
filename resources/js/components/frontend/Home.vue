<template>
	
	<v-container>

		<search-box></search-box>
	
			<v-row justify="center">
				
				<v-card v-show="car.status==1" v-for="car in cars" :key="car.name" class="mx-auto mt-11" width="350" >

					<v-img height="250" :src="`/storage/`+car.image" ></v-img>

						<v-card-title class="text-h4"> {{ car.brand }}, {{ car.model }} </v-card-title>

							<v-card-subtitle>
      							
								{{car.tags}}
    							
							</v-card-subtitle>

							<v-card-text>

								<v-timeline align-top dense>

										<v-timeline-item small>
								
											<div>

												<div class="font-weight-normal">

													<strong class="text-subtitle-2 font-weight-bold">Engine size: {{car.engine}}</strong>
												</div>

											</div>

										</v-timeline-item>
									
										<v-timeline-item small>

												<div>

													<div class="font-weight-normal">

														<strong class="text-subtitle-2 font-weight-bold">Price: {{car.price}}$</strong>
													</div>

												</div>

										</v-timeline-item>

										<v-timeline-item small>
								
											<div>

												<div class="font-weight-normal">

												<strong class="text-subtitle-2 font-weight-bold">Tags: {{car.tags}}</strong>
												
												</div>

											</div>

									</v-timeline-item>

								</v-timeline>        
			
							</v-card-text>  
							
						<v-card-actions>
							<!-- if ( "my property name" in myObject ) -->

							<v-alert v-if="$root.cart!=null && car.id in $root.cart" type="info" class="mt-4">  Item already added in cart. You can change it's quantity in the cart.  </v-alert>

							<v-btn  v-else color="green lighten-2 white--text" @click="addToCart(car.id, car.brand +' '+ car.model, car.price)"> Add to cart </v-btn>

						</v-card-actions>

				</v-card>
					
			</v-row>

</v-container>
</template>

<script>

import CarModal from "../utils/CarModal.vue"
import SearchBox from "../utils/SearchBox.vue"


  export default 
{
  components: { CarModal,SearchBox },

    data () {

        return {

            cars : {},
			disabled: false,
			check: Boolean,
			cart: {},
        }
        
     },

	watch: {},

    mounted() {
        this.fetchCars();
		this.checkCart();
    },

    methods: {

        fetchCars() {

        this.axios .get('/api/cars').then(response => {

            this.cars = response.data;
            
			});

        },

		addToCart: function(id, car, price)
				{	
						var carData = new FormData();
						carData.append('id', id);
						carData.append('car', car);
						carData.append('price', price);
						
						this.axios.post('/cart/addToCart', carData).then(response => {    
							this.$root.snackMsg = "Item added to cart";
							this.$root.snackbar = !this.$root.snackbar;
							this.$root.snackColor = "info";
							this.dialog = false;
							this.$emit(this.$root.getCart(), this.checkCart());		

						})
							.catch(e => {
						}); 
     	},
		
		checkCart: function()
      	{			
                    this.axios.get(`/cart/checkCart`).then(response => {    
						this.cart = response.data.cart;
				});

     	},

    },
        
 
  
}

</script>