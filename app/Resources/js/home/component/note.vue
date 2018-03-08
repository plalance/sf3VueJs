<template>
    <div>
        <h2>{{ note.name }}</h2>
        <div>
            <p>Description : {{ note.description }}</p>
            <p>Date : {{ note.date }}</p>
            <p>Complément : {{ note.complement }}</p>
            <a href="#!" @click="$emit('removeMe', this.note)">Suprimer cette note</a>
        </div>
    </div>
</template>

<script>
    export default{
        name: 'Note',
        components: {
        },
        props: {
            note: {
                type: Object,
                required: true
            },
        },
        beforeMount(){
        },
        data(){
            return this.note;
        },
        computed: {
        },
        mounted(){
            let url = $.get(Routing.generate('api_profile', {'user_id': 1}));
            console.log(url);
        },
        watch: {
        },
        methods: {
        }
    }
</script>