<style lang="less">
    @import "./home.less";
    @import "../../styles/common.less";
</style>
<template>
    <div class="home-main">
        <Row :gutter="10" class="margin-top-10">
            <Col :md="24" :lg="12" :style="{marginBottom: '10px'}">
            <Card>
                <p slot="title" class="card-title">
                    <Icon type="android-map"></Icon>
                    上周每日交易量统计
                </p>
                <div class="data-source-row">
                    <visite-volume></visite-volume>
                </div>
            </Card>
            </Col>
            <Col :md="24" :lg="12">
            <Row :gutter="5">
                <Col :xs="24" :sm="12" :md="12" :style="{marginTop: '30px'}">
                <infor-card
                        id-name="user_created_count"
                        :end-val="count.createUser"
                        iconType="android-person-add"
                        color="#2d8cf0"
                        intro-text="今日新增用户"
                ></infor-card>
                </Col>
                <Col :xs="24" :sm="12" :md="12" :style="{marginTop: '30px'}">
                <infor-card
                        id-name="visit_count"
                        :end-val="count.visit"
                        iconType="ios-eye"
                        color="#64d572"
                        :iconSize="50"
                        intro-text="今日浏览量"
                ></infor-card>
                </Col>

            </Row>
            <Row>
                <Col :xs="24" :sm="12" :md="12" :style="{marginTop: '30px'}">
                <infor-card
                        id-name="collection_count"
                        :end-val="count.collection"
                        iconType="upload"
                        color="#ffd572"
                        intro-text="今日交易量"
                ></infor-card>
                </Col>
                <Col :xs="24" :sm="12" :md="12" :style="{marginTop: '30px'}">
                <infor-card
                        id-name="transfer_count"
                        :end-val="count.transfer"
                        iconType="shuffle"
                        color="#f25e43"
                        intro-text="今日服务调用量"
                ></infor-card>
                </Col>
            </Row>
            </Col>
        </Row>
        <Row class="margin-top-10">
            <Card>
                <p slot="title" class="card-title">
                    <Icon type="ios-shuffle-strong"></Icon>
                    上月每日交易量(万)
                </p>
                <div class="line-chart-con">
                    <service-requests></service-requests>
                </div>
            </Card>
        </Row>
    </div>
</template>

<script>
    import cityData from './map-data/get-city-value.js';
    import homeMap from './components/map.vue';
    import dataSourcePie from './components/dataSourcePie.vue';
    import visiteVolume from './components/visiteVolume.vue';
    import serviceRequests from './components/serviceRequests.vue';
    import userFlow from './components/userFlow.vue';
    import countUp from './components/countUp.vue';
    import inforCard from './components/inforCard.vue';
    import mapDataTable from './components/mapDataTable.vue';
    import toDoListItem from './components/toDoListItem.vue';
    export default {
        name: 'home',
        components: {
            homeMap,
            dataSourcePie,
            visiteVolume,
            serviceRequests,
            userFlow,
            countUp,
            inforCard,
            mapDataTable,
            toDoListItem
        },
        data () {
            return {
                count: {
                    createUser: 496,
                    visit: 3264,
                    collection: 24389305,
                    transfer: 39503498
                },
                cityData: cityData,
                showAddNewTodo: false,
                newToDoItemValue: ''
            };
        },
        computed: {
            avatorPath () {
                return localStorage.avatorImgPath;
            }
        },
        methods: {
            addNewToDoItem () {
                this.showAddNewTodo = true;
            },
            addNew () {
                if (this.newToDoItemValue.length !== 0) {
                    this.toDoList.unshift({
                        title: this.newToDoItemValue
                    });
                    setTimeout(() => {
                        this.newToDoItemValue = '';
                    }, 200);
                    this.showAddNewTodo = false;
                } else {
                    this.$Message.error('请输入待办事项内容');
                }
            },
            cancelAdd () {
                this.showAddNewTodo = false;
                this.newToDoItemValue = '';
            }
        },

    };
</script>
