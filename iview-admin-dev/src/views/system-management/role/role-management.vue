<style lang="less">
    @import './../system-management.less';
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
                    <Button @click="admin_role_add_modal=true" long>添加新角色</Button>
                    <!--<Button @click="test" long>测试</Button>-->
                    <Modal v-model="admin_role_add_modal"
                           :loading="admin_role_add_loading"
                           title="添加新角色">
                        <Form ref="admin_role_add_Form" :label-width="70" :model="form" :rules="rules">
                            <FormItem label="角色名称" prop="name">
                                <Input type="text" v-model="form.name" class="system-text"
                                       placeholder="输入员工角色名"/><br>
                            </FormItem>
                            <FormItem label="说明" prop="description">
                                <Input type="text" v-model="form.description" class="system-text"
                                       placeholder="输入"/><br>
                            </FormItem>
                            <FormItem label="权限">
                                <CheckboxGroup v-model="form.permission">
                                    <Checkbox label="Eat"></Checkbox>
                                    <Checkbox label="Sleep"></Checkbox>
                                    <Checkbox label="Run"></Checkbox>
                                    <Checkbox label="Movie"></Checkbox>
                                    <Checkbox label="Eat1"></Checkbox>
                                    <Checkbox label="Sleep1"></Checkbox>
                                    <Checkbox label="Run1"></Checkbox>
                                </CheckboxGroup>
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
            <div style="text-align: center;">
                <Page :total="100" :current="1" @on-change="changePage"></Page>
            </div>
            <Modal v-model="admin_role_edit_modal"
                   :loading="admin_role_edit_loading"
                   title="员工信息修改">
                <Form ref="admin_role_edit_Form" :label-width="70" :model="form2" :rules="rules">
                    <FormItem label="角色名称" prop="name">
                        <Input type="text" v-model="form2.name" class="system-text"
                               placeholder="输入员工角色名"/><br>
                    </FormItem>
                    <FormItem label="说明" prop="description">
                        <Input type="text" v-model="form2.description" class="system-text"
                               placeholder="输入说明"/><br>
                    </FormItem>
                    <FormItem label="权限">
                        <CheckboxGroup v-model="form.permission">
                            <Checkbox label="Eat"></Checkbox>
                            <Checkbox label="Sleep"></Checkbox>
                            <Checkbox label="Run"></Checkbox>
                            <Checkbox label="Movie"></Checkbox>
                            <Checkbox label="Eat1"></Checkbox>
                            <Checkbox label="Sleep1"></Checkbox>
                            <Checkbox label="Run1"></Checkbox>
                        </CheckboxGroup>
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
                admin_role_add_modal: false,
                admin_role_edit_modal: false,
                admin_role_add_loading: false,
                admin_role_edit_loading: false,
                form: {
                    name: '',
                    description: '',
                    permission:[]
                },
                form1: {
                    name: '',
                    description: '',
                    permission:[]
                },
                form2: {},
                rules: {
                    name: [
                        {required: true, message: '角色名不能为空', trigger: 'blur'}
                    ],
                    description: [
                        {required: true, message: '说明不能为空', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        title: '角色名',
                        width: 200,
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
                        title: '说明',
                        key: 'description'
                    },
                    {
                        title: '权限',
                        key: 'permission'
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
                                            this.form2 = this.data[params.index];
                                            this.admin_role_edit_modal = true;
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
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
                    {
                        name: '123123',
                        description: '123234123',
                        permission:[]
                    },
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
                this.admin_role_add_loading = true;
                this.$refs.admin_role_add_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.admin_role_add_loading = false;
                            this.admin_role_add_modal = false;
                            this.$Message.success('添加成功');
                        }, 500);
                    }
                    else {
                        this.$Message.error('添加失败');
                    }
                    this.form=this.form1;
                    alert(1);
                });
            },
            admin_edit (index) {
                this.admin_role_add_loading = true;
                this.$refs.admin_role_edit_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.admin_role_edit_loading = false;
                            this.admin_role_edit_modal = false;
                            this.$Message.success('修改成功');
                        }, 500);
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
