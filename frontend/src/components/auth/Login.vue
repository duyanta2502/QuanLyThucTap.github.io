<template>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Đăng Nhập</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form đăng nhập -->
                            <form @submit.prevent = "handleSubmit">
                                <span v-if ="message" class = "msg-error">{{ message }}</span>
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
                                            <br>
                                        <a href="#">
                                            <router-link to ="/fogot-password">
                                                Quên mật khẩu
                                            </router-link>
                                        </a>
                                    </div>         
                                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                                    <p class="text-center mt-3">Chưa có tài khoản? 
                                        <a href="#">
                                            <router-link to ="/register">
                                                Đăng Ký
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
import { reactive, ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default{
    setup(){
        const formData = reactive({
            email: '',
            password: '',
        });

        const errors = reactive({});
        const router = useRouter();
        const message = ref('');

        const handleSubmit = async () => {
            try {
                const respon = await axios.post('api/login', formData);
                console.log(respon);
                //luu token vao localStorage
                localStorage.setItem('token', respon.data.token);

                router.push('/admin/dashboard');
            } catch (error) {
                console.log(error);
                if (error.response && error.response.status == 422) {
                    Object.assign(errors, error.response.data.errors);

                    if(error.response.data.message) {
                        message.value = error.response.data.message;
                    }
                }
            }
        }
        return {
            formData,
            errors,
            message,
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