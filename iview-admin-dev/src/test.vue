<template>
    <div>
        <Row>
            <Col>
            <Card>
                <Row>
                    <Col span="10" offset="7">
                    <Button @click="gettimearray">天数显示</Button>
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
                timearray: []
            };
        },
        methods: {
            gettimearray () {
                let curDate = new Date();
                curDate.setDate(0);
                let curday = curDate.getDate();
                for (let i = 1; i <= curday; i++) {
                    this.timearray.push(i.toString());
                }
            }
        }
    };
</script>