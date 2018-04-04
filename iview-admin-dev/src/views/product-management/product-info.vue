<template>
    <div>
        <Row>
            <Col span="24">
            <Card>
                <Row>
                    <Col span="8" offset="9">
                    <p class="product-title-color">产品详情</p>
                    </Col>
                </Row>
            </Card>
            </Col>
        </Row>
        <Row>
            <Card>
                <Row class="expand-row">
                    <Col span="2" offset="7">
                    <span class="productinfo-key">产品名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">店铺名称: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.shop_name }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">产品编号: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.id }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">店铺编号: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.shop_id }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">类别: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.type }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">库存: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.stock }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">价格： </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.price }}<Icon type="social-yen"></Icon></span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">购买人数： </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.purchase_number }}<Icon
                            type="social-yen"></Icon></span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">审核人员: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.auditor }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">审核时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.approval_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">上架时间: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.opening_time }}</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">上架状态: </span>
                    </Col>
                    <Col span="14">
                    <span v-if="this.productdata.run" class="productinfo-value">售卖中</span>
                    <span v-else class="productinfo-value">下架中</span>
                    </Col>
                </Row>
                <Row>
                    <Col span="2" offset="7">
                    <span class="productinfo-key">产品介绍: </span>
                    </Col>
                    <Col span="14">
                    <span class="productinfo-value">{{ this.productdata.description }}</span>
                    </Col>
                </Row>

            </Card>
        </Row>
        <Row>
            <Card>
                <Row>
                    <Col span="7" offset="8">
                    <Button v-if="this.productdata.run" type="error" long @click="product_modal=true">强制下架</Button>
                    <Button v-else type="primary" long @click="operate_modal=true">强制上架</Button>
                    </Col>
                </Row>
            </Card>
        </Row>
        <Modal
                v-model="product_modal"
                :loading="loading"
                @on-ok="run(0)">
            <p class="productinfo-message">
                <Icon type="information-circled"></Icon>
                <span>确请确认你的操作，此操作将产生重大影响</span>
            </p>
        </Modal>
        <Modal
                v-model="operate_modal"
                :loading="loading"
                @on-ok="run(1)">
            <p class="productinfo-message">
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
                product_modal: false,
                operate_modal: false,
                name: 'product-info',
                productdata: {}
            };
        },
        methods: {
            init () {
                this.productdata = this.$route.query;
            },
            run (state) {
                if (state == 1) {
                    // todo 向api请求使产品切换至上架状态
                    this.productdata.run = 1;
                }
                else {
                    // todo 向api请求使产品切换至下架状态
                    this.productdata.run = 0;
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
