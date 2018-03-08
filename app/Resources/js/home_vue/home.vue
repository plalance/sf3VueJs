<template>
    <div>
        <h2>Homepage VueJs</h2>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="note_name" type="text" class="validate">
                        <label for="note_name" v-model="note.name">Intitulé</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="description" class="materialize-textarea" v-model="note.description"></textarea>
                        <label for="description">Description</label>
                    </div>
                    <div class="col s12">
                        <label for="date">Date</label>
                        <input id="date" type="text" class="datepicker" v-model="note.date">
                    </div>
                    <div class="input-field col s12">
                        <textarea id="complement" class="materialize-textarea" v-model="note.complement"></textarea>
                        <label for="complement">Complément d'information</label>
                    </div>
                </div>
                <div class="row">
                    <a class="waves-effect waves-light btn" @click="addNote">Ajouter</a>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col s4" v-for="note in notes">
                <Note :note="note" @removeMe="removeNote"></Note>
            </div>
        </div>

        <!--<span v-if="user">{{ user.username }}</span>-->
        <!--<div class="form" v-model="note">-->
            <!--&lt;!&ndash;<input type="text" v-model="note.name">&ndash;&gt;-->
            <!--&lt;!&ndash;<textarea v-model="note.description"></textarea>&ndash;&gt;-->
            <!--&lt;!&ndash;<input type="date" v-model="note.date">&ndash;&gt;-->
            <!--&lt;!&ndash;<textarea v-model="note.complement"></textarea>&ndash;&gt;-->
            <!--<button @click="addNote"></button>-->

        <!--</div>-->
        <!--<div v-for="note in notes">-->
            <!--<Note :note="note" @removeMe="removeNote"></Note>-->
        <!--</div>-->
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

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: false // Close upon selecting a date,
            });
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