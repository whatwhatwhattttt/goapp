<style lang="less">
    @import './approval.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3">
                    <p class="system-title-color">开店申请</p>
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
                <Button type="primary" :loading="loading" @click="approval(1)">通过</Button>
                <Button type="error" :loading="loading" @click="approval(-1)">拒绝</Button>
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
                page_size: 10,
                sort: 0,
                place: null,
                searchlist: [
                    ['name', '店铺名称'],
                    ['user_name', '申请人']
                ],
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
            //初始化方法
            init(){
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
            approval (state) {
                //state的值是0（未审核） 1（通过）或-1（不通过）
                this.loading = true;
                this.$refs.approval_Form.validate((valid) => {
                    if (valid) {
                        setTimeout(() => {
                            this.loading = false;
                            this.approval_modal = false;
                            //todo 请求api修改商铺审核表数据
                            if (state == 1)//判断api返回值
                            {
                                this.data[this.place].state = '审核通过';
                                //审核后在当前表中移除显示
                                this.data.splice(this.place, 1);
                                this.$Message.success('已审核-审核通过');
                            }
                            else if (state == -1) {
                                this.data[this.place].state = '审核未通过';
                                this.data.splice(this.place, 1);
                                this.$Message.success('已审核-审核未通过');
                            }
                            else {
                                this.$Message.error('审核失败');
                            }
                        }, 500);
                    }
                    else {
                        this.loading = false;
                    }
                });
            }
        },
        mounted () {
            this.init();
        }
    };
</script>
