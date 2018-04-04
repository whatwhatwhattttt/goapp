<style>
    @import "./ownspace.less";
</style>
<template>
    <div>
        <Card>
            <p slot="title">
                <Icon type="person"></Icon>
                个人中心
            </p>
            <Row>
                <Col span="8" offset="4">
                <div style="height: 200px">
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">姓&emsp;&emsp;名: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">年&emsp;&emsp;龄: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">工&emsp;&emsp;号: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">111{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">职&emsp;&emsp;位: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">{{  }}</span>
                        </Col>
                    </Row>
                </div>
                </Col>
                <Col span="8">
                <div style="height: 200px">
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">拥有角色: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">权&emsp;&emsp;限: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">账&emsp;&emsp;号: </span>
                        </Col>
                        <Col>
                        <span class="shopinfo-value">111{{  }}</span>
                        </Col>
                    </Row>
                    <Row class="ownspace-row">
                        <Col span="6">
                        <span class="ownspace-text">密&emsp;&emsp;码: </span>
                        </Col>
                        <Col>
                        <Button type="default">修改密码</Button>
                        </Col>
                    </Row>
                </div>
                </Col>
            </Row>
            <Row>

            </Row>
        </Card>
    </div>
</template>