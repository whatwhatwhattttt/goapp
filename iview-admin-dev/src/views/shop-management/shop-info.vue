<template>
    <div>
        <Row>
            <Col span="24">
            <Card>
                <Row>
                    <Col span="8" offset="9">
                    <p class="shop-title-color">商铺详情</p>
                    </Col>
                </Row>
            </Card>
            </Col>
        </Row>
        <Row>
            <Card>
                <Row class="expand-row">
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">店铺名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">店主名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.user_name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">店铺编号: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.id }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">总星数: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.star }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">评价人数: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.evaluation_number }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">店铺星级: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.level }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">营业额: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.turnover }}<Icon type="social-yen"></Icon></span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">审核人员: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.auditor }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">审核时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.approval_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">开业时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.opening_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">运营状态: </span>
                    </Col>
                    <Col span="14">
                    <span v-if="this.shopdata.run" class="shopinfo-value">运营中</span>
                    <span v-else class="shopinfo-value">停业</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="shopinfo-key">店铺介绍: </span>
                    </Col>
                    <Col span="14">
                    <span class="shopinfo-value">{{ this.shopdata.description }}</span>
                    </Col>
                </Row>

            </Card>
        </Row>
        <Row>
            <Card>
                <Row>
                    <Col span="7" offset="8">
                    <Button v-if="this.shopdata.run" type="error" long @click="stop_modal=true">强制停业</Button>
                    <Button v-else type="primary" long @click="operate_modal=true">强制运营</Button>
                    </Col>
                </Row>
            </Card>
        </Row>
        <Modal
                v-model="stop_modal"
                :loading="loading"
                @on-ok="run(0)">
            <p class="shopinfo-message">
                <Icon type="information-circled"></Icon>
                <span>确请确认你的操作，此操作将产生重大影响</span>
            </p>
        </Modal>
        <Modal
                v-model="operate_modal"
                :loading="loading"
                @on-ok="run(1)">
            <p class="shopinfo-message">
                <Icon type="information-circled"></Icon>
                <span>请确认你的操作，此操作将产生重大影响</span>
            </p>
        </Modal>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                stop_modal: false,
                operate_modal: false,
                name: 'shop-info',
                shopdata: {}
            };
        },
        methods: {
            init () {
                this.shopdata = this.$route.query;
            },
            run (state) {
                if (state == 1) {
                    // todo 向api请求使商店切换至运营状态
                    this.shopdata.run = 1;
                }
                else {
                    // todo 向api请求使商店切换至停业状态
                    this.shopdata.run = 0;
                }
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
