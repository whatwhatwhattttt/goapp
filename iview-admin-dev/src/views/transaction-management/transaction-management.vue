<style lang="less">
    @import './transaction.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="transaction-title-color">交易管理</p>
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
                page_size: 10,
                sort: 0,
                loading: false,
                place: null,
                searchlist: [
                    ['wechat', '微信账号'],
                    ['wechat_balance', '微信账号内资金'],
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
                        title: '交易编号',
                        key: 'id'
                    },
                    {
                        title: '商品名称',
                        key: 'name'
                    },
                    {
                        title: '买家',
                        key: 'buyers_name'
                    },
                    {
                        title: '店铺名',
                        key: 'shop_name'
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
            init(){
                // todo 向api请求100条初始数据并放入serverdata
                this.serverdata = {
                    //以下为数据格式
                    //数据库中该表共有数据条数
                    datalength: 1,
                    //100条初始数据
                    data: [
                        {
                            // 交易编号
                            id: '123123',
                            // 商品名称
                            name: '黄瓜',
                            // 买家昵称
                            buyers_name: 'zxk',
                            // 商店名称
                            shop_name: 'zxksdfs',
                            // 卖家昵称
                            seller_name: 'sdfsdf',
                            // 物品价格
                            price: 'asdfsdf',
                            // 交易状态
                            state: '已关闭',
                            // 物品位置
                            position: '浙江省温州市。。。',
                            // 买家联系方式
                            buyers_phone: '18044444444',
                            // 卖家联系方式
                            seller_phone: '15233333333',
                            // 物品类型
                            type: '蔬菜',
                            // 货物介绍
                            description: '新鲜蔬菜',
                            // 交易发起时间
                            create_time: '2017-8-9',
                            // 交易更新时间
                            updata_time: '2017-8-12'
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
                    name: 'transactioninfo',
                    query: query
                });
            }
        },
        mounted () {
            this.init();
        }
    };
</script>
