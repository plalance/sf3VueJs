<template>
    <div>
        <h1>Homepage VueJs</h1>
        <span v-if="user">{{ user.username }}</span>
        <div class="form" v-model="note">
            <input type="text" v-model="note.name">
            <textarea v-model="note.description"></textarea>
            <input type="date" v-model="note.date">
            <textarea v-model="note.complement"></textarea>
            <button @click="addNote"></button>
        </div>
        <div v-for="note in notes">
            <Note :note="note" @removeMe="removeNote"></Note>
        </div>
    </div>
</template>

<script>
    import _ from "lodash"
    import Note from './component/note.vue'
    export default{
        name: 'app',
        components: {
            Note
        },
        data(){
            return {
                user: {},
                notes: [],
                note: {}
            }
        },
        created() {
            let datas = this.$root.$data;
            this.user = datas.user;
            this.notes = datas.notes;
            this.note = datas.note;
        },
        computed: {
        },
        beforeMount() {
        },
        mounted(){
            let url = $.get(Routing.generate('api_profile', {'user_id': 1}));
            console.log(url);
            this.listNotes();
        },
        watch: {
        },
        methods: {
            listNotes(){
                this.notes = [{
                    id: 1,
                    date: '2016-04-12',
                    name: 'Ma super note',
                    complement: 'ne pas oublier de noter....'
                }];
            },
            addNote(){
                if(this.note.name){
                    this.notes.push(this.note);
                    this.note = {};
                }
            },
            removeNote(note){
                this.notes = _.pull(this.notes, note)
            }
        }
    }
</script>