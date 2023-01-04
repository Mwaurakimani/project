<template>
    <div class="chart-section" id="chart_div">
    </div>
</template>


<script>
export default {
    name: 'chart-section',
    props:['chartData'],
    mounted() {


        google.charts.load("current", {packages: ['corechart','bar']});
        google.charts.setOnLoadCallback(drawChart);

        let dataSet = this.chartData

        function drawChart() {
            let data =new google.visualization.DataTable();

            data.addColumn('string', 'Month');
            data.addColumn('number', 'Deposits');
            data.addColumn('number', 'Arrears');

            data.addRows(dataSet);

            const vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);

            let options = {
                title: 'Finances',
                hAxis: {
                    title: 'Month',
                },
                vAxis: {
                    title: 'Amount',
                },
                'width':(vw - 280),
                'height':'500'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    }
}
</script>
