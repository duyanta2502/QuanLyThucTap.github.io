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
                            <form @submit.prevent = "ForgotPassword">
                                <span v-if ="message" class = "msg-error">{{ message }}</span>
                                <div class="mb-3">
                                   <label class="form-label">Email</label>
                                        <input type="email" v-model = "formData.email" class="form-control" name="email" 
                                            placeholder="Nhập email">
                                            <span v-if ="errors.email" class = "msg-error">{{ errors.email[0] }} </span>
                                    </div>         
                                    <button type="submit" class="btn btn-primary w-100">Email link</button>
                                    <br>
                                    <br>
                                        <a href="#">
                                            <router-link to ="/login">
                                                Back to Login
                                            </router-link>
                                        </a>
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
            'email': '',
        });

        const errors = reactive({});
        const router = useRouter();
        const message = ref('');

        const ForgotPassword = async () => {
            try {
                const respon = await axios.post('api/forgot-password', formData);
                console.log(respon);
                alert('Đã gửi email khôi phục mật khẩu đến email của bạn!');

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
            ForgotPassword
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