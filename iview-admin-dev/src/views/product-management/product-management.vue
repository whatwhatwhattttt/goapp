<style lang="less">
    @import './product-management.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="2" offset="10">
                    <p class="product-title-color">产品管理</p>
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
                        title: '产品名',
                        key: 'name'
                    },
                    {
                        title: '类别',
                        key: 'type'
                    },
                    {
                        title: '所有店铺',
                        key: 'user_name'
                    },
                    {
                        title: '上架日期',
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
                    name: 'productinfo',
                    query: query
                });
            }
        },
        mounted () {
            // todo 向api请求100条初始数据并放入serverdata
            this.serverdata = {
                //以下为数据格式
                //数据库中该表共有数据条数
                datalength: 1,
                //100条初始数据
                data: [
                    {
                        // 产品名
                        name: '螃蟹',
                        // 店铺名
                        shop_name: 'John Brown product',
                        // 店主名称
                        user_name: 'sdfgdfbd',
                        // 产品编号
                        id: '00000023',
                        // 店铺编号
                        shop_id: '0000000001',
                        // 种类
                        type: '蔬菜',
                        // 库存
                        stock: 456,
                        // 价格
                        price: '234',
                        // 产品介绍
                        description: '这是一家专卖速度符卡都很方便卡迪夫可视对讲防守打法的店',
                        // 购买人数
                        purchase_number: 346,
                        // 审核人员
                        auditor: 'yourself',
                        // 审核时间
                        approval_time: '2017-8-7',
                        // 上架时间
                        opening_time: '2017-8-9',
                        // 上架状态
                        run: 1
                    }
                ]
            };
            this.table_total = this.serverdata.datalength;
            this.changepage(1);
        }
    };
</script>
