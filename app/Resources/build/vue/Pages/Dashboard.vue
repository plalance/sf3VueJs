<template>
    <div id="app">
        <Loader :state="state"></Loader>
        <div class="row">
            <h1 class="title" v-if="!user.id">Aucun User connecté</h1>
            <div v-else="" class="row">
                <div class="col S12 m6">
                    <h1>{{ user.username }}</h1>
                    <p>Email : {{ user.email }}</p>
                    <p>Roles : {{ user.roles }}</p>
                    <p>Activé : {{ user.enabled ? 'Activé' : 'Non Activé' }}</p>
                    <input type="text" v-model="notification_content">
                    <button @click="notifyAdmin()">Envoyer un mail de notification</button>
                    <button @click="logout()">Se déconnecter</button>
                </div>
                <div class="col s12 m6">
                    <div>
                        <h3>Sa présentation</h3>
                        <div v-html="user.presentation"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col S12 m6">
                    <select id="super" name="super" v-model="userId" @change="usurpateUser()" class="material-select">
                        <option v-for="user in users" :value="user.id">Se connecter avec {{ user.username }}</option>
                    </select>
                    <label for="super">Se connecter en tant que :</label>
                </div>
            </div>
        </div>
        <!--<form class="uk-form">-->
        <!--<fieldset data-uk-margin>-->
        <!--<l>Se connecter en tant que :</l>-->
        <!--<select v-model="userId" @change="usurpateUser()">-->
        <!--<option v-for="user in users" :value="user.id">Se connecter avec {{ user.username }}</option>-->
        <!--</select>-->
        <!--</fieldset>-->
        <!--</form>-->

        <h2 class="title">User connecté :</h2>
        <div class="row">
            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Editeur de texte</span>
                        <vue-quill-editor class="quill-editor" v-model="content"
                                          ref="myQuillEditor"
                                          :options="editorOption"
                                          @blur="onEditorBlur($event)"
                                          @focus="onEditorFocus($event)"
                                          @ready="onEditorReady($event)">
                        </vue-quill-editor>
                    </div>
                    <div class="card-action">
                        <button @click="sendEmailContent()">Envoyer ce contenu par mail</button>
                        <button @click="updatePresentation()">Définir comme nouvelle présentation</button>
                        <button @click="updateSample()">Merge sample</button>
                    </div>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="card">
                    <div class="card-image">
                        <img :src="staticFolder + 'images/mapa1.svg'" alt="">
                        <span class="card-title">Géographie</span>
                    </div>
                    <div class="card-content">
                        <p>Carte du monde</p>
                    </div>
                    <div class="card-action">
                    </div>
                </div>
            </div>

            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Localisation</span>
                        <Gmap :marker-coordinates="markerCoordinates" :name="'supermap'" :zoom="14"></Gmap>
                    </div>
                    <div class="card-action">
                        <a href="/cartography">Voir la cartographie</a>
                    </div>
                </div>
            </div>

            <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">ChartJs</span>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="card-action">
                        <textarea name="" id="" cols="30" rows="10" v-model="chartText"></textarea>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js';
    import Gmap from '../components/google-map';
    import Loader from '../components/loader';
    // import Quill from 'quill';
    import VueQuillEditor from 'vue-quill-editor';

    export default {
        name: 'dashboard',
        components: {
            Gmap, Loader,
            VueQuillEditor: VueQuillEditor.quillEditor
        },
        data: function () {
            return {
                user: {},
                users: [],
                notification_content: "",
                staticFolder: "",
                chartText: "",
                myDoughnutChart: {},
                dataChart: {
                    labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                markerCoordinates: [{
                    latitude: 47.6425875,
                    longitude: 6.844186600000057
                }],
                state: true,
                userId: 0,
                content: '<h2>I am Example</h2>',
                editorOption: {
                    // some quill options
                },
                sample: {}
            }
        },
        beforeMount(){
            let datas = this.$root.$data;
            this.user = datas.user;
        },
        created() {
//            this.user = datas.user;
            this.user = datas.user;
            this.staticFolder = datas.staticFolder;

            this.loadUsers();
            this.loadSample();
        },
        computed: {
            getDatas() {
                return JSON.parse(this.chartText);
            },
            editor() {
                return this.$refs.myQuillEditor.quill
            }
        },
        beforeMount() {
            this.chartText = JSON.stringify(this.dataChart);
        },
        mounted() {
            // user déjà en session (app.user) => On set son id pour le userId du select
            if (this.user.id) {
                this.$set(this, 'userId', this.user.id);
            }
            // let url = Routing.generate('example', {'user_id': 1});
            let ctx = document.getElementById("myChart");
            this.myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: this.dataChart,
                options: {}
            });
            console.log('this is current quill instance object', this.editor);

            window.setTimeout(function () {
                this.state = false;
            }.bind(this), 500);
        },
        watch: {
            chartText: function () {
                this.$set(this, 'dataChart', JSON.parse(this.chartText));
                this.myDoughnutChart.data = JSON.parse(this.chartText);
                this.myDoughnutChart.update();
            },
            content: function () {
                if (this.user.id) {
                    this.$set(this.user, 'presentation', this.content)
                }
            },
            users: function () {
                window.setTimeout(function () {
                    $("#super").formSelect();
                }.bind(this), 50);
            }
        },
        methods: {
            loadScreen(bool) {
                this.$set(this, 'state', bool);
            },
            usurpateUser() {
                this.loadScreen(true);
                let that = this;
                let params = {
                    // params: {
                    //     'user_id': this.userId
                    // }
                };
                let url = Routing.generate('api_user_usurpate', {'user_id': this.userId});
                Vue.axios.get(url, params).then(function (response) {
                    that.$set(that, 'user', JSON.parse(response.data));
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            loadUsers() {
                let that = this;
                let params = {};
                let url = Routing.generate('api_users_list');
                Vue.axios.get(url, params).then(function (response) {
                    that.$set(that, 'users', JSON.parse(response.data));
                }).catch(function (error) {
                    console.log(error);
                })
            },
            logout() {
                let that = this;
                let params = {};
                let url = Routing.generate('api_user_logout');
                Vue.axios.get(url, params).then(function (response) {
                    if (response.data === "disconnected") {
                        that.$set(that, 'user', {});
                    }
                }).catch(function (error) {
                    console.log(error);
                })
            },
            notifyAdmin() {
                this.loadScreen(true);
                let that = this;
                let params = {
                    params: {
                        'user_id': this.userId,
                        'method': "email",
                        "content": this.notification_content
                    }
                };
                let url = Routing.generate('api_profile_notify', {'user_id': this.userId});
                console.log(url);
                Vue.axios.get(url, params).then(function (response) {
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            sendEmailContent() {
                this.loadScreen(true);
                let that = this;
                let params = {
                    content: this.content
                };
                let url = Routing.generate('api_send_email_content');
                Vue.axios.post(url, params).then(function (response) {
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            updatePresentation() {
                let that = this;
                this.$set(this.user, 'presentation', this.content);
                this.loadScreen(true);
                let url = Routing.generate('api_user_update', {'user_id': this.user.id});
                Vue.axios.put(url, this.user).then(function (response) {
                    console.log(response.data);
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            loadSample() {
                let that = this;
                let url = Routing.generate('api_sample', {'sample_id': 1});
                Vue.axios.get(url).then(function (response) {
                    that.$set(that, 'sample', JSON.parse(response.data));
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            updateSample() {
                this.loadScreen(true);
                let that = this;
                let params = {};
                let url = Routing.generate('api_sample_update', {'sample_id': 1});
                Vue.axios.put(url, this.sample).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            onEditorBlur(quill) {
//                console.log('editor blur!', quill)
            },
            onEditorFocus(quill) {
//                console.log('editor focus!', quill)
            },
            onEditorReady(quill) {
//                console.log('editor ready!', quill)
            },
            onEditorChange({quill, html, text}) {
//                console.log('editor change!', quill, html, text)
                this.content = html
            }
        }
    }
</script>

<style scoped>

</style>