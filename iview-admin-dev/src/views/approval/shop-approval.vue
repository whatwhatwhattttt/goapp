<style lang="less">
    @import './approval.less';
</style>
<template>
    <div>
        <Row>
            <Col span="24">
            <card>
                <Row>
                    <Col span="7" offset="11">
                    <p class="system-title-color">开店申请</p>
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
        <Modal v-model="approval_modal"
               :loading="loading"
               title="商铺申请审核详情页面">
            <Form ref="approval_Form" :label-width="70" :model="form" :rules="rules">
                <FormItem label="商铺名称" prop="name">
                    <Input type="text" v-model="form.name" class="system-text" readonly
                           placeholder="商铺名称"/><br>
                </FormItem>
                <FormItem label="申请人" prop="user_name">
                    <Input type="text" v-model="form.user_name" class="system-text" readonly
                           placeholder="申请人"/><br>
                </FormItem>
                <FormItem label="申请时间" prop="create_time">
                    <Input type="text" v-model="form.create_time" class="system-text" readonly
                           placeholder="申请时间"/><br>
                </FormItem>
                <FormItem label="审核意见" prop="description">
                    <Input type="textarea" v-model="form.description" class="system-text"
                           placeholder="审核意见"/><br>
                </FormItem>
            </Form>
            <div slot="footer" align="center">
                <Button type="primary" @click="approval(1)">通过</Button>
                <Button type="error" @click="approval(-1)">拒绝</Button>
            </div>
        </Modal>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                approval_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                older_page: 1,
                place: null,
                form: {
                    name: '',
                    user_name: '',
                    create_time: '',
                    description: ''
                },
                rules: {
                    description: [
                        {required: true, message: '审核意见不能为空', trigger: 'blur'},
                        {min: 2, message: '审核意见不能小于2个字符', trigger: 'blur'}
                    ]
                },
                columns: [
                    {
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
                    {
                        title: '商铺名称',
                        width: 150,
                        key: 'name'
                    },
                    {
                        title: '申请人',
                        width: 150,
                        key: 'user_name'
                    },
                    {
                        title: '状态',
                        key: 'state'
                    },
                    {
                        title: '审核意见',
                        key: 'description'
                    },
                    {
                        title: '申请时间',
                        key: 'create_time'
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
                                            this.form = this.data[params.index];
                                            this.approval_modal = true;
                                        }
                                    }
                                }, '详情审核')
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
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    },
                    {
                        name: 'John Brown',
                        user_name: 18,
                        create_time: 'New York No. 1 Lake Park',
                        description: '24351166166163113431',
                        state: '未审核'
                    }
                ]
            };
            this.table_total = this.serverdata.datalength;
            this.changepage(1);
        }
    };
</script>
