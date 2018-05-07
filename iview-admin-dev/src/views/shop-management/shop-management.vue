<style lang="less">
    @import './shop-management.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="shop-title-color">商铺管理</p>
                    </Col>

                    <Col span="20">
                    <zxksearch :searchlist="searchlist"
                               :loading="loading"
                               @zxksearch_f="search"
                               @zxksearch_s="zxksort">
                    </zxksearch>
                    </Col>
                </Row>
            </card>
            </Col>
        </Row>
        <Row style="margin-top: 68px;margin-bottom: 50px;">
            <Table border :loading="loading" :columns="columns" :data="data"></Table>
        </Row>
        <Row>
            <Card style="position:fixed;bottom:0px;z-index: 999;width:100%;height: 60px;">
                <Col span="10" offset="5">
                <div style="text-align: center">
                    <Page
                            size="small"
                            :total=table_total
                            :current=current_page
                            :page_size=page_size
                            showTotal
                            showSizer
                            placement="top"
                            show-elevator
                            @on-change="changepage"
                            @on-page-size-change="changepage_size">
                    </Page>
                </div>
                </Col>
            </Card>
        </Row>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                table_total: null,
                current_page: 1,
                page_size: 10,
                sort: 0,
                place: null,
                searchlist: [
                    ['wechat', '店铺名'],
                    ['wechat_balance', '店主']
                ],
                columns: [
                    {
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
                    {
                        title: '店铺名',
                        key: 'name'
                    },
                    {
                        title: '店主',
                        key: 'user_name'
                    },
                    {
                        title: '店铺开业日期',
                        key: 'opening_time'
                    },
                    {
                        title: 'Action',
                        key: 'action',
                        width: 150,
                        align: 'center',
                        render: (h, params) => {
                            return h('div', [
                                h('Button', {
                                    props: {
                                        type: 'primary',
                                        size: 'long'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.place = params.index;
                                            this.showinfo();
                                        }
                                    }
                                }, '详情查看')
                            ]);
                        }
                    }
                ],
                data: [],
                serverdata: []
            };
        },
        methods: {
            //  初始化方法
            init () {
                // todo 向api请求100条初始数据并放入serverdata
                this.serverdata = {
                    //  以下为数据格式
                    //  数据库中该表共有数据条数
                    datalength: 8,
                    //  100条初始数据
                    data: [
                        {
                            // 店铺名
                            name: 'John Brown shop123',
                            // 店主名称
                            user_name: 'sdfgdfbd',
                            // 店铺编号
                            id: '000000001',
                            // 店铺介绍
                            description: '这是一家专卖速度符卡都很方便卡迪夫可视对讲防守打法的店',
                            // 店内产品
                            products: '土豆，西红柿，腊肉',
                            // 总星数
                            star: 99,
                            // 评价人数
                            evaluation_number: 33,
                            // 店铺星级
                            level: 3,
                            // 营业额
                            turnover: 1616551,
                            // 审核人员
                            auditor: 'yourself',
                            // 审核时间
                            approval_time: '2017-8-7',
                            // 开业时间
                            opening_time: '2017-8-9',
                            // 运营状态
                            run: 1
                        },
                        {
                            name: 'John Brown shop2222',
                            user_name: 'sdfgdf撒东西吃vbd',
                            id: '000000002',
                            description: '这是一家专卖速度符卡都很方便卡迪夫可视对讲防守打法的店',
                            products: '土豆，西红柿，腊肉',
                            star: 99,
                            turnover: 1616551,
                            evaluation_number: 33,
                            level: 3,
                            auditor: 'yourself',
                            approval_time: '2017-8-7',
                            opening_time: '2017-8-9',
                            run: 0
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        },
                        {
                            name: 'John Brown',
                            age: 18,
                            job_number: 'New York No. 1 Lake Park',
                            position: '仓库管理',
                            role: '仓库管理',
                            admin_id: '123123',
                            password: '123234123'
                        }
                    ]
                };
                this.table_total = this.serverdata.datalength;
                this.changepage(1);
                this.dataload();
            },
            //todo 搜索
            search(index){
                this.loading = true;
                setTimeout(() => {
                    if (index[0]) {
                        // todo 向api发送字符串并返回匹配数据
                        //this.serverdata=
                        this.init();
                    }
                    this.loading = false;
                }, 500);
            },
            //排序
            zxksort(){
                this.serverdata.data.reverse();
                console.log(this.serverdata.data);
                this.changepage(1);
            },
            // todo 分页操作
            // index为页数
            changepage(index){
                this.loading = true;
                this.current_page = index;
                this.data = [];
                let fstart = (this.current_page - 1) * this.page_size;
                let fend = this.current_page * this.page_size < this.table_total ? this.current_page * this.page_size : this.table_total;
                setTimeout(() => {
                    for (let i = fstart; i < fend; i++) {
                        this.data.push(this.serverdata.data[i]);
                    }
                    this.loading = false;
                }, 500);
            },
            changepage_size(index){
                this.page_size = index;
                this.changepage(this.current_page);
            },
            //数据拉取
            dataload(){
                //todo 拉取所有数据
            },
            showinfo () {
                let query = this.data[this.place];
                this.$router.push({
                    name: 'shopinfo',
                    query: query
                });
            }
        },
        mounted () {
            this.init();
        }
    };
</script>
