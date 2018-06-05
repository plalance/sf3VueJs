<template>
    <div></div>
</template>
<script>
    export default {
        name: 'loader',
        props: {
            state: {
                default: true,
                type: Boolean
            }
        },
        computed: {},
        data() {
            return {
                // loading : this.state
            }
        },
        mounted() {
            document.body.classList.add("loading");
        },
        watch: {
            state: function () {
                if (this.state === true) {
                    console.log("caché !");
                    document.body.classList.add("loading");
                } else {
                    console.log("montré");
                    document.body.classList.remove("loading");
                }
            }
        }
    };
</script>