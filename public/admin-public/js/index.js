var Index = function () {
    "use strict";

    // function to initiate Chart
    var changeDateFormat = function (Date) {
        return Date.toISOString().substring(0, 10);
    };
    var runChart = function () {

        var chart, chartData, data;
        var date = new Date();
        var lastWeek = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 6);
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var reportRange = $('#reportrange');

        var setData = function (series1, series2) {
            data = [
                {
                    "key": "Visitors",
                    "bar": true,
                    "values": series1
                },
                {
                    "key": "Downloads",
                    "values": series2
                }
            ];
        };
        var getData = function (startDate, endDate) {
            var url = reportRange.data('url');
            var series1 = [];
            var series2 = [];

            $.ajax({
                url: url,
                type: 'get',
                data: {start: startDate, end: endDate},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (dataRes) {
                    //called when successful
                    if (dataRes.result) {

                        for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
                            var value = {};
                            var downloads = 0;
                            var visitors = 0;
                            var dateD = new Date(d);

                            if (dataRes.result[changeDateFormat(d)]) {
                                value = dataRes.result[changeDateFormat(d)];
                                visitors = value.visitors;
                                downloads = value.downloads;
                            }

                            series1.push([dateD, visitors]);
                            series2.push([dateD, downloads]);

                        }

                        setData(series1, series2);
                        clearChart();
                        drawChart();

                    } else if (dataRes.error) {
                        console.log(dataRes.error);
                    }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
        };
        var drawChart = function () {

            nv.addGraph(function () {
                chart = nv.models.linePlusBarChart().margin({
                    top: 15,
                    right: 30,
                    bottom: 15,
                    left: 30
                })
                //We can set x data accessor to use index. Reason? So the bars all appear evenly spaced.
                    .x(function (d, i) {
                        return i;
                    }).y(function (d, i) {
                        return d[1];
                    }).color(['#DFDFDD', '#E66F6F']);

                chart.xAxis.tickFormat(function (d) {
                    var dx = data[0].values[d] && data[0].values[d][0] || 0;
                    return d3.time.format('%d/%m/%y')(new Date(dx));
                });

                chart.y1Axis.tickFormat(d3.format(',f'));

                chart.y2Axis.tickFormat(d3.format(',f'));

                chart.bars.forceY([0, 10]);
                chart.lines.forceY([0, 10]);

                chartData = d3.select('#chart1 svg');
                chartData.datum(data).transition().duration(500).call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });

        };
        var clearChart = function () {
            var svg = d3.select('#chart1 svg');
            svg.selectAll("*").remove();
        };
        $(function () {

            getData(changeDateFormat(lastWeek), changeDateFormat(today));

            if (reportRange.length) {
                reportRange.daterangepicker({
                    ranges: {
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                        'Last 6 Month': [moment().subtract('month', 6).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 6),
                    endDate: moment()
                }, function (start, end) {

                    var reportRangeSpan = $('#reportrange span');
                    var startDate = start.format('YYYY-MM-DD');
                    var endDate = end.format('YYYY-MM-DD');

                    reportRangeSpan.html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY') + ' ');

                    getData(startDate, endDate);
                });
            }
        });
    };
    // function to initiate Sparkline
    var sparkResize;
    $(window).resize(function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(runSparkline, 500);
    });
    var runSparkline = function () {

        var d = new Date();
        var day = d.getDay();
        var firstDayOfWeek = new Date(d.getFullYear(), d.getMonth(), d.getDate() + (day == 0 ? -6 : 1) - day);
        var lastDayOfWeek = new Date(d.getFullYear(), d.getMonth(), d.getDate() + (day == 0 ? 0 : 7) - day);

        var getSparklineWeek = function (start, end) {
            var url = $('.sparkline').data('url');

            $.ajax({
                url: url,
                type: 'get',
                data: {start: start, end: end},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if (data) {
                        var views = [];
                        var downloads = [];
                        for (var d = new Date(start); d <= new Date(end); d.setDate(d.getDate() + 1)) {

                            if (data.result !== undefined) {
                                if (data.result[changeDateFormat(d)]) {
                                    views.push(data.result[changeDateFormat(d)].weekViews);
                                    downloads.push(data.result[changeDateFormat(d)].weekDownloads)
                                }else{
                                    views.push(0);
                                    downloads.push(0);
                                }
                            }
                        }

                        $(".sparkline-1 span").sparkline(views, {
                            type: "bar",
                            barColor: "#396a5f",
                            barWidth: "5",
                            height: "24",
                            tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{value}}',
                            tooltipValueLookups: {
                                names: {
                                    0: 'Sunday',
                                    1: 'Monday',
                                    2: 'Tuesday',
                                    3: 'Wednesday',
                                    4: 'Thursday',
                                    5: 'Friday',
                                    6: 'Saturday'

                                }
                            }
                        });
                        $(".sparkline-2 span").sparkline(downloads, {
                            type: "bar",
                            barColor: "#A5E5DD",
                            barWidth: "5",
                            height: "24",
                            tooltipFormat: '<span style="color: {{color}}">&#9679;</span> {{offset:names}}: {{value}}',
                            tooltipValueLookups: {
                                names: {
                                    0: 'Sunday',
                                    1: 'Monday',
                                    2: 'Tuesday',
                                    3: 'Wednesday',
                                    4: 'Thursday',
                                    5: 'Friday',
                                    6: 'Saturday'

                                }
                            }
                        });

                        if(data.totalCounts) {
                            $(".week-downloads strong").text(data.totalCounts.downloadsTotalCount);
                            $(".week-visits strong").text(data.totalCounts.visitsTotalCount);
                        }

                    } else if (data.error) {
                        console.log(data.error);
                    }
                },
                error: function (e) {
                    //called when there is an error
                    console.log(e.message);
                }
            });
        };

        getSparklineWeek(changeDateFormat(firstDayOfWeek), changeDateFormat(lastDayOfWeek));
    };
    // function to activate animated Clock and Actual Date
    var runClock = function () {
        function update() {
            var now = moment(), second = now.seconds() * 6, minute = now.minutes() * 6 + second / 60,
                hour = ((now.hours() % 12) / 12) * 360 + 90 + minute / 12;
            $('#hour').css({
                "-webkit-transform": "rotate(" + hour + "deg)",
                "-moz-transform": "rotate(" + hour + "deg)",
                "-ms-transform": "rotate(" + hour + "deg)",
                "transform": "rotate(" + hour + "deg)"
            });
            $('#minute').css({
                "-webkit-transform": "rotate(" + minute + "deg)",
                "-moz-transform": "rotate(" + minute + "deg)",
                "-ms-transform": "rotate(" + minute + "deg)",
                "transform": "rotate(" + minute + "deg)"
            });
            $('.clock #second').css({
                "-webkit-transform": "rotate(" + second + "deg)",
                "-moz-transform": "rotate(" + second + "deg)",
                "-ms-transform": "rotate(" + second + "deg)",
                "transform": "rotate(" + second + "deg)"
            });
        }

        function timedUpdate() {
            update();
            setTimeout(timedUpdate, 1000);
        }

        timedUpdate();
        $(".actual-date .actual-day").text(moment().format('DD'));
        $(".actual-date .actual-month").text(moment().format('MMMM'));
    };
    // function to animate CoreBox Icons
    var runCoreBoxIcons = function () {
        $(".core-box").on("mouseover", function () {
            $(this).find(".icon-big").addClass("tada animated");
        }).on("mouseleave", function () {
            $(this).find(".icon-big").removeClass("tada animated");
        });
    };
    return {
        init: function () {
            runChart();
            runSparkline();
            runClock();
            runCoreBoxIcons();
        }
    };
}();
