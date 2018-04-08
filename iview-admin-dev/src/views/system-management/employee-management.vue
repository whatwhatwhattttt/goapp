<style lang="less">
    @import './system-management.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="8" offset="9">
                    <p class="system-title-color">数据宝贵请确认后再删除！</p>
                    </Col>
                    <Col span="3" offset="3">
                    <Button @click="add_modal=true" long>添加新员工</Button>
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
        <Modal v-model="add_modal"
               :loading="loading"
               title="添加新员工">
            <Form ref="add_Form" :label-width="70" :model="form" :rules="rules">
                <FormItem label="账号" prop="admin_id">
                    <Input type="text" v-model="form.admin_id" class="system-text"
                           placeholder="输入员工账号"/><br>
                </FormItem>
                <FormItem label="密码" prop="password">
                    <Input type="text" v-model="form.password" class="system-text"
                           placeholder="输入员工密码"/><br>
                </FormItem>
                <FormItem label="姓名" prop="name">
                    <Input type="text" v-model="form.name" class="system-text"
                           placeholder="输入员工姓名"/><br>
                </FormItem>
                <FormItem label="年龄" prop="age">
                    <Input type="text" v-model="form.age" class="system-text"
                           placeholder="输入员工年龄"/><br>
                </FormItem>
                <FormItem label="工号" prop="job_number">
                    <Input type="text" v-model="form.job_number" class="system-text"
                           placeholder="输入员工工号"/><br>
                </FormItem>
                <FormItem label="职位" prop="position">
                    <Input type="text" v-model="form.position" class="system-text"
                           placeholder="输入员工职位"/><br>
                </FormItem>
                <FormItem label="角色">
                    <CheckboxGroup v-model="form.role_array">
                        <Checkbox v-for="item in createrole" :label=item></Checkbox>
                    </CheckboxGroup>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="primary" long @click="add">提交</Button>
            </div>
        </Modal>
        <Modal v-model="edit_modal"
               :loading="loading"
               title="员工信息修改">
            <Form ref="edit_Form" :label-width="70" :model="form1" :rules="rules">
                <FormItem label="账号" prop="admin_id">
                    <Input type="text" v-model="form1.admin_id" class="system-text"
                           placeholder="输入员工账号"/><br>
                </FormItem>
                <FormItem label="密码" prop="password">
                    <Input type="text" v-model="form1.password" class="system-text"
                           placeholder="输入员工密码"/><br>
                </FormItem>
                <FormItem label="姓名" prop="name">
                    <Input type="text" v-model="form1.name" class="system-text"
                           placeholder="输入员工姓名"/><br>
                </FormItem>
                <FormItem label="年龄" prop="age">
                    <Input type="text" v-model="form1.age" class="system-text"
                           placeholder="输入员工年龄"/><br>
                </FormItem>
                <FormItem label="工号" prop="job_number">
                    <Input type="text" v-model="form1.job_number" class="system-text"
                           placeholder="输入员工工号"/><br>
                </FormItem>
                <FormItem label="职位" prop="position">
                    <Input type="text" v-model="form1.position" class="system-text"
                           placeholder="输入员工职位"/><br>
                </FormItem>
                <FormItem label="角色">
                    <CheckboxGroup v-model="form1.role_array">
                        <Checkbox v-for="item in createrole" :label=item></Checkbox>
                    </CheckboxGroup>
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
                <span>确定删除？</span>
            </p>
        </Modal>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                add_modal: false,
                edit_modal: false,
                del_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                older_page: 1,
                place: null,
                //todo 向api请求角色数组
                createrole: ['1', '2', '3', '4'],
                form: {
                    admin_id: '',
                    password: '',
                    name: '',
                    age: '',
                    job_number: '',
                    position: '',
                    role: '',
                    role_array: []
                },
                form1: {
                    admin_id: '',
                    password: '',
                    name: '',
                    age: '',
                    job_number: '',
                    position: '',
                    role: '',
                    role_array: []
                },
                rules: {
                    admin_id: [
                        {required: true, message: '账号不能为空', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不能为空', trigger: 'blur'},
                        {min: 6, max: 16, message: '密码在6-16位之间', trigger: 'blur'},
                    ],
                    name: [
                        {required: true, message: '姓名不能为空', trigger: 'blur'}
                    ],
                    job_number: [
                        {required: true, message: '工号不能为空', trigger: 'blur'}
                    ],
                    position: [
                        {required: true, message: '职位不能为空', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
                    {
                        title: '姓名',
                        width: 150,
                        key: 'name',
                        render: (h, params) => {
                            return h('div', [
                                h('Icon', {
                                    props: {
                                        type: 'person'
                                    }
                                }),
                                h('strong', params.row.name)
                            ]);
                        }
                    },
                    {
                        title: '年龄',
                        width: 70,
                        key: 'age'
                    },
                    {
                        title: '工号',
                        width: 180,
                        key: 'job_number'
                    },
                    {
                        title: '职位',
                        width: 100,
                        key: 'position'
                    },
                    {
                        title: '角色',
                        key: 'role'
                    },
                    {
                        title: '账号',
                        key: 'admin_id'
                    },
                    {
                        title: '密码',
                        key: 'password'
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
                                            this.form1 = this.data[params.index];
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
            add () {
                this.loading = true;
                this.$refs.add_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.add_modal = false;
                            //todo 向api请求插入员工数据

                            if (1)//返回值判断
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
                        this.$Message.error('添加失败-请完善表单信息后重新提交');
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
                            //todo 修改api员工数据

                            if (1)//判断api返回值
                            {
                                this.data[this.place].role = this.form1.role_array.join(",");
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
                    //todo 从api删除当前员工
                    if (1)//判断api返回值
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
        mounted () {
            // todo 向api请求100条初始数据并放入serverdata
            this.serverdata = {
                //以下为数据格式
                //数据库中该表共有数据条数
                datalength: 7,
                //100条初始数据
                data: [
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        role_array: ['1', '2'],
                        admin_id: '123123',
                        password: '123234123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        role_array: ['1', '2'],
                        admin_id: '123123',
                        password: '123234123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        role_array: ['1', '2'],
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
                    },
                    {
                        name: 'John Brown',
                        age: 123123,
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
