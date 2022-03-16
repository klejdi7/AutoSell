<template>

    <v-data-table :headers="headers" :items="brands" ref="table" class="elevation-1">

        <template v-slot:top>

            <v-toolbar flat >
                <v-toolbar-title> Brands </v-toolbar-title>

                <v-divider class="mx-4" inset vertical ></v-divider>

                <v-spacer></v-spacer>

                    <brand-form
                        @callback="fetchBrands"
                        :title="'Create'"
                        :action="'Create'"
                        :color="'blue'"> 
                    </brand-form> 

            </v-toolbar>

</template>

       <template v-slot:item.actions="{ item }">

            <brand-form
            @callback="fetchBrands"
            :id="item.id"
            :title="'Edit'"
            :action="'Edit'"
            :color="'success'"> 
            </brand-form> 

            <brand-form
            @callback="fetchBrands"
            :id="item.id"
            :title="'Delete'"
            :action="'Delete'"
            :color="'red'"> 

            </brand-form> 
       </template>
      
    </v-data-table>


</template>

<script>

import BrandForm from "./utils/BrandForm.vue"

  export default 
{
  components: { BrandForm },

    data () {

        return {

            headers: [
                { text: 'ID', align: 'start', sortable: true, value: 'id', },
                { text: 'Brand', value: 'brand' },
                { text: 'Actions', value: 'actions'},
            ],

            brands : [],

        }
        
     },
    mounted() {

        this.fetchBrands();

    },

    methods: {

        fetchBrands() {

        this.axios .get('/api/brand/').then(response => {

            this.brands = response.data;

             });

        },

    },
        
}
</script>