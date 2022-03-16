<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
@include('layouts.backend.head')
<body>

    <div id="app">

        <v-app>

            <template>

                <div>
  
					<v-app-bar color="deep-purple accent-4" dense dark>

                    	<v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
              
                    		<v-toolbar-title>AUTOSCOUT <v-icon right color="red" class="text-h3"> mdi-car-hatchback </v-icon></v-toolbar-title>
              
                    <v-spacer></v-spacer>
                            
                  </v-app-bar>

				  <v-navigation-drawer v-model="drawer" absolute temporary>

				  	<v-list nav dense>

						<v-list-item-group active-class="deep-purple--text text--accent-4">

						<v-list-item :to="'/admin'"> 
							
							<v-list-item-icon>
						  		
								<v-icon>mdi-home</v-icon>

							</v-list-item-icon>
						
								<v-list-item-title> Home</v-list-item-title>
					  
						</v-list-item>
			
						<v-list-item :to="'/admin/cars'">

							<v-list-item-icon>
								
								<v-icon>mdi-car</v-icon>

							</v-list-item-icon>

								<v-list-item-title> Add Cars</v-list-item-title>

						</v-list-item>

						<v-list-item :to="'/admin/brands'">

							<v-list-item-icon>
								
								<v-icon>mdi-cryengine</v-icon>

							</v-list-item-icon>

								<v-list-item-title> Brands </v-list-item-title>

						</v-list-item>

						<v-list-item :href="'/'">

							<v-list-item-icon>
								
								<v-icon>mdi-home</v-icon>

							</v-list-item-icon>

								<v-list-item-title> Home Page </v-list-item-title>

						</v-list-item>

						<v-list-item :href="'/logout'">

							<v-list-item-icon>
								
								<v-icon>mdi-exit-to-app</v-icon>

							</v-list-item-icon>

								<v-list-item-title> Logout </v-list-item-title>

						</v-list-item>

					</v-list-item-group>

				  </v-list>

				</v-navigation-drawer>

                </div>

				<v-main>

            		<router-view style="padding:20px" > </router-view>
                    <snack-bar></snack-bar>

               </v-main>

              </template>

        </v-app>

    </div>

        <script src="{{ asset('js/app.js?'.config('app.key')) }}"></script> 

    </body>

</html>
