<template>
    <Row>
        <card>
            <Col span="24">
            <CheckboxGroup v-model="rolearray">
                <Checkbox v-for="item in role" :label=item falseValue></Checkbox>
            </CheckboxGroup>
            <Input type="text" v-model="role"/>
            <Input type="text" v-model="rolearray"/>
            </Col>
        </card>
    </Row>
</template>


<script>
    export default{
        data () {
            return {
                role: '12',
                rolearray: ['1', '2']
            };
        }
    };
</script>