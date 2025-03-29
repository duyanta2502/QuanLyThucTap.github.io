<template>
        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Đăng Ký</h4>
                            </div>
                            <div class="card-body">
                                <!-- Form đăng kí -->
                                <form @submit.prevent = "handleSubmit">
                                    <div class="mb-3">
                                        <label class="form-label">Họ và Tên</label>
                                        <input type="text" v-model = "formData.name" class="form-control" name="name" 
                                            placeholder="Nhập họ và tên">
                                            <span v-if ="errors.name" class = "msg-error">{{ errors.name[0] }} </span>
                                    </div>

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
                                    <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
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
    import { useRouter } from 'vue-router';
    export default{
        setup(){
            const formData = reactive({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            });

            const errors = reactive({});
            const router = useRouter();
            
            const handleSubmit = async () => {
                try {
                    const respon = await axios.post('api/register', formData);
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
                handleSubmit
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