<template>
    
    <v-dialog v-model="dialog" width="500">

      <template v-slot:activator="{ on, attrs }">
            
        <v-btn :color="color" tag="button" v-bind="attrs" v-on="on"> {{action}} </v-btn>
            
                </template>

                    <v-card>

                        <v-alert v-if="errors != null" color="red lighten-2" >
                              
                                <v-card class="mx-auto" max-width="400" tile v-for="error in errors" :key="error.data" dark> 
                                        
                                        <v-list-item>

                                            <v-list-item-content>

                                                <v-list-item-title>- {{ error }}</v-list-item-title>

                                                     </v-list-item-content>

                                        </v-list-item>

                                     </v-card> 
                                  
                        </v-alert>
                      
                          <v-card-title><span class="headline"> {{title}} Car </span></v-card-title>
                    
                            <v-card-text>
                             
                                <v-container>
                                    
                                    <v-row v-show="action=='Edit'">
                                        
                                        <v-col cols="12" sm="6">

                                            <v-text-field label="Model" v-model="car.model"></v-text-field>
                                            
                                        </v-col>

                                        <v-col cols="12" sm="6">

                                            <v-text-field label="Engine" v-model="car.engine"></v-text-field>
                                            
                                        </v-col>
                                        <v-col cols="12" md="12">

                                            <v-text-field label="Price" v-model="car.price"></v-text-field>
                                        
                                        </v-col>
                                    </v-row>

                                    <v-row v-show="action=='Status'">

<<<<<<< HEAD
                                            <v-switch v-model="switch1" inset color="success" :label="`${check}`"></v-switch>
=======
                                            <v-switch v-model="switch1" inset  color="success" :label="`${check}`"></v-switch>
>>>>>>> 98641050c98556fa2b3a59856e6b497a00bd622b
                                
                                    </v-row>

                                    <v-row v-show="action=='Delete'">

                                            <div class="font-weight-medium"> Are you sure you want to delete this car? </div>
                                
                                    </v-row>

                                </v-container>

                         </v-card-text>

        <v-card-actions>
        
          <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="dialog = false, errors = null">Close</v-btn>
                
                <v-btn color="green darken-1" text @click="saveCar()">Confirm</v-btn>

                </v-card-actions>

                    </v-card>
    
            </v-dialog>

</template>

<script>
  export default {
    props: {
        id: {
            type: Number,
            default: null,
        }, 
        title: {
            type: String,
            default: null,
        },
        action: {
            type: String,
            default: null,
        },
        color: {
            type: String,
            default: null,
        },
    },

    data () {
      return {
        dialog: false,
        car: {},
        errors: null,
        switch1: false,
        check: '',
        brands: [],
        check: String,
      }
    },

     mounted() { },


    /**
     * 
     */
    watch: {

        /**
         * 
         */
        id: function()
        {

        },

        /**
         * 
         */
        dialog: function()
        {
            if(this.dialog == true && this.action == "Edit" || this.action == "Status")
            {
                this.fetchCar();
                this.fetchBrands();
            }
        },
    },

methods: {

		fetchCar: function()
      	{
        this.axios.get(`/api/cars/${this.id}`).then(response => {
                this.car = response.data;
				this.car.brand = this.car.brand.brand;

				if(this.car.status == 1) {
					this.switch1 = true;
					this.check = "Element Active";

				} else { 
					this.switch1 = false;
					this.check = "Element InActive";
				}
        });
        
     	},

        /**
         * 
         */                             
        saveCar: function()
        {
 
            if(this.dialog == true && this.action=="Edit") {
                this.UpdateCar();
            }

            else if(this.action=="Status") {      
                this.changeStatus();
            }

            else {
                this.deleteCar();
            }
            
        },
    
        UpdateCar: function()
        {
                    this.axios.patch(`/api/cars/${this.id}`, this.car).then((res) => {    
						this.$root.snackMsg = "Car Updated!";
						this.$root.snackbar = !this.$root.snackbar;
						this.$emit('callback');
                        this.dialog = false;

                })
                .catch(e => {
                        this.errors = e.response.data;
                    });
        },

        changeStatus: function()
        {
					var data = {status: this.switch1};

                    this.axios.patch(`api/cars/${this.id}`, data).then(response => {    
						this.$emit(this.fetchCar());

					})
                        .catch(e => {
							console.log(e);
                    });  
        },

        deleteCar: function()
        {
                    this.axios.delete(`/api/cars/${this.id}`).then(response => {     
							this.$root.snackMsg = "Car Deleted!";
                            this.$root.snackColor = "info";
							this.$root.snackbar = !this.$root.snackbar;                     
                            this.$emit('callback');              
                            this.dialog = false;
                    })
                        .catch(e => {
                              this.errors = e.response.data;
                    });   
        },

        fetchBrands() {

        this.axios .get('/api/brand/').then(response => {

            this.brands = response.data;

             });

        },

        }

  }
</script>