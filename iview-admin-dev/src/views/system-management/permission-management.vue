<style lang="less">
    @import './system-management.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
        <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="system-title-color">权限管理</p>
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

                <Col span="3" offset="2">
                <Button @click="add_modal=true" long>添加新权限</Button>
                </Col>
            </Card>
        </Row>
        <Modal v-model="add_modal"
               :loading="loading"
               title="添加新权限">
            <Form ref="add_Form" :label-width="70" :model="form" :rules="rules">
                <FormItem label="权限名称" prop="name">
                    <Input type="text" v-model="form.name" class="system-text"
                           placeholder="输入权限名"/><br>
                </FormItem>
                <FormItem label="说明" prop="description">
                    <Input type="textarea" v-model="form.description" class="system-text"
                           placeholder="输入说明"/><br>
                </FormItem>
            </Form>
            <div slot="footer">
                <Button type="primary" :loading="loading" long @click="add">提交</Button>
            </div>
        </Modal>
        <Modal v-model="edit_modal"
               :loading="loading"
               title="权限信息修改">
            <Form ref="edit_Form" :label-width="70" :model="form1" :rules="rules">
                <FormItem label="权限名称" prop="name">
                    <Input type="text" v-model="form1.name" class="system-text"
                           placeholder="输入权限名"/><br>
                </FormItem>
                <FormItem label="说明" prop="description">
                    <Input type="textarea" v-model="form1.description" class="system-text"
                           placeholder="输入说明"/><br>
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
    export default {
        data () {
            return {
                add_modal: false,
                edit_modal: false,
                del_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                page_size: 10,
                sort: 0,
                place: null,
                searchlist: [
                    ['name', '权限名'],
                    ['description', '权限说明']
                ],
                form: {
                    name: '',
                    description: ''
                },
                form1: {
                    name: '',
                    description: ''
                },
                rules: {
                    name: [
                        {required: true, message: '权限名不能为空', trigger: 'blur'}
                    ],
                    description: [
                        {required: true, message: '说明不能为空', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        title: '权限名',
                        width: 150,
                        key: 'name',
                    },
                    {
                        title: '权限说明',
                        key: 'description'
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
            }
                ;
        },
        methods: {
            //初始化方法
            init(){
                // todo 向api请求100条初始数据并放入serverdata
                this.serverdata = {
                    //以下为数据格式
                    //数据库中该表共有数据条数
                    datalength: 7,
                    //100条初始数据
                    data: [{
                        name: '123123',
                        description: '123234123'
                    },
                        {
                            name: '123123',
                            description: '123234123'
                        },
                        {
                            name: '123123',
                            description: '123234123'
                        },
                        {
                            name: '123123',
                            description: '123234123'
                        },
                        {
                            name: '123123',
                            description: '123234123'
                        },
                        {
                            name: '123123',
                            description: '123234123'
                        },
                        {
                            name: '123123',
                            description: '123234123'
                        }]
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
            add () {
                this.loading = true;
                this.$refs.add_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.add_modal = false;
                            //todo 向api请求修改
                            if (1) //api返回条件
                            {
                                this.form = [];
                                this.$Message.success('添加成功');
                            }
                            else {
                                this.$Message.error('添加失败-');
                            }

                        }, 500);
                    }
                    else {
                        this.loading = false;
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
                            //todo 向api请求修改
                            if (1) //api返回条件
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
                        this.$Message.error('修改失败-请完善表单后重新提交');
                    }
                });
            },
            del () {
                this.loading = true;
                setTimeout(() => {
                    this.loading = false;
                    this.del_modal = false;
                    //todo 向api请求修改
                    if (1) //api返回条件
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
            this.init();
        }
    };
</script>
