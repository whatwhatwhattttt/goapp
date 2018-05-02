<style lang="less">
    @import './log.less';
</style>
<template>
    <div>
        <Row style="position:fixed;top:100px;z-index: 999;width:100%">
            <Col span="21">
            <card>
                <Row>
                    <Col span="3" style="overflow:hidden;
  text-overflow:clip;">
                    <!--todo 每月自动清理功能留待后期完善-->
                    <p class="log-title-color">系统管理日志</p>
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
    </div>
</template>
<script>
    export default {
        data () {
            return {
                del_modal: false,
                loading: false,
                table_total: null,
                current_page: 1,
                page_size: 10,
                sort: 0,
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
                        title: '索引',
                        width: 100,
                        type: 'index'
                    },
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
                data: [],
                serverdata: []
            };
        },
        methods: {
            //  初始化方法
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
            }
        },
        mounted () {
            this.init();
        }
    };
</script>
