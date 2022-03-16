<template>

    <v-dialog v-model="dialog"  width="650" height="auto" scrollable>

    	<template v-slot:activator="{ on, attrs }">

			<v-btn class="text-center mx-2" color="white" v-bind="attrs" v-on="on" >

        		<v-icon left> mdi-lock </v-icon>

					{{title}}

			</v-btn>

      </template>

    <v-card>
                     <v-alert v-if="errors != null" color="red lighten-2" >
                              
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

				<v-form  method="POST" id="form" action="/login" lazy-validation @submit.prevent="submit">

                    <csrf-token></csrf-token>

                            <v-container>
                                
                                <v-row>

                                    <v-col cols="12" md="12" v-if="action == 'register'">

                                        <v-text-field v-model="user.name"  label="Name" :rules="rules"></v-text-field>
                                
                                    </v-col>

                                    <v-col cols="12" md="6" >

                                        <v-text-field v-model="user.email"  label="Email" :rules="rules"></v-text-field>
                                
                                    </v-col>

                                    <v-col cols="12" md="6" >

                                        <v-text-field v-model="user.password" label="Password" :rules="rules" type="password" ></v-text-field>
                                
                                    </v-col>

                                </v-row>

                            </v-container>

        				<v-card-actions>

          					<v-spacer></v-spacer>

          					<v-btn color="green darken-1" text @click="actionUser()"> {{title}} </v-btn>

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
			user: {},
			errors: null,
			rules: [
			v => !!v || 'This field is required',
      		],
    	}
	},

	watch: {


	},

	methods: {

		loginUser: function()
		{
    
                    this.axios.post('/data/login', this.user).then(response => {     
                         
                        if(response.data.user.role != 1){                    
                        location.reload();

                        } else {
                        window.location.href = '/admin/';
                        }

                        })

                        .catch(e => {
                              this.errors = e.response.data;
							  console.log(e.response.data);
                    });   
        	
        },

		registerUser: function()
		{
    
                    this.axios.post('/data/register', this.user).then(response => {                          
                    })
                        .catch(e => {
                              this.errors = e.response.data;
							  console.log(e.response.data);
                    });   
        	
        },

        actionUser : function()
        {
 
            if(this.dialog == true && this.action=="login")
            {
                    this.loginUser();
            }

            else
            {      
                    this.registerUser();
                    
            }
            
        },
    },

  }
</script>