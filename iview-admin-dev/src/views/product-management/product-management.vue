<style lang="less">
    @import './product-management.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="product-title-color">产品管理</p>
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
                older_page: 1,
                page_size: 10,
                sort: 0,
                place: null,
                searchlist: [
                    ['wechat', '产品名'],
                    ['wechat_balance', '所属店铺'],
                    ['alipay', '支付宝账号'],
                    ['alipay_balance', '支付宝账号内资金']
                ],
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
                        title: '所属店铺',
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
            //初始化方法
            init () {
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
                    name: 'productinfo',
                    query: query
                });
            }
        },
        mounted () {
            this.init();
        }
    };
</script>
