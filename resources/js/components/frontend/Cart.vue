<template>

<v-card height="auto" color="white">

			<v-card-title class="headline">  Your Shopping Cart </v-card-title>

				<v-card-text v-if="errors"> {{errors.cart_msg}} </v-card-text>

						<v-row justify="center" class="mt-4" v-else >

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

							<v-alert dense type="success" v-if="!errors">  TOTAL: ${{cart.total}}  </v-alert>

						</v-row>

					<v-card-actions>

						<v-spacer></v-spacer>

			            <v-alert type="info" class="mt-4" v-if="!this.$root.isLoggedin"> You need to login to checkout! </v-alert>

						<checkout-modal v-if="cart.total>0&&this.$root.isLoggedin" @callback="getCart" ></checkout-modal>

				</v-card-actions>

		</v-card>

</template>

<script>
import CheckoutModal from "../utils/CheckoutModal.vue"

  export default
{
  components: { CheckoutModal },

    data () {
      return {
        errors: null,
		cart: {},
      	expand: false,
		qty: "",
      }
    },

	watch: {},

	created() {this.getCart();},

	methods: {

	getCart: function()
	{
		this.errors = null;

		this.axios.get(`/cart/cart`).then(response => {

            this.cart = response.data;
        })
		.catch(e => {

			this.errors = e.response.data;

		});

	},

	deleteCartItem: function(id)
	{

		this.axios.delete(`/cart/removeItem/${id}`).then(response => {

			this.$emit(this.$root.getCart(), this.getCart());
<<<<<<< HEAD
            // this.cart = response.data;
=======

>>>>>>> 98641050c98556fa2b3a59856e6b497a00bd622b
        })
		.catch(e => {
			this.errors = e.response.data.cart_msg;
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