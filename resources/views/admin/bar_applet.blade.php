
<div id="container_applet" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">    
    Highcharts.chart('container_applet', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Laporan Applet'
        },
        xAxis: {
            categories: <?php echo json_encode($a); ?>
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            series:{
                cursor : 'pointer',
                point : {
                    events : {
                        click : function(){
                            lihat('applet',this.category);
                        }
                    }
                }
            },
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Good',
            color: 'lime',
            data: <?php echo json_encode($b, JSON_NUMERIC_CHECK); ?>
        }, {
            name: 'Reject',
            color : 'black',
            data: <?php echo json_encode($c, JSON_NUMERIC_CHECK); ?>
        }]
    });
</script>
