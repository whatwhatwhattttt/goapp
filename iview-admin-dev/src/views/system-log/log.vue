<style lang="less">
    @import './log.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="10" offset="7">
                    <!--todo 每月自动清理功能留待后期完善-->
                    <p class="log-title-color">系统管理日志（每月初将自动清理两月前的日志）</p>
                    </Col>
                    <!--todo 此处可添加详细查询之类的按钮并添加相应事件，待后期完善-->
                    <!--<Col span="3" offset="3">-->
                    <!--<Button @click="del_modal=true" long>日志清理</Button>-->
                    <!--</Col>-->
                </Row>
            </card>
            </Col>
        </Row>
        <Row>
            <Table border :columns="columns" :data="data"></Table>
            <div style="text-align: center;">
                <Page :total="100" :current="1" @on-change="changePage"></Page>
            </div>

        </Row>
        <!--以下为输入模板案例-->
        <!--<Modal v-model="del_modal"-->
               <!--:loading="loading"-->
               <!--title="添加新员工">-->
            <!--<Form ref="del_Form" :label-width="70" :model="form" :rules="rules">-->
                <!--<FormItem label="账号" prop="admin_id">-->
                    <!--<Input type="text" v-model="form.admin_id" class="log-text"-->
                           <!--placeholder="输入员工账号"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="密码" prop="password">-->
                    <!--<Input type="text" v-model="form.password" class="log-text"-->
                           <!--placeholder="输入员工密码"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="姓名" prop="name">-->
                    <!--<Input type="text" v-model="form.name" class="log-text"-->
                           <!--placeholder="输入员工姓名"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="年龄" prop="age">-->
                    <!--<Input type="text" v-model="form.age" class="log-text"-->
                           <!--placeholder="输入员工年龄"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="工号" prop="job_number">-->
                    <!--<Input type="text" v-model="form.job_number" class="log-text"-->
                           <!--placeholder="输入员工工号"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="职位" prop="position">-->
                    <!--<Input type="text" v-model="form.position" class="log-text"-->
                           <!--placeholder="输入员工职位"/><br>-->
                <!--</FormItem>-->
                <!--<FormItem label="角色">-->
                    <!--<CheckboxGroup v-model="form.role_array">-->
                        <!--<Checkbox v-for="item in createrole" :label=item></Checkbox>-->
                    <!--</CheckboxGroup>-->
                <!--</FormItem>-->
            <!--</Form>-->
            <!--<div slot="footer">-->
                <!--<Button type="primary" long @click="add">提交</Button>-->
            <!--</div>-->
        <!--</Modal>-->
    </div>
</template>
<script>
    export default {

        data () {
            return {
                del_modal: false,
                loading: false,
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
                        title: '姓名',
                        width: 150,
                        key: 'name'
                    },
                    {
                        title: '工号',
                        width: 180,
                        key: 'job_number'
                    },
                    {
                        title: '职位',
                        key: 'position'
                    },
                    {
                        title: '角色',
                        key: 'role'
                    },
                    {
                        title: '操作内容',
                        key: 'description'
                    },
                    {
                        title: '操作时间',
                        key: 'time'
                    }
                ],
                data: [
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },
                    {
                        name: 'John Brown',
                        job_number: 'New York No. 1 Lake Park',
                        position: '仓库管理',
                        role: '1,2',
                        description: ['1', '2'],
                        time: '123123'
                    },

                ]
            };
        },
        methods: {
//            todo 分页操作
//            pagechange(){
//
//            },
//            del () {
//                this.loading = true;
//                this.$refs.del_Form.validate((valid) => {
//                    if (valid) {
//                        setTimeout(() => {
//                            this.loading = false;
//                            this.del_modal = false;
//                            //todo 向api插入员工数据
//
//                            if (1)//返回值判断
//                            {
//                                this.form = [];
//                                this.$Message.success('添加成功');
//                            }
//                            else {
//                                this.$Message.error('添加失败');
//                            }
//                        }, 500);
//                    }
//                    else {
//                        this.$Message.error('添加失败-请完善表单信息后重新提交');
//                    }
//                });
//            }
        }
    };
</script>
