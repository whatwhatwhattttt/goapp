<style lang="less">
    @import './employee-management.less';
</style>
<template>
    <div class="em">
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="8" offset="9">
                    <p class="employee-title-color">数据宝贵请确认后再删除！</p>
                    </Col>
                    <Col span="3" offset="3">
                    <Button @click="admin_user_add=true" long>添加</Button>
                    <!--<Button @click="test" long>测试</Button>-->
                    <Modal v-model="admin_user_add"
                           :loading="add_loading"
                           title="添加新员工">
                        <Form ref="admin_add_Form" :label-width="70" :model="form" :rules="rules">
                            <FormItem label="账号" prop="admin_id">
                                <Input type="text" v-model="form.admin_id" class="employee-add-text"
                                       placeholder="输入员工账号"/><br>
                            </FormItem>
                            <FormItem label="密码" prop="password">
                                <Input type="text" v-model="form.password" class="employee-add-text"
                                       placeholder="输入员工密码"/><br>
                            </FormItem>
                            <FormItem label="姓名" prop="name">
                                <Input type="text" v-model="form.name" class="employee-add-text"
                                       placeholder="输入员工姓名"/><br>
                            </FormItem>
                            <FormItem label="年龄" prop="age">
                                <Input type="text" v-model="form.age" class="employee-add-text"
                                       placeholder="输入员工年龄"/><br>
                            </FormItem>
                            <FormItem label="工号" prop="job_number">
                                <Input type="text" v-model="form.job_number" class="employee-add-text"
                                       placeholder="输入员工工号"/><br>
                            </FormItem>
                            <FormItem label="职位" prop="position">
                                <Input type="text" v-model="form.position" class="employee-add-text"
                                       placeholder="输入员工职位"/><br>
                            </FormItem>
                        </Form>
                        <div slot="footer">
                            <Button type="primary" long @click="admin_add">提交</Button>
                        </div>
                    </Modal>
                    </Col>
                </Row>
            </card>
            </Col>
        </Row>
        <Row>
            <Table border :columns="columns" :data="data"></Table>
            <div style="float: right;">
                <Page :total="100" :current="1" @on-change="changePage"></Page>
            </div>
            <Modal v-model="admin_user_edit"
                   :loading="edit_loading"
                   title="员工信息修改">
                <Form ref="admin_edit_Form" :label-width="70" :model="form2" :rules="rules">
                    <FormItem label="账号" prop="admin_id">
                        <Input type="text" v-model="form2.admin_id" class="employee-add-text"
                               placeholder="输入员工账号"/><br>
                    </FormItem>
                    <FormItem label="密码" prop="password">
                        <Input type="text" v-model="form2.password" class="employee-add-text"
                               placeholder="输入员工密码"/><br>
                    </FormItem>
                    <FormItem label="姓名" prop="name">
                        <Input type="text" v-model="form2.name" class="employee-add-text"
                               placeholder="输入员工姓名"/><br>
                    </FormItem>
                    <FormItem label="年龄" prop="age">
                        <Input type="text" v-model="form2.age" class="employee-add-text"
                               placeholder="输入员工年龄"/><br>
                    </FormItem>
                    <FormItem label="工号" prop="job_number">
                        <Input type="text" v-model="form2.job_number" class="employee-add-text"
                               placeholder="输入员工工号"/><br>
                    </FormItem>
                    <FormItem label="职位" prop="position">
                        <Input type="text" v-model="form2.position" class="employee-add-text"
                               placeholder="输入员工职位"/><br>
                    </FormItem>
                </Form>
                <div slot="footer">
                    <Button type="primary" long @click="admin_edit">确定修改</Button>
                </div>
            </Modal>
        </Row>
    </div>

</template>
<script>
    export default {
        data () {
            return {
                admin_user_add: false,
                admin_user_edit: false,
                add_loading: false,
                edit_loading: false,
                form: {
                    admin_id: '',
                    password: '',
                    name: '',
                    age: '',
                    job_number: '',
                    position: ''
                },
                form2: {
                },
                rules: {
                    admin_id: [
                        {required: true, message: '账号不能为空', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不能为空', trigger: 'blur'}
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
                        title: '姓名',
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
                        width: 220,
                        key: 'job_number'
                    },
                    {
                        title: '职位',
                        key: 'position'
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
                                            this.form2=this.data[params.index];
                                            this.admin_user_edit=true;
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
                                            this.remove(params.index);
                                        }
                                    }
                                }, '删除')
                            ]);
                        }
                    }
                ],
                data: [
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '123123',
                        password: '123234123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '123123',
                        password: '457'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '123123',
                        password: '123453'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '123123',
                        password: '12678273'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '1234538993',
                        password: '122423'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '122352123',
                        password: '123vzxvv123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '12fsgfhdf123',
                        password: '12asfhf123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: 'adw55ryt23',
                        password: '12dgdddfyr3'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '12sfhsfb3123',
                        password: '123srh123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '12sfhsz43633123',
                        password: '123123'
                    },
                    {
                        name: 'John Brown',
                        age: 18,
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        admin_id: '12fdfsh3123',
                        password: '123sh577123'
                    }
                ]
            };
        },
        methods: {

            test(){
//                alert(111);
//                alert(Cookies.get());
            },
//            todo 分页操作
//            pagechange(){
//
//            },
            admin_add () {
                this.add_loading = true;
                this.$refs.admin_add_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.add_loading = false;
                            this.admin_user_add = false;
                            this.$Message.success('添加成功');
                        }, 2000);
                    }
                    else {
                        this.$Message.error('添加失败');
                    }
                });
            },
            admin_edit (index) {
                this.add_loading = true;
                this.$refs.admin_edit_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.edit_loading = false;
                            this.admin_user_edit = false;
                            this.$Message.success('修改成功');
                        }, 2000);
                    }
                    else {
                        this.$Message.error('修改失败');
                    }
                });
            },
            remove (index) {
                this.data.splice(index, 1);
            }

        }
    };
</script>
