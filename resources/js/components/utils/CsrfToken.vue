<template>
    <input type="hidden" name="_token" :value="csrf_token">
</template>

<script>
    export default {

        /**
         *
         */
        data () {

            return {

                csrf_token: ''

            }
        },

        /**
         *
         */
        mounted() {

            this.init();

        },

        /**
         *
         */
        updated() {

            this.init();

        },

        /**
         *
         */
        methods: {

            init: function()
            {
                let token = document.head.querySelector('meta[name="csrf-token"]');

                this.csrf_token = token.content;

            }

        }

    };
</script>

<style scoped>

</style>