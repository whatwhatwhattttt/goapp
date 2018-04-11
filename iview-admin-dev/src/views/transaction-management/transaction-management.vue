<style lang="less">
    @import './transaction.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="2" offset="10">
                    <p class="shop-title-color">交易管理</p>
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
                    name: 'transactioninfo',
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
        }
    };
</script>
