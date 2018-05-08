<template>
    <div>
        <Col span="24">
        <Row>
            <Col span="5">
            <DatePicker
                    :disabled="loading"
                    type="daterange"
                    v-model="time"
                    confirm
                    :options="options"
                    placement="bottom-end"
                    placeholder="可选择日期"
                    style="width: 200px">
            </DatePicker>
            </Col>
            <Col span="3">
            <RadioGroup v-model="sort">
                <Radio label="0" :disabled="loading">
                    <Icon type="arrow-up-a"></Icon>
                    <span>升序</span>
                </Radio>
                <Radio label="1" :disabled="loading">
                    <Icon type="arrow-down-a"></Icon>
                    <span>降序</span>
                </Radio>
            </RadioGroup>
            </Col>
            <Col span="13">
            <Input
                    type="text"
                    :style="{width: textwidth+'px'}"
                    placeholder="请输入搜索内容,若未选择搜索列则为全表搜索"
                    v-model="search_t">
            <i-select clearable v-model="search_v" slot="prepend" style="width: 130px">
                <Option v-for="item in searchlist" :value="item[0]">{{item[1]}}</Option>
            </i-select>
            <Button type="primary" :loading="loading" slot="append" icon="ios-search" @click="search_f"></Button>
            </Input>
            </Col>
            <Col span="3">
            <Button type="primary" @click="init" long>初始化</Button>
            </Col>
        </Row>
        </Col>
    </div>
</template>

<script>
    export default{
        name: 'zxksearch',
        props: {
            textwidth: {
                type: [Number, String],
                default: 500
            },
            searchlist: {
                type: Array
            },
            loading: {
                type: Boolean
            }
        },
        data()
        {
            return {
                judge: false,
                search_v: '',
                search_t: '',
                sort: '0',
                time: '',
                options: {
                    shortcuts: [
                        {
                            text: '一星期',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                                return [start, end];
                            }
                        },
                        {
                            text: '一个月',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                                return [start, end];
                            }
                        },
                        {
                            text: '三个月',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                                return [start, end];
                            }
                        },
                        {
                            text: '六个月',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 182);
                                return [start, end];
                            }
                        },
                        {
                            text: '一年',
                            value () {
                                const end = new Date();
                                const start = new Date();
                                start.setTime(start.getTime() - 3600 * 1000 * 24 * 365);
                                return [start, end];
                            }
                        }
                    ]
                }
            }
        },
        methods: {
            search_f () {
                this.search_t = this.search_t.trim();
                if (this.search_t || this.time) {
                    this.judge = true;
                    this.$emit('zxksearch_f', [this.judge, this.search_v, this.search_t, this.time]);
                }
                else {
                    this.$emit('zxksearch_f', [this.judge]);
                }
            },
            init(){
                this.$emit('zxk_init');
            }
        },
        watch: {
            sort: function () {
                this.$emit('zxksearch_s');
            }
        }
    }
</script>