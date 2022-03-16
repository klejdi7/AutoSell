<template>

 	<v-form  method="POST" id="form" :action=" '/login'" ref="form" lazy-validation @submit.prevent="submit">
	 
                    <csrf-token></csrf-token>

   					<v-container>

                        <v-alert v-if="errors != null" color="red lighten-2" >
                              
                                <v-card class="mx-auto" max-width="400" tile v-for="error in errors" :key="error.data" dark> 
                                        
                                        <v-list-item>

                                            <v-list-item-content>

                                                <v-list-item-title>- {{ error }}</v-list-item-title>

                                                     </v-list-item-content>

                                        </v-list-item>

                                     </v-card> 
                                  
                        </v-alert>

						<v-row>
       					
							<v-col cols="12" md="6" >

        						<v-text-field v-model="email" name="password" label="Email" :rules="rules"></v-text-field>
        				
							</v-col>

							<v-col cols="12" md="6" >

        						<v-text-field v-model="password" name="password" label="Password" :rules="rules" type="password" ></v-text-field>
        				
							</v-col>

     					 </v-row>

    				</v-container>

        				<v-card-actions>

          					<v-spacer></v-spacer>

          						<v-btn color="green darken-1" text @click="loginUser()"> Sign in </v-btn>

        				</v-card-actions>
						
  				</v-form>

</template>

<script>
  export default {
	data: () => ({
    valid: true,
    email: '',

    password: '',
    rules: [
        v => !!v || 'Field is required',
      ],
	errors: null,
    }),



    watch: {},
        
    methods: {

      	loginUser: function()
		{

			var formData = new FormData();

			formData.append('email', this.email);
			formData.append('password', this.password);

                this.axios.post('/login', formData).then(response => {                          						
                        if(response.data.user.role != 1){                    
                        location.reload();

                        } else {
                        window.location.href = '/admin/';
                        }
                    })
                .catch(e => {
                        this.errors = e.response.data;
                    });   
		},

		validate () {
			this.$refs.form.validate()
		},
    },
  }
</script>