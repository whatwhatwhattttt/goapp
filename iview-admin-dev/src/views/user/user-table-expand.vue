<style lang="less">
    @import './user.less';
</style>
<template>
    <div>
        <Row class="expand-row">
            <Col span="8">
            <span class="expand-key">真实姓名: </span>
            <span class="expand-value">{{ row.realname }}</span>
            </Col>
            <Col span="8">
            <span class="expand-key">邮箱: </span>
            <span class="expand-value">{{ row.mail }}</span>
            </Col>
            <Col span="8">
            <span class="expand-key">qq: </span>
            <span class="expand-value">{{ row.qq }}</span>
            </Col>
        </Row>
        <Row>
            <Col span="8">
            <span class="expand-key">身份证: </span>
            <span class="expand-value">{{ row.id_card }}</span>
            </Col>
            <Col span="8">
            <span class="expand-key">密码: </span>
            <span class="expand-value">{{ row.password }}</span>
            </Col>
            <Col span="8">
            <span class="expand-key">注册时间: </span>
            <span class="expand-value">{{ row.create_time }}</span>
            </Col>
        </Row>
    </div>
</template>
<script>
    export default {
        props: {
            row: Object
        }
    };
</script>