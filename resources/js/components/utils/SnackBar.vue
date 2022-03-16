<template>

	<div class="text-center ma-2">

    	<v-snackbar v-model="$root.snackbar" :top="true" :color="$root.snackColor">
      		
			{{ $root.snackMsg }}

      		<template v-slot:action="{ attrs }">
        
				<v-btn color="white" text v-bind="attrs" @click="$root.snackbar = false"> Close </v-btn>
			
			</template>
    
		</v-snackbar>
  	
	</div>

</template>

<script>
  export default {}
</script>