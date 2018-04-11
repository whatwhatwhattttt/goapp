<style lang="less">
    @import './shop-management.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="2" offset="10">
                    <p class="shop-title-color">商铺管理</p>
                    </Col>
                    <!--todo 以下功能按钮改成搜索-->
                    <!--<Col span="3" offset="3">-->
                    <!--<Button @click="add_modal=true" long>添加新员工</Button>-->
                    <!--</Col>-->
                </Row>
            </card>
            </Col>
        </Row>
        <Row>
            <Table border :loading="loading" :columns="columns" :data="data"></Table>
            <div style="text-align: center">
                <Page
                        :total=table_total
                        :current=1
                        showTotal
                        show-elevator
                        @on-change="changepage">
                </Page>
            </div>
        </Row>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                table_total: null,
                current_page: 1,
                older_page: 1,
                place: null,
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
                        title: '所有者',
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
            // todo 分页操作
            // index为页数
            changepage(index){
                this.loading = true;
                this.current_page = index;
                this.data = [];
                let current_page_int = parseInt(this.current_page / 10);
                let older_page_int = parseInt(this.older_page / 10);
                let fstart = (this.current_page - 1) * 10;
                let fend = this.current_page * 10 < this.table_total ? this.current_page * 10 : this.table_total;
                setTimeout(() => {
                    if (current_page_int != older_page_int) {
                        // todo 向api请求选中页及附近9页数据
                        this.older_page = this.current_page;
                    }
                    for (let i = fstart; i < fend; i++) {
                        this.data.push(this.serverdata.data[i]);
                    }
                    this.loading = false;
                }, 500);
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
            // todo 向api请求100条初始数据并放入serverdata
            this.serverdata = {
                //  以下为数据格式
                //  数据库中该表共有数据条数
                datalength: 8,
                //  100条初始数据
                data: [
                    {
                        // 店铺名
                        name: 'John Brown shop',
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
        }
    };
</script>
