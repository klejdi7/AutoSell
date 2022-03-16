<template>

	<v-card elevation="2" class="mt-5"> 

		<v-card-title> Add New Car </v-card-title>
	
			<v-form v-model="valid" method="POST">

				<v-container>

				<v-row>
				
					<v-col cols="12" md="4">

						<v-subheader> Car Brand </v-subheader>

							<v-select v-model="car.brand" :items="brands" item-text="brand" item-value="id" label="Brand" persistent-hint return-object single-line></v-select>
					
					</v-col>

					<v-col cols="12" md="4">

						<v-subheader> Car Model </v-subheader>

							<v-text-field v-model="car.model"  label="Car Model" required ></v-text-field>
					
					</v-col>

					<v-col cols="12" md="4">

						<v-subheader> Car Description </v-subheader>

							<v-text-field v-model="car.desc" label="Car Description" required ></v-text-field>
					
					</v-col>

					<v-col cols="12" md="4">

						<v-subheader> Car Tag </v-subheader>

							<!-- <v-select v-model="car.tag" :items="tags" item-text="tag" item-value="tags.id" label="Brand" persistent-hint return-object single-line></v-select> -->
								<v-combobox v-model="car.tags" clearable multiple small-chips></v-combobox>

					</v-col>

					<v-col cols="12" md="4">

						<v-subheader> Car Price </v-subheader>

							<v-text-field v-model="car.price"  label="Car Price" required ></v-text-field>
				
					</v-col>

					<v-col cols="12" md="4">

						<v-subheader> Engine Size </v-subheader>

							<v-text-field v-model="car.engine"  label="Engine size" required></v-text-field>
				
					</v-col>

					<v-col cols="12" md="12">

						<v-subheader> Car Image </v-subheader>

							<v-file-input  label="Image" v-model="car.image" filled prepend-icon="mdi-camera"></v-file-input>
					
					</v-col>

					<v-btn color="green darken-1"  @click="addCar()"> Add Car </v-btn>

				</v-row>

				</v-container>

			</v-form>

	</v-card>
	
</template>

<script>
  export default {
    data: () => ({

		valid: false,
		car: {},
		brands: [],
		tags: [],

    }),


	mounted() {
		this.fetchData();	
	},

	watch: {
		car: function(){
			// if(this.car.tags){
			// 	console.log(this.car.tags);
			// }
		}
	},

	methods: {

		fetchData(){

			this.axios .get('/api/brand').then(response => {

            	this.brands = response.data;

            });
		},
		addCar(){
			let formData = new FormData();

				formData.append('brand', this.car.brand.id);
				formData.append('model', this.car.model);
				formData.append('tag', this.car.tags);
				formData.append('desc', this.car.desc);
				formData.append('price', this.car.price);
				formData.append('img', this.car.image);
				formData.append('engine', this.car.engine);

			this.axios .post('/api/cars', formData).then(response => {
				this.$root.snackMsg = "Car Added!";
				this.$root.snackbar = !this.$root.snackbar;
				this.car = {};
            });
		}
	},
  }
</script>