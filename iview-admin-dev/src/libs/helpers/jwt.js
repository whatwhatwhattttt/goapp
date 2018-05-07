/**
 * Created by Administrator on 2018/4/19.
 */
export default {
    setToken(token){
        window.localStorage.setItem('jwt_token',token);
    },
    getToken(){
        return window.localStorage.getItem('jwt_token');
    },
    removeToken(){
        window.localStorage.removeItem('jwt_token');
    }
}