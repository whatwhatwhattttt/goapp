<template>
    <div>
        <Row>
            <Col span="24">
            <Card>
                <Row>
                    <Col span="2" offset="10">
                    <p class="transaction-title-color">交易详情</p>
                    </Col>
                </Row>
            </Card>
            </Col>
        </Row>
        <Row>
            <Card>
                <Row class="expand-row">
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">交易编号: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.id }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">商品名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">买家昵称: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.buyers_name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">商店名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.shop_name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">卖家昵称: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.seller_name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">联系买家: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.buyers_phone }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">联系卖家: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.seller_phone }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">物品价格: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.price }}<Icon
                            type="social-yen"></Icon></span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">交易状态: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.state }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">类&emsp;&emsp;别: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.type }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">位&emsp;&emsp;置: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.position }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">创建时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.create_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">更新时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.updata_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="transactioninfo-key">物品介绍: </span>
                    </Col>
                    <Col span="14">
                    <span class="transactioninfo-value">{{ this.transactiondata.description }}</span>
                    </Col>
                </Row>
            </Card>
        </Row>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                stop_modal: false,
                operate_modal: false,
                name: 'transaction-info',
                transactiondata: {}
            };
        },
        methods: {
            init () {
                this.transactiondata = this.$route.query;
            }
        },
        mounted () {
            this.init();
        },
        watch: {
            '$route' () {
                this.init();
            }
        }
    };
</script>
