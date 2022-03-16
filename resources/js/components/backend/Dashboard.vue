<template>

	<!-- <v-row justify="center">
        
		<v-card v-for="car in cars" :key="car.name" class="mx-auto mt-11" width="350">

    		<v-img height="250" :src="`/storage/`+car.image" ></v-img>

    			<v-card-title class="text-h4"> {{ car.brand }}, {{ car.model }} </v-card-title>

					<v-card-text>
						<div class="black--text text-h6"> Description: </div>
						<div> {{car.desc}} </div>
					</v-card-text>

						<v-card-text class="text-h6">
							<div class="black--text text-h6"> Tags: </div>
							{{car.tags}}
							
						</v-card-text>

							<v-card-text>

								<v-chip class="ma-2 text-button" color="success" label >
							
									<v-icon left> mdi-currency-usd </v-icon>
								
										{{car.price}}

								</v-chip>
						
							</v-card-text>

								<v-card-actions>

									<car-modal :id="car.id" :tags="car.tags"></car-modal>
									<v-spacer></v-spacer>
									<v-btn color="red" depressed @click="deleteCar(car.id)"> Remove</v-btn>

								</v-card-actions>
  			</v-card>
			  
	</v-row> -->
 <v-data-table :headers="headers" :items="cars" ref="table" class="elevation-1">

        <template v-slot:top>

            <v-toolbar flat >
                <v-toolbar-title> All Cars </v-toolbar-title>

                <v-divider class="mx-4" inset vertical ></v-divider>

                <v-spacer></v-spacer>

                <router-link to="admin/cars"  class="text-center mx-2" tag="button"> <v-btn text>New Car</v-btn> </router-link>

            </v-toolbar>

</template>

       <template v-slot:item.actions="{ item }">

             <car-form
            @callback="fetchCars"
            :id="item.id"
            :title="'Edit'"
            :action="'Edit'"
            :color="'success'"> 
            </car-form> 

            <car-form
            @callback="fetchCars"
            :id="item.id"
            :title="'Delete'"
            :action="'Delete'"
            :color="'red'"> 
            </car-form>  

			<car-form
            @callback="fetchCars"
            :id="item.id"
            :title="'Change status of'"
            :action="'Status'"
            :color="'white'"> 
            </car-form> 

       </template>
      
    </v-data-table>

</template>

<script>

import CarForm from "./utils/CarForm.vue"

  export default 
{
  components: { CarForm },
    data () {

        return {

            headers: [
				
                { text: 'ID', align: 'start', sortable: true, value: 'id', },
                { text: 'Brand', value: 'brand' },
                { text: 'Model', value: 'model' },
                { text: 'Engine', value: 'engine' },
                { text: 'Price $', value:  'price' },
                { text: 'Actions', value: 'actions'},
            ],

			cars: [],
        }
        
     },

    mounted() {
        this.fetchCars();
    },

    methods: {

        fetchCars: function() {

        this.axios .get('/api/cars').then(response => {

            this.cars = response.data;

             });

        },
	
    },
        
 
  
}

</script>