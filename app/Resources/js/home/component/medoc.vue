<template>
    <div>
        <h2>{{ medoc.name }}</h2>
    </div>
</template>

<script>
    export default{
        name: 'Medoc',
        components: {
        },
        props: {
            medoc: {
                type: Object,
                required: true
            },
        },
        beforeMount(){
        },
        data(){
            return this.medoc;
        },
        computed: {
        },
        mounted(){
        },
        watch: {
        },
        methods: {
        }
    }
</script>