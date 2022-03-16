<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" value="{{ csrf_token() }}" />
    
        <title>AutoScout</title>
    
        <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" />

        <script>

            @php
                // if(! Auth::check())
                // {
                //     // echo 'window.location.href = "/home?login=true"';
        
                // }else{
                    $windowApp = array(
                        'errors' => session('error')    ?? '',
                        'status' => session('status')   ?? '',
                        'warning' => session('warning') ?? '',
                        'success' => session('success') ?? '',
                        'side_bar'     => Config::get('menu.sidebar'),
                        // 'user'         => \App\Models\User::where('id', auth()->user()->id)->first(),
                    );
                    $windowApp_json = json_encode($windowApp);
                    echo "window.App = '".base64_encode($windowApp_json)."';";
            
                // }
            @endphp
        
        
        </script>
    
    </head><body>

    <div id="app">

        <v-app>

            <template>
 	               
                   <v-navigation-drawer v-model="drawer" app class="pt-4" color="grey lighten-3" >
           
                       <v-btn class="d-block text-center mx-auto mb-9">HOME</v-btn>

                       <v-btn class="d-block text-center mx-auto mb-9">CARS</v-btn>

                       <v-btn class="d-block text-center mx-auto mb-9">CART</v-btn>

                   </v-navigation-drawer>
           
                       <v-app-bar app color="white">

                             <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

                           <v-toolbar-title class="font-weight-bold">

                               AUTOSCOUT <v-icon right color="red" class="text-h3"> mdi-car-hatchback </v-icon>
							   
                            </v-toolbar-title>

                               <v-spacer></v-spacer>

                           <cart-modal></cart-modal>

                           </v-app-bar>
           
               			<v-main>

            		<router-view style="padding:20px" > </router-view>

               </v-main>

           </template>
        
        </v-app>

    </div>

        <script src="{{ asset('js/app.js?'.config('app.key')) }}"></script> 
		{{-- <script type="text/javascript">

			var user = ;

</script> --}}
    </body>

</html>
