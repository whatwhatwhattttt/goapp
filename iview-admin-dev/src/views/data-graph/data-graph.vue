<template>
    <div>
        <Row>
            <Col span="24">
            <Card>
                <div style="height: 300px">
                    <p slot="title" class="card-title">
                        <Icon type="ios-shuffle-strong"></Icon>
                        上周每日服务调用量(万)
                    </p>
                    <div class="line-chart-con">
                        <service-requests></service-requests>
                    </div>
                </div>
            </Card>
            </Col>
        </Row>
    </div>
</template>