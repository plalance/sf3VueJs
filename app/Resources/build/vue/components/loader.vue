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
                    // Caché !
                    document.body.classList.add("loading");
                } else {
                    // Montré !
                    document.body.classList.remove("loading");
                }
            }
        }
    };
</script>