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
    			
                </v-card-text>
                
                    <v-card-actions >
        
                        <v-container fluid>

                            <v-card elevation="3" dark>

                                <v-card-title> Change car status </v-card-title>

                                <v-card-text >
                                    
                                    <v-switch v-model="switch1" inset @click="carStatus()" color="success" :label="`${check}`"></v-switch>
									
                                </v-card-text>
                                
                            </v-card>

                        </v-container>

                    </v-card-actions>

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
	},
	
    data () {
      return {
        dialog: false,
        car: [],
        switch1: false,
		check: String,
        }
    },

	watch: {

   		dialog: function()
        {
            if(this.dialog == true){
				this.fetchCar();
				// console.log(this.car.status);

			}

		},
		
	},

	beforeMount() {
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

		carStatus: function()
      	{			
					var data = {status: this.switch1};

                    this.axios.patch(`api/cars/${this.id}`, data).then(response => {    
						this.$emit(this.fetchCar());

					})
                        .catch(e => {
							console.log(e);
                    }); 
     	},
	},
	
  }
</script>