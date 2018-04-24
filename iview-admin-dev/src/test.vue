<template>
    <div>
        <Row>
            <Col>
            <Card>
                <Row>
                    <Col span="10" offset="7">
                    <zxksearch :selectlist="selectlist" :loading="loading" @zxksearch_f="search"></zxksearch>
                    </Col>
                </Row>
            </Card>
            </Col>
        </Row>
    </div>
</template>


<script>
    export default{
        data () {
            return {
                loading: false,
                selectlist: [
                    ['wechat', '微信账号'],
                    ['wechat_balance', '微信账号内资金'],
                    ['alipay', '支付宝账号'],
                    ['alipay_balance', '支付宝账号内资金']
                ]
            };
        },
        methods: {
            search (index) {
                this.loading = true;
                setTimeout(() => {
                    if (this.search_t && this.search_t.trim() != '') {
                        // todo 向api发送字符串并返回匹配数据
                        //  this.serverdata=
                        this.init();
                    }
                    else {
                        this.$Message.error('输入要搜索的内容');
                        this.search_t = null;
                    }
                    this.loading = false;
                }, 500);
            }
        }
    };
</script>