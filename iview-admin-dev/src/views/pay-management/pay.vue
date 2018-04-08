<style lang="less">
    @import './pay.less';
    @import './../../styles/common.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="5" offset="10">
                    <p class="pay-title-color">支付管理</p>
                    </Col>
                    <Col span="3" offset="5">
                    <Button @click="add_modal=true" long>添加模板</Button>
                    </Col>
                </Row>
            </card>
            </Col>
        </Row>
        <Row>
            <card class="pay-tip">
                <Col span="24">
                <Row>
                    <Col class="pay-text" span="4">
                    <span>已启用模板>>>>>></span>
                    </Col>

                    <Col span="9">
                    <Input type="text" v-model="tip.wechat" readonly>
                    <span slot="prepend">微信账号：</span>
                    </Input>
                    </Col>

                    <Col span="9" offset="1">
                    <Input type="text" v-model="tip.alipay" readonly>
                    <span slot="prepend">支付宝账号：</span>
                    </Input>

                    </Col>
                </Row>
                </Col>
            </card>
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
        <Modal v-model="add_modal"
               :loading="loading"
               title="添加模板">
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
                <Button type="primary" long @click="pay_add">提交</Button>
            </div>
        </Modal>
        <Modal v-model="edit_modal"
               :loading="loading"
               title="模板修改">
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
                <Button type="primary" long @click="edit">确定修改</Button>
            </div>
        </Modal>
        <Modal
                v-model="use_modal"
                title="确定启用？"
                :loading="loading"
                @on-ok="use">
            <p style="color: #1cc100;text-align:center;font-size: 25px">
                <Icon type="information-circled"></Icon>
                <span>确定启用？</span>
            </p>
        </Modal>
        <Modal
                v-model="del_modal"
                :loading="loading"
                @on-ok="del">
            <p style="color:#f60;text-align:center;font-size: 25px">
                <Icon type="information-circled"></Icon>
                <span>确定删除？</span>
            </p>
        </Modal>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                tip: {
                    //todo 加载页面时自动向数据库请求并更改内部数据为正在使用的账号数据
                    wechat: '111',
                    alipay: '222'
                },
                add_modal: false,
                edit_modal: false,
                use_modal: false,
                del_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                older_page: 1,
                place: null,
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
                    }
                    ,
                    {
                        title: '支付宝账号',
                        key: 'alipay'
                    }
                    ,
                    {
                        title: 'Action',
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
                //todo 替换为接口数据
                data: [
                    {
                        number: 7,
                        wechat: '18',
                        alipay: 'New York No. 1 Lake Park',
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
                    }

                ]
            }
                ;
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
                        this.$Message.error('修改失败-请完善数据后重新提交');
                    }
                });
            },
            use(){
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.use_modal = false;
                    //todo 数据库修改正在使用的模板
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
                    //todo 数据库删除当前模板

                    if (1) //api返回结果
                    {
                        this.data.splice(this.place, 1);
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
            // todo 向api请求100条初始数据并放入serverdata
            this.serverdata = {
                //以下为数据格式
                //数据库中该表共有数据条数
                datalength: 12,
                //100条初始数据
                data: [
                    {
                        number: 7,
                        wechat: '18',
                        alipay: 'New York No. 1 Lake Park',
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
                    }

                ]
            };
            this.table_total = this.serverdata.datalength;
            this.changepage(1);
        }
    };
</script>
