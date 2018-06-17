<template>
    <div class="uk-offcanvas-content" id="app">
        <Loader :state="state"></Loader>
        <h1 v-if="!user.id">Aucun User connecté</h1>
        <div v-else="">
            <h1>{{ user.username }}</h1>
            <p>Email : {{ user.email }}</p>
            <p>Roles : {{ user.roles }}</p>
            <p>Activé : {{ user.enabled ? 'Activé' : 'Non Activé' }}</p>
            <input type="text" v-model="notification_content">
            <button @click="notifyAdmin()">Envoyer un mail de notification</button>
            <button @click="logout()">Se déconnecter</button>
            <div>
                <h3>Sa présentation</h3>
                <div v-html="user.presentation"></div>
            </div>
        </div>

        <div>
            <select v-model="userId" @change="usurpateUser()">
                <option v-for="user in users" :value="user.id">Se connecter avec {{ user.username }}</option>
            </select>
            <label>Se connecter en tant que :</label>
        </div>
        <!--<form class="uk-form">-->
            <!--<fieldset data-uk-margin>-->
                <!--<l>Se connecter en tant que :</l>-->
                <!--<select v-model="userId" @change="usurpateUser()">-->
                    <!--<option v-for="user in users" :value="user.id">Se connecter avec {{ user.username }}</option>-->
                <!--</select>-->
            <!--</fieldset>-->
        <!--</form>-->

        <h1>User connecté :</h1>
        <div id="content" data-uk-height-viewport="expand: true">
            <div class="uk-container uk-container-expand">
                <div class="uk-grid uk-grid-medium uk-grid-match" data-uk-grid>
                    <!-- panel -->
                    <div class="uk-width-1-2@s uk-width-1-2@l">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">Editeur de texte</h4>
                                    </div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <vue-quill-editor class="quill-editor" v-model="content"
                                                  ref="myQuillEditor"
                                                  :options="editorOption"
                                                  @blur="onEditorBlur($event)"
                                                  @focus="onEditorFocus($event)"
                                                  @ready="onEditorReady($event)">
                                </vue-quill-editor>
                                <button @click="sendEmailContent()">Envoyer ce contenu par mail</button>
                                <button @click="updatePresentation()">Définir comme nouvelle présentation</button>
                                <button @click="updateSample()">Merge sample</button>
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-2@s uk-width-1-2@l">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">Geographie
                                        (image)</h4>
                                    </div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <img :src="staticFolder + 'images/mapa1.svg'" alt="">
                                <p class="uk-text-muted uk-text-small uk-text-center">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-grid uk-grid-medium uk-grid-match" data-uk-grid>

                    <!-- /panel -->
                    <!-- panel -->
                    <div class="uk-width-1-2@s uk-width-1-3@l uk-width-1-4@xl">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">ChartJS</h4></div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <textarea name="" id="" cols="30" rows="10" v-model="chartText"></textarea>
                                <canvas id="myChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <!-- panel -->
                    <div class="uk-width-1-2@s uk-width-2-3@l uk-width-1-4@xl">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">Localisation</h4>
                                    </div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <Gmap :marker-coordinates="markerCoordinates" :name="'supermap'" :zoom="14"></Gmap>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="uk-grid uk-grid-medium uk-grid-match" data-uk-grid>
                    <div class="uk-width-1-2@s uk-width-1-2@l uk-width-1-4@xl">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">Diagramme barre</h4>
                                    </div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <img :src="staticFolder + 'images/mapa3.svg'" alt="">
                                <p class="uk-text-muted uk-text-small uk-text-center">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <!-- panel -->
                    <div class="uk-width-1-2@s uk-width-1-2@l uk-width-1-4@xl">
                        <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                            <div class="uk-card-header">
                                <div class="uk-grid uk-grid-small">
                                    <div class="uk-width-auto"><h4 class="uk-margin-remove-bottom">Ipsum dolor</h4>
                                    </div>
                                    <div class="uk-width-expand uk-text-right">
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: move"></a>
                                        <a href="#" class="uk-icon-link uk-margin-small-right"
                                           data-uk-icon="icon: cog"></a>
                                        <a href="#" class="uk-icon-link" data-uk-icon="icon: close"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <img :src="staticFolder + 'images/mapa4.svg'" alt="">
                                <p class="uk-text-muted uk-text-small uk-text-center">Lorem ipsum dolor sit amet,
                                    consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                </div>
            </div>
        </div>
        <!-- /CONTENT -->
        <!-- OFFCANVAS -->
        <div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: true">
            <div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
                <button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
                <ul class="uk-nav uk-nav-default">
                    <li class="uk-active"><a href="#">Active</a></li>
                    <li class="uk-parent">
                        <a href="#">Parent</a>
                        <ul class="uk-nav-sub">
                            <li><a href="#">Sub item</a></li>
                            <li><a href="#">Sub item</a></li>
                        </ul>
                    </li>
                    <li class="uk-nav-header">Header</li>
                    <li><a href="#js-options"><span class="uk-margin-small-right uk-icon"
                                                    data-uk-icon="icon: table"></span>
                        Item</a></li>
                    <li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: thumbnails"></span>
                        Item</a>
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: trash"></span> Item</a>
                    </li>
                </ul>
                <h3>Title</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat.</p>
            </div>
        </div>
        <!-- /OFFCANVAS -->
    </div>
</template>

<script>
    import Chart from 'chart.js';
    import Gmap from './components/google-map';
    import Loader from './components/loader';
    // import Quill from 'quill';
    import VueQuillEditor from 'vue-quill-editor';

    export default {
        name: 'app',
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
            console.log('this is current quill instance object', this.editor)

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
                if (this.user.id){
                    this.$set(this.user,'presentation', this.content)
                }
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