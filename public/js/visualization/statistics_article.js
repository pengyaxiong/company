$.get('/api/statistics_article').done(function (data) {

    var article = [];      //文章
    var num = [];             //浏览量

    $.each(data, function (k, v) {
        article.push(v.title);
        num.push(v.num)
    })

    var myChart = echarts.init(document.getElementById('statistics_article'), 'macarons');
    myChart.setOption(
        {
            title: {
                text: '文章',
                subtext: '浏览量'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data: ['浏览量']
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    data: article
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: '浏览量',
                    type: 'bar',
                    data: num,
                    markPoint: {
                        data: [
                            {type: 'max', name: '最大值'},
                            {type: 'min', name: '最小值'}
                        ]
                    },
                    markLine: {
                        data: [
                            {type: 'average', name: '平均值'}
                        ]
                    }
                }
            ]
        }
    );
});