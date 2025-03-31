<template>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4> Cập nhật mật  khẩu </h4>
                            </div>
                            <div class="card-body">
                                <!-- Form đăng kí -->
                                <form @submit.prevent = "resetPassword">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" v-model = "formData.email" class="form-control" name="email" 
                                            placeholder="Nhập email">
                                            <span v-if ="errors.email" class = "msg-error">{{ errors.email[0] }} </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Mật khẩu</label>
                                        <input type="password" v-model = "formData.password" class="form-control" name="password"
                                            placeholder="Nhập mật khẩu">
                                            <span v-if ="errors.password" class = "msg-error">{{ errors.password[0] }} </span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Xác nhận mật khẩu</label>
                                        <input type="password" v-model = "formData.password_confirmation" class="form-control" name="password_confirmation"
                                            placeholder="Nhập lại mật khẩu">
                                            <span v-if ="errors.password_confirmation" class = "msg-error">{{ errors.password_confirmation  [0] }} </span>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Cập nhật mật  khẩu</button>
                                    <p class="text-center mt-3">Đã có tài khoản? 
                                        <a href="#">
                                            <router-link to ="/login">
                                                Đăng Nhập
                                            </router-link>
                                        </a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </body>
</template>

<script>
    import { reactive } from 'vue';
    import axios from 'axios';
    import { useRouter, useRoute } from 'vue-router';
    export default{
        setup(){
            const route = useRoute(); 
            const formData = reactive({
                'email': '',
                'password': '',
                'password_confirmation': '',
                'token': route.params.token,
            });
            
            const errors = reactive({});
            const router = useRouter();

            const resetPassword = async () => {
                console.log(formData)
                try {
                    const respon = await axios.post('/api/reset-password', formData);
                    alert('Đổi mật khẩu thành công!');
                    router.push('/login');
                } catch (error) {
                    if (error.response && error.response.status == 422) {
                        Object.assign(errors, error.response.data.errors);
                    }
                }
            }
            return {    
                formData,
                errors,
                resetPassword
            }
        }
    }
</script>

<style scoped>
    @import '../../assets/css/auth.css';
    .msg-error{
        color: red;
    }
</style>