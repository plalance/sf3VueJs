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
        </div>

        <form class="uk-form">

            <fieldset data-uk-margin>
                <legend>Se connecter en tant que :</legend>
                <select v-model="userId" @change="loadUser()">
                    <option :value="1">Se connecter avec Paul</option>
                    <option :value="2">Se connecter avec Astérix</option>
                </select>
            </fieldset>

        </form>

        <h1>User connecté :</h1>
        <div id="content" data-uk-height-viewport="expand: true">
            <div class="uk-container uk-container-expand">
                <div class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-4@l uk-child-width-1-5@xl"
                     data-uk-grid>
                    <div>
                    <span class="uk-text-small"><span data-uk-icon="icon:users"
                                                      class="uk-margin-small-right uk-text-primary"></span>New Users</span>
                        <h1 class="uk-heading-primary uk-margin-remove  uk-text-primary">2.134</h1>
                        <div class="uk-text-small">
                            <span class="uk-text-success" data-uk-icon="icon: triangle-up">15%</span>de plus que la
                            semaine dernière.
                        </div>
                    </div>
                    <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:social"
                                                      class="uk-margin-small-right uk-text-primary"></span>Social Media</span>
                        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">8.490</h1>
                        <div class="uk-text-small">
                            <span class="uk-text-warning" data-uk-icon="icon: triangle-down">-15%</span>de moins que la
                            semaine dernière
                        </div>

                    </div>
                    <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:clock"
                                                      class="uk-margin-small-right uk-text-primary"></span>Traffic hours</span>
                        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">12.00
                            <small class="uk-text-small">PM</small>
                        </h1>
                        <div class="uk-text-small">
                            <span class="uk-text-success" data-uk-icon="icon: triangle-up"> 19%</span>de plus que la
                            semaine dernière
                        </div>

                    </div>
                    <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:search"
                                                      class="uk-margin-small-right uk-text-primary"></span>Week Search</span>
                        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">9.543</h1>
                        <div class="uk-text-small">
                            <span class="uk-text-danger" data-uk-icon="icon: triangle-down"> -23%</span> less than last
                            week.
                        </div>

                    </div>
                    <div class="uk-visible@xl">
                    <span class="uk-text-small"><span data-uk-icon="icon:users"
                                                      class="uk-margin-small-right uk-text-primary"></span>Lorem ipsum</span>
                        <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">5.284</h1>
                        <div class="uk-text-small">
                            <span class="uk-text-success" data-uk-icon="icon: triangle-up"> 7%</span> more than last
                            week.
                        </div>
                    </div>
                </div>
                <hr>
                <div class="uk-grid uk-grid-medium uk-grid-match" data-uk-grid>
                    <!-- panel -->
                    <div class="uk-width-2-3@l uk-width-1-2@xl">
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
                                <!--{# <img src="{% static " img/mapa2.svg" %}" alt="">#}-->
                                <!--{# <p class="uk-text-muted uk-text-small uk-text-center">Lorem ipsum dolor sit amet,#}-->
                                <!--{# consectetur adipiscing elit.</p>#}-->
                            </div>
                        </div>
                    </div>
                    <!-- /panel -->
                    <!-- panel -->
                    <div class="uk-width-1-2@s uk-width-1-3@l uk-width-1-4@xl">
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
                    <div class="uk-width-1-2@s uk-width-1-2@l uk-width-1-4@xl">
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

    export default {
        name: 'app',
        components: {Gmap, Loader},
        data: function () {
            return {
                user: {},
                notification_content : "",
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
                userId: 0
            }
        },
        created() {
            let datas = this.$root.$data;
            this.user = datas.user;
            this.staticFolder = datas.staticFolder;
        },
        computed: {
            getDatas() {
                return JSON.parse(this.chartText);
            }
        },
        beforeMount() {
            this.chartText = JSON.stringify(this.dataChart);
        },
        mounted() {
            // let url = Routing.generate('example', {'user_id': 1});
            let ctx = document.getElementById("myChart");
            this.myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: this.dataChart,
                options: {}
            });
            window.setTimeout(function () {
                this.state = false;
            }.bind(this), 500);
        },
        watch: {
            chartText: function () {
                this.$set(this, 'dataChart', JSON.parse(this.chartText));
                this.myDoughnutChart.data = JSON.parse(this.chartText);
                this.myDoughnutChart.update();
            }
        },
        methods: {
            loadScreen(bool){
                this.$set(this, 'state', bool);
            },
            loadUser(){
                this.loadScreen(true);
                let that = this;
                let params = {
                    // params: {
                    //     'user_id': this.userId
                    // }
                };
                let url = Routing.generate('api_profile', {'user_id': this.userId});
                Vue.axios.get(url, params).then(function (response) {
                    console.log(response.data);
                    that.$set(that, 'user', JSON.parse(response.data));
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            },
            notifyAdmin(){
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
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                }).then(function () {
                    that.loadScreen(false);
                });
            }
        }
    }
</script>

<style scoped>

</style>