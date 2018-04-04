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
        <!--<Row>-->
        <!--<Card>-->
        <!--<Row>-->
        <!--<Col span="7" offset="8">-->
        <!--<Button v-if="this.transactiondata.run" type="error" long @click="stop_modal=true">强制停业</Button>-->
        <!--<Button v-else type="primary" long @click="operate_modal=true">强制运营</Button>-->
        <!--</Col>-->
        <!--</Row>-->
        <!--</Card>-->
        <!--</Row>-->
        <!--<Modal-->
        <!--v-model="stop_modal"-->
        <!--:loading="loading"-->
        <!--@on-ok="run(0)">-->
        <!--<p class="transactioninfo-message">-->
        <!--<Icon type="information-circled"></Icon>-->
        <!--<span>确请确认你的操作，此操作将产生重大影响</span>-->
        <!--</p>-->
        <!--</Modal>-->
        <!--<Modal-->
        <!--v-model="operate_modal"-->
        <!--:loading="loading"-->
        <!--@on-ok="run(1)">-->
        <!--<p class="transactioninfo-message">-->
        <!--<Icon type="information-circled"></Icon>-->
        <!--<span>请确认你的操作，此操作将产生重大影响</span>-->
        <!--</p>-->
        <!--</Modal>-->
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
            //            run (state) {
            //                if (state == 1) {
            //                    // todo 向api请求使商店切换至运营状态
            //                    this.transactiondata.run = 1;
            //                }
            //                else {
            //                    // todo 向api请求使商店切换至停业状态
            //                    this.transactiondata.run = 0;
            //                }
            //            }
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
