<template>
    
    <v-dialog v-model="dialog" width="600px" persistent>

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
                      
                          <v-card-title><span class="headline"> {{title}} Brand</span></v-card-title>
                    
                            <v-card-text>
                             
                                <v-container>
                                    
                                    <v-row v-if="action!='Delete'">

                                        <v-col cols="12" sm="12">

                                            <v-text-field label="Brand" v-model="brand.brand"></v-text-field>
                                            
                                        </v-col>

                                    </v-row>

                                    <v-row v-else>

                                            <div class="font-weight-medium"> Are you sure you want to delete this brand? </div>
                                
                                    </v-row>

                                </v-container>

                         </v-card-text>

        <v-card-actions>
        
          <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="dialog = false, errors = null">Close</v-btn>
                
                <v-btn color="green darken-1" text @click="saveBrand()">Confirm</v-btn>

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
        brand: {},
        errors: null,
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
            if(this.dialog == true && this.action == "Edit")
            {
                this.getBrand();
                
            }
        },
    },

methods: {

      getBrand: function()
      {
        this.axios
            .get(`/api/brand/${this.id}`).then(response => {
                
                this.brand = response.data;
            
        });
        
      },

        /**
         * 
         */                             
        saveBrand : function()
        {
 
            if(this.dialog == true && this.action=="Edit") {
                this.UpdateBrand();
            }

            else if(this.action=="Create") {      
                this.storeBrand();
    
            }

            else {
                this.deleteBrand();
            }
            
        },
    
        UpdateBrand: function()
        {
                    this.axios.patch(`/api/brand/${this.id}`, this.brand).then((res) => {    
						this.$root.snackMsg = "Brand Updated!";
						this.$root.snackbar = !this.$root.snackbar;
						this.$emit('callback');
                        this.dialog = false;

                })
                .catch(e => {
                        this.errors = e.response.data;
                    });
        },

        storeBrand: function()
        {
                    this.axios.post('/api/brand', this.brand).then(response => {                          
							this.$root.snackMsg = "Brand Created!";
							this.$root.snackbar = !this.$root.snackbar;                           
						   	this.$emit('callback');              
                            this.errors = null;
                            this.dialog = false;
                            this.brand = {};
                    })
                        .catch(e => {
                              this.errors = e.response.data;
                    });   
        },

        deleteBrand: function()
        {
                    this.axios.delete(`/api/brand/${this.id}`).then(response => {     
							this.$root.snackMsg = "Brand Deleted!";
							this.$root.snackbar = !this.$root.snackbar;                     
                            this.$emit('callback');              
                            this.dialog = false;
                    })
                        .catch(e => {
                              this.errors = e.response.data;
                    });   
        },

        }

  }
</script>