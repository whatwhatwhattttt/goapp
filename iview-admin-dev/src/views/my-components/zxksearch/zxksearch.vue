<template>
    <div>
        <Input
                type="text"
                :style="{width: textwidth+'px'}"
                placeholder="请输入搜索内容"
                v-model="search_t">
        <i-select clearable v-model="search_v" slot="prepend" style="width: 130px">
            <Option v-for="item in searchlist" :value="item[0]">{{item[1]}}</Option>
        </i-select>
        <Button type="primary" :loading="loading" slot="append" icon="ios-search" @click="search_f"></Button>
        </Input>
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
                search_v: null,
                search_t: ''
            }
        },
        methods: {
            search_f () {
                this.search_t=this.search_t.trim();
                if (this.search_t) {
                    this.judge=true;
                    this.$emit('zxksearch_f', [this.judge, this.search_v, this.search_t]);
                }
                else {
                    this.$Message.error('输入要搜索的内容');
                    this.search_t = '';
                }
            }
        }
    }
</script>