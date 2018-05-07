/**
 * Created by 朱锡楷 on 2018/4/17.
 */
import zxksearch from './zxksearch.vue';
function plugin (Vue) {
    if (plugin.installed) {
        return;
    }
    Vue.component('zxksearch', zxksearch);
}
export default plugin;
