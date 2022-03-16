<template>

    <v-dialog v-model="dialog"  width="650" height="auto" scrollable>

    	<template v-slot:activator="{ on, attrs }">

			<v-btn class="d-block text-center mx-auto" color="primary" v-bind="attrs" v-on="on" >

        		<v-icon left> mdi-cart-arrow-right </v-icon>

					CHECKOUT NOW

			</v-btn>

      </template>

        <v-card>
                     <v-alert v-if="errors != null" color="error" >
                              
                                <v-card class="mx-auto" max-width="400" tile dark> 

                                        <v-list-item v-for="error in errors" :key="error.data">
                                            
                                            <v-list-item-content>

                                                <v-list-item-title> - {{ error }} </v-list-item-title>

                                                     </v-list-item-content>

                                        </v-list-item>

                                </v-card>                                
                        </v-alert> 
			
        <v-card-title class="headline"> {{title}} Here </v-card-title>                                

        	<v-card-text>

				<v-form  method="POST" id="form" lazy-validation @submit.prevent="submit">

                    <csrf-token></csrf-token>

                            <v-container>
                                
                                <v-row>

                                    <v-col cols="12" md="12">

                                        <v-text-field v-model="form.name"  label="Name" :rules="rules"></v-text-field>
                                
                                    </v-col>

                                    <v-col cols="12" md="6" >

                                        <v-text-field v-model="form.state"  label="State" :rules="rules"></v-text-field>
                                
                                    </v-col>

                                    <v-col cols="12" md="6" >

                                        <v-text-field v-model="form.city"  label="City" :rules="rules"></v-text-field>
                                
                                    </v-col>

                                    <v-col cols="12" md="12" >

                                        <v-text-field v-model="form.zip"  label="ZIP CODE" :rules="rules"></v-text-field>
                                
                                    </v-col>
                                </v-row>

                            </v-container>

        				<v-card-actions>

          					<v-spacer></v-spacer>

          					<v-btn color="green darken-1" text @click="checkOut()"> Create order </v-btn>

        				</v-card-actions>

  				</v-form>

			</v-card-text>

    </v-card>

    </v-dialog>

</template> 

<script>

  export default {

    props: {
        
        title: {
            type: String,
            default: null,
        },
        action: {
            type: String,
            default: null,
        },
        
    },

    data () {
      return {
			dialog: false,
			form: {},
			errors: null,
			rules: [
			v => !!v || 'This field is required',
      		],

    	}
	},

	watch: {


	},

	methods: {

		checkOut: function()
		{
    
                    this.axios.post('/cart/checkout', this.form).then(response => {     
                        this.$emit('callback');    
                        this.$root.snackMsg = "Thank you for your order!";
						this.$root.snackbar = !this.$root.snackbar;
						this.dialog = false;  
                    })
                        .catch(e => {
                              this.errors = e.response.data;
							  console.log(e.response.data);
                    });   
        	
        },
    },

  }
</script>