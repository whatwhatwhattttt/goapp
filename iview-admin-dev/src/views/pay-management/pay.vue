<style lang="less">
    @import './pay.less';
    @import './../../styles/common.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="pay-title-color">支付管理</p>
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
        <Row style="position:fixed;top:167px;z-index: 999;width:100%">
            <card class="pay-tip">
                <Col span="18">
                <Row>
                    <Col style="margin-top: 3px;" span="3" offset="1">
                    <span>已启用方案:</span>
                    </Col>

                    <Col span="7">
                    <Input type="text" style="width: 260px" v-model="tip.wechat" readonly>
                    <span slot="prepend">微信账号：</span>
                    </Input>
                    </Col>

                    <Col span="7" offset="1">
                    <Input type="text" style="width: 260px" v-model="tip.alipay" readonly>
                    <span slot="prepend">支付宝账号：</span>
                    </Input>
                    </Col>
                </Row>
                </Col>
            </card>
        </Row>
        <Row style="margin-top: 128px;margin-bottom: 50px;">
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
                <Col span="3" offset="2">
                <Button @click="add_modal=true" long>添加方案</Button>
                </Col>
            </Card>
        </Row>
        <Modal v-model="add_modal"
               :loading="loading"
               title="添加方案">
            <Form ref="pay_add_Form" :label-width="80" :model="form" :rules="rules">
                <FormItem label="微信" prop="wechat">
                    <Input type="text" v-model="form.wechat" class="pay-text"
                           placeholder="输入微信账号"/><br>
                </FormItem>
                <FormItem label="支付宝" prop="alipay">
                    <Input type="text" v-model="form.alipay" class="pay-text"
                           placeholder="输入支付宝账号"/><br>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="primary" :loading="loading" @click="add" long>提交</Button>
            </div>
        </Modal>
        <Modal v-model="edit_modal"
               :loading="loading"
               title="方案修改">
            <Form ref="edit_Form" :label-width="80" :model="form1" :rules="rules">
                <FormItem label="微信" prop="wechat">
                    <Input type="text" v-model="form1.wechat" class="pay-text"
                           placeholder="输入微信账号"/><br>
                </FormItem>
                <FormItem label="支付宝" prop="alipay">
                    <Input type="text" v-model="form1.alipay" class="pay-text"
                           placeholder="输入支付宝账号"/><br>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="primary" :loading="loading" long @click="edit">确定修改</Button>
            </div>
        </Modal>
        <Modal
                v-model="use_modal"
                title="确定启用？"
                :loading="loading">
            <p style="color: #1cc100;text-align:center;font-size: 25px">
                <Icon type="information-circled"></Icon>
                <span>确定启用？</span>
            </p>
            <div slot="footer">
                <Button @click="use_modal=false">返回</Button>
                <Button type="success" :loading="loading" @click="use">确定启用</Button>
            </div>
        </Modal>
        <Modal
                v-model="del_modal"
                :loading="loading">
            <p style="color:#f60;text-align:center;font-size: 25px">
                <Icon type="information-circled"></Icon>
                <span>确定删除？</span>
            </p>
            <div slot="footer">
                <Button @click="del_modal=false">返回</Button>
                <Button type="error" :loading="loading" @click="del">确定删除</Button>
            </div>
        </Modal>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                //已启用方案显示用数据
                tip: {
                    //todo 加载页面时自动向数据库请求并更改内部数据为正在使用的账号数据
                    wechat: '111',
                    alipay: '222'
                },
                //添加弹框显示变量
                add_modal: false,
                //修改弹框显示变量
                edit_modal: false,
                //启用弹框显示变量
                use_modal: false,
                //删除弹框显示变量
                del_modal: false,
                //组件加载变量
                loading: false,
                //数据库中该类型总数据条数
                table_total: null,
                //跳转页码
                current_page: 1,
                page_size: 10,
                sort: 0,
                //表格数据位置
                place: null,
                //搜索可选
                searchlist: [
                    ['wechat', '微信账号'],
                    ['wechat_balance', '微信账号内资金'],
                    ['alipay', '支付宝账号'],
                    ['alipay_balance', '支付宝账号内资金']
                ],
                form: {
                    wechat: '',
                    alipay: ''
                },
                form1: {
                    wechat: '',
                    alipay: ''
                },
                rules: {
                    alipay: [
                        {required: true, message: '支付宝账号不能为空', trigger: 'blur'}
                    ],
                    wechat: [
                        {required: true, message: '微信账号不能为空', trigger: 'blur'}
                    ],
                    search_t: [
                        {required: true, message: '微信账号不能为空', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
                    {
                        title: '微信账号',
                        key: 'wechat'
                    },
                    {
                        title: '微信账号内资金',
                        key: 'wechat_balance'
                    },
                    {
                        title: '支付宝账号',
                        key: 'alipay'
                    },
                    {
                        title: '支付宝账号内资金',
                        key: 'alipay_balance'
                    },
                    {
                        title: '操作',
                        key: 'action',
                        width: 200,
                        align: 'center',
                        render: (h, params) => {
                            return h('div', [
                                h('Button', {
                                    props: {
                                        type: 'success',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.use_modal = true;
                                            this.place = params.index;
                                        }
                                    }
                                }, '启用'),
                                h('Button', {
                                    props: {
                                        type: 'primary',
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.place = params.index;
                                            this.form1 = this.data[this.place];
                                            this.edit_modal = true;
                                        }
                                    }
                                }, '修改'),
                                h('Button', {
                                    props: {
                                        type: 'error',
                                        size: 'small'
                                    },
                                    on: {
                                        click: () => {
                                            this.del_modal = true;
                                            this.place = params.index;
                                        }
                                    }
                                }, '删除')
                            ]);
                        }
                    }
                ],
                data: []
            };
        },
        methods: {
            //初始化方法
            init(){
                // todo 向api请求100条初始数据并放入serverdata
                this.serverdata = {
                    //以下为数据格式
                    //数据库中该表共有数据条数
                    datalength: 12,
                    //100条初始数据
                    data: [
                        {
                            number: 7,
                            wechat: '183424242423253345',
                            alipay: '32524534345453434553',
                        },
                        {
                            number: 8,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 9,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 0,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 1,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 2,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 3,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 4,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 5,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 6,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 6,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
                        },
                        {
                            number: 6,
                            wechat: '18',
                            alipay: 'New York No. 1 Lake Park',
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
                alert(index[0]);
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
            add() {
                this.loading = true;
                this.$refs.pay_add_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.add_modal = false;
                            //todo 向api请求添加数据

                            if (1) //api返回结果
                            {
                                this.form = [];
                                this.$Message.success('添加成功');
                            }
                            else {
                                this.$Message.error('添加失败');
                            }
                        }, 500);
                    }
                    else {
                        this.loading = false;
                        this.$Message.error('添加失败-请完善数据后重新提交');
                    }
                });
            },
            edit () {
                this.loading = true;
                this.$refs.edit_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.edit_modal = false;
                            //todo 向api请求修改数据

                            if (1) //api返回结果
                            {
                                this.$Message.success('修改成功');
                            }
                            else {
                                this.$Message.error('修改失败');
                            }
                        }, 500);
                    }
                    else {
                        this.loading = false;
                        this.$Message.error('修改失败-请完善数据后重新提交');
                    }
                });
            },
            use(){
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.use_modal = false;
                    //todo 数据库修改正在使用的方案
                    if (1) //api返回结果
                    {
                        this.tip = this.data[this.place];
                        this.$Message.success('已启用');
                    }
                    else {
                        this.$Message.error('启用失败');
                    }
                }, 500);
            },
            del () {
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.del_modal = false;
                    //todo 数据库删除当前方案

                    if (1) //api返回结果
                    {
                        this.data.splice(this.place, 1);
                        this.table_total -= 1;
                        this.$Message.success('删除成功');
                    }
                    else {
                        this.$Message.error('删除失败');
                    }
                }, 500);
            }
        },
        mounted()
        {
            this.init();
        }
    };
</script>
