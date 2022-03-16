<template>

    <v-dialog v-model="dialog" transition="dialog-top-transition" width="650" height="auto" scrollable>

    	<template v-slot:activator="{ on, attrs }">

        <v-btn color="black" text v-bind="attrs" v-on="on"> <v-icon right> mdi-car-info </v-icon> Car info  </v-btn>

    	</template>

	<template>

      	<v-card width="auto">

			<v-img height="200px" :src="`/storage/`+car.image">

				<v-spacer></v-spacer>

			</v-img>

				<v-card-title  class="black--text mt-5">

					<p class="ml-3 text-h3" > {{car.brand}} </p>

				</v-card-title>

				<v-card-text>

					<div class="font-weight-bold text-h5 ml-8 mb-2">  {{car.model}}  </div>
				
						<v-timeline align-top dense>

								<v-timeline-item small>

									<div>
										
										<div class="font-weight-normal">
											
											<strong class="text-subtitle-2 font-weight-bold">Descripiton: {{car.description}}</strong>
										
										</div>
						
									</div>

								</v-timeline-item>

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

										<strong class="text-subtitle-2 font-weight-bold">Tags: {{tags}}</strong>
									</div>

								</div>

							</v-timeline-item>

						</v-timeline>
    		
			
				<v-card-actions left>

						<v-alert type="info" class="mt-4" v-if="$root.cart!=null && car.id in $root.cart">  Item already added in cart. You can change it's quantity in the cart.  </v-alert>

						<v-btn color="success" v-else depressed @click="addToCart()" > + ADD TO CART</v-btn>

        		</v-card-actions>

				</v-card-text>

    	</v-card>

	</template>

</v-dialog>

</template>

<script>
  export default {
    props: {  
        id: {
            type: Number,
            default: null,
        }, 
		tags: {
            type: String,
            default: null,
        }, 
		type: {
            type: String,
            default: null,
        }, 
	},
    data () {
      return {
        dialog: false,
        car: [],
		cart: {},
		toCart: [],
      }
    },

	watch: {

   		dialog: function()
        {
            if(this.dialog == true){
				this.fetchCar();
			}

		},
		
	},

	mounted() {},

	methods: {

		fetchCar: function()
      	{
        this.axios.get(`/api/cars/${this.id}`).then(response => {
                this.car = response.data;
				this.car.brand = this.car.brand.brand;
				this.checkCart();
  
        });
        
     	},

		addToCart: function()
      	{			
			var carData = new FormData();
			carData.append('id', this.car.id);
			carData.append('car', this.car.brand +" "+ this.car.model);
			carData.append('price', this.car.price);

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
                    this.axios.get(`/cart/checkCart/`).then(response => {    
							this.cart = response.data.cart;
                    })

     	},

	},
	
  }
</script>