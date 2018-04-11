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
                older_page: 1,
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
        }
    };
</script>
