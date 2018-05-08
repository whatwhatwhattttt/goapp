// /**
//  * Created by Administrator on 2018/4/28.
//  */
// import jwtToken from './../../libs/helpers/jwt'
// import  axios from 'axios'
// export  default {
//     actions:{
//         loginRequest({dispatch},formData){
//             axios.post('www.goapp.com/api/login',formData).then(response=>{
//                 jwtToken.setToken(response.data.token);
//                 dispatch('setAuthUser')
//             }).catch(error=>{
//                 console.log(error.response.data)
//             })
//         }
//     }
// }