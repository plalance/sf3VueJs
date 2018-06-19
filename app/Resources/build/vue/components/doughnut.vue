<template>
    <canvas id="myChart" width="400" height="400"></canvas>
</template>
<script>
    export default {
        name: 'doughnut',
        props: {
            name: {
                type: String,
                default: 'super-doughnut'
            },
            dataChart: {
                type: Object,
                default: {},
            },
        },
        data: function () {
            return {
                chartObject: {},
            }
        },
        mounted: function () {
            let ctx = document.getElementById("myChart");
            this.chartObject = new Chart(ctx, {
                type: 'doughnut',
                data: this.dataChart,
                options: {}
            });
        },
        watch: {
            dataChart: function () {
                this.chartObject.data = this.dataChart;
                this.chartObject.update();
            }
        },
    };
</script>

<style scoped>
    .google-map {
        width: 100%;
        height: 450px;
        margin: 0 auto;
        background: gray;
    }
</style>