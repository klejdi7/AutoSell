<template>
    <v-menu offset-y>

      		<template v-slot:activator="{ attrs, on }">

				<v-text-field class="mx-3" 
				v-model="search.term" 
                label="Search by car model, engine size, price" 
				v-bind="attrs"
				v-on="on" 
				v-on:input="searchCars"
                autocomplete="off"				
                >
				</v-text-field>
					
      		</template>

				<v-list>

					<v-list-item
					v-for="item in items"
					:key="item.id"
					link
					>
					<v-list-item-title v-text="item.model">

                    </v-list-item-title>
              <v-list-item-action>

                <car-modal :id="item.id" class="p-5"></car-modal>

              </v-list-item-action>
         
    			</v-list-item>

			</v-list>
			
    	</v-menu>

</template>

<script>
  export default {
      
      data () {
      return {

			search: {},
            items: [],
    	}
	},
    
    methods: {

            searchCars: function() {
	
    	    this.axios .post(`/api/search/${this.search.term}`).then(response => {
				
            this.items = response.data;

			console.log(this.items);

            });

        },
    }
    }
</script>