<style lang="less">
    @import './user.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="3" offset="11">
                    <p class="system-title-color">用户数据</p>
                    </Col>
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
        <Modal v-model="edit_modal"
               :loading="loading"
               title="用户信息修改">
            <Form ref="edit_Form" :label-width="70" :model="form" :rules="rules">
                <FormItem label="账号" prop="mobile_phone">
                    <Input type="text" v-model="form.mobile_phone" class="system-text"
                           placeholder="输入用户账号"/><br>
                </FormItem>
                <FormItem label="密码" prop="password">
                    <Input type="text" v-model="form.password" class="system-text"
                           placeholder="输入用户密码"/><br>
                </FormItem>
                <FormItem label="昵称" prop="nickname">
                    <Input type="text" v-model="form.nickname" class="system-text"
                           placeholder="输入用户昵称"/><br>
                </FormItem>
                <FormItem label="性别" prop="gander">
                    <Input type="text" v-model="form.gander" class="system-text"
                           placeholder="输入用户性别"/><br>
                </FormItem>
                <FormItem label="真实姓名" prop="realname">
                    <Input type="text" v-model="form.realname" class="system-text"
                           placeholder="输入用户真实姓名"/><br>
                </FormItem>
                <FormItem label="邮箱" prop="mail">
                    <Input type="text" v-model="form.mail" class="system-text"
                           placeholder="输入用户邮箱"/><br>
                </FormItem>
                <FormItem label="qq" prop="qq">
                    <Input type="text" v-model="form.qq" class="system-text"
                           placeholder="输入用户qq"/><br>
                </FormItem>
                <FormItem label="身份证" prop="id_card">
                    <Input type="text" v-model="form.id_card" class="system-text"
                           placeholder="输入用户身份证"/><br>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="primary" long @click="edit">确定修改</Button>
            </div>
        </Modal>
        <Modal
                v-model="del_modal"
                :loading="loading"
                @on-ok="del">
            <p style="color:#f60;text-align:center;font-size: 25px">
                <Icon type="information-circled"></Icon>
                <span>确定删除？数据重要请三思后行</span>
            </p>
        </Modal>
    </div>
</template>
<script>
    import expandRow from './user-table-expand.vue';
    export default {
        components: {expandRow},
        data () {
            return {
                edit_modal: false,
                del_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                older_page: 1,
                place: null,
                form: {},
                rules: {
                    mobile_phone: [
                        {required: true, message: '账号不能为空', trigger: 'blur'},
                        {min: 6, max: 16, message: '密码在6-16位之间', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不能为空', trigger: 'blur'},
                        {min: 6, max: 16, message: '密码在6-16位之间', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        type: 'expand',
                        width: 50,
                        render: (h, params) => {
                            return h(expandRow, {
                                props: {
                                    row: params.row
                                }
                            })
                        }
                    },
                    {
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
                    {
                        title: '账号',
                        key: 'mobile_phone'
                    },
                    {
                        title: '昵称',
                        key: 'nicknickname'
                    },
                    {
                        title: '性别',
                        key: 'gander'
                    },
                    {
                        title: '年龄',
                        key: 'age'
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
                                        size: 'small'
                                    },
                                    style: {
                                        marginRight: '5px'
                                    },
                                    on: {
                                        click: () => {
                                            this.place = params.index;
                                            this.form = this.data[params.index];
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
                                            this.place = params.index;
                                            this.del_modal = true;
                                        }
                                    }
                                }, '删除')
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
            edit () {
                this.loading = true;
                this.$refs.edit_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.edit_modal = false;
                            //todo 修改api用户数据

                            if (1)//判断api返回值
                            {
                                this.$Message.success('修改成功');
                            }
                            else {
                                this.$Message.error('修改失败');
                            }
                        }, 500);
                    }
                });
            },
            del () {
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.del_modal = false;
                    //todo 从api删除当前用户
                    if (1)//判断api返回值
                    {
                        this.data.splice(this.place, 1);
                        this.$Message.success('修改成功');
                    }
                    else {
                        this.$Message.error('修改失败');
                    }
                }, 500);

            }
        },
        mounted () {
            // todo 向api请求100条初始数据并放入serverdata
            this.serverdata = {
                //以下为数据格式
                //数据库中该表共有数据条数
                datalength: 8,
                //100条初始数据
                data: [
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },

                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    },
                    {
                        mobile_phone: '18072078275',
                        nicknickname: '哎呦我去',
                        gander: 'man',
                        age: '18',
                        realname: 'zxk',
                        mail: '475811666@qq.com',
                        qq: '475811666',
                        password: '123234123',
                        id_card: '33333333333333333333',
                        create_time: '2018-asd-22'
                    }
                ]
            };
            this.table_total = this.serverdata.datalength;
            this.changepage(1);
        }
    };
</script>
