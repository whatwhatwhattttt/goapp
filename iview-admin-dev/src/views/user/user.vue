<style lang="less">
    @import './user.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="system-title-color">用户数据</p>
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
                <Button type="primary" :loading="loading" long @click="edit">确定修改</Button>
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
                page_size: 10,
                sort: 0,
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
                        title: '账号（邮箱）',
                        key: 'mail'
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
                        title: '是否是卖家',
                        key: 'businessman'
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
                searchlist: [
                    ['mail', '账号（邮箱）'],
                    ['nickname', '昵称'],
                    ['id_card', '身份证号'],
                    ['realname', '真实姓名'],
                    ['qq', 'QQ'],
                    ['mobile_phone', '手机']
                ],
            };
        },
        methods: {
            //初始化方法
            init(){
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
                    else {
                        this.loading = false;
                        this.$Message.error('修改失败-请完善表单信息后重新提交');
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
            this.init();
        }
    };
</script>
