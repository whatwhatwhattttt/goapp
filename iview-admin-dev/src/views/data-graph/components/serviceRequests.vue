<template>
    <div style="width:100%;height:100%;" id="service_request_con"></div>
</template>

<script>
    import echarts from 'echarts';
    export default {
        name: 'serviceRequests',
        data () {
            return {
                timearray: []
            };
        },
        methods: {
            gettimearray () {
                let curDate = new Date();
                curDate.setDate(0);
                let curday = curDate.getDate();
                for (let i = 1; i <= curday; i++) {
                    this.timearray.push(i.toString());
                }
            }
        },
        mounted () {
            this.gettimearray();
            const option = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                grid: {
                    top: '3%',
                    left: '1.2%',
                    right: '1%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: false,
                        data: this.timearray
                    }
                ],
                yAxis: [
                    {
                        type: 'value'
                    }
                ],
                series: [
                    {
                        name: '蔬菜瓜果',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: '#2d8cf0'
                            }
                        },
                        data: [120, 132, 101, 134, 90, 230, 210, 234, 290, 330, 126, 325, 741, 816, 623, 612, 347, 652, 347, 652, 301, 390, 330, 334, 390, 330, 320, 132, 487, 451]
                    },
                    {
                        name: '野味',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: '#10A6FF'
                            }
                        },
                        data: [257, 358, 278, 234, 290, 330, 126, 325, 741, 816, 623, 612, 347, 652, 301, 390, 330, 334, 390, 330, 320, 132, 487, 564, 451, 654, 841, 651, 126, 310]
                    },
                    {
                        name: '河鲜/海鲜',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: '#0C17A6'
                            }
                        },
                        data: [379, 268, 354, 111, 332, 301, 334, 390, 330, 320, 132, 487, 564, 451, 654, 841, 651, 126, 325, 741, 816, 623, 612, 347, 652, 841, 269, 310, 478, 358]
                    },
                    {
                        name: '其他',
                        type: 'line',
                        stack: '总量',
                        areaStyle: {
                            normal: {
                                color: '#4608A6'
                            }
                        },
                        data: [320, 332, 301, 334, 390, 330, 320, 126, 623, 612, 347, 652, 841, 123, 456, 165, 131, 132, 487, 564, 451, 654, 841, 651, 654, 325, 741, 816, 954, 246]
                    }
                ]
            };
            const serviceRequestCharts = echarts.init(document.getElementById('service_request_con'));
            serviceRequestCharts.setOption(option);
            window.addEventListener('resize', function () {
                serviceRequestCharts.resize();
            });
        }
    };
</script>