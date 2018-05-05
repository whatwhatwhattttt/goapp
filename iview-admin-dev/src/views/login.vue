<style lang="less">
    @import './login.less';
</style>

<template>
    <div class="login" @keydown.enter="login">
        <div class="login-con">
            <Card :bordered="false">
                <p slot="title">
                    <Icon type="log-in"></Icon>
                    欢迎登录
                </p>
                <div class="form-con">
                    <Form ref="loginForm" :model="form" :rules="rules">
                        <FormItem prop="admin_id">
                            <Input v-model="form.admin_id" placeholder="请输入用户名">
                            <span slot="prepend">
                                    <Icon :size="16" type="person"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem prop="password">
                            <Input type="password" v-model="form.password" placeholder="请输入密码">
                            <span slot="prepend">
                                    <Icon :size="14" type="locked"></Icon>
                                </span>
                            </Input>
                        </FormItem>
                        <FormItem>
                            <Button @click="login" type="primary" long>登录</Button>
                        </FormItem>
                    </Form>

                </div>
            </Card>
        </div>
    </div>
</template>

<script>
 //   import Cookies from 'js-cookie';
    import jwtToken from './../libs/helpers/jwt'
    export default {
        data () {
            return {
                form: {
                    admin_id: '',
                    password: ''
                },
                rules: {
                    admin_id: [
                        {required: true, message: '账号不能为空', trigger: 'blur'},
                        {max: 16, message: '账号应小于16个字符', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: '密码不能为空', trigger: 'blur'},
                        {min: 6, max: 16, message: '密码长度应为6-16位', trigger: 'blur'}
                    ]
                }
            };
        },
        methods: {
            login(){
                let formData={
                    email:this.form.admin_id,
                    password:this.form.password
                };
                this.$store.dispatch('loginRequest',formData).then(response=>{
                    this.$route.push({name:'home_index'})
                })
            }
        }
    };
</script>

<style>

</style>
