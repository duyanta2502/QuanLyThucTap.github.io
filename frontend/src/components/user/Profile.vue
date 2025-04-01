<template>
    <div>
        <div class="container mt-5">
            <!-- Navbar -->
        <NavMenu></NavMenu>

            <div class="row">
            <!-- Edit Profile Column -->
            <div class="col-md-6">
                <div class="card p-4">
                <h4>Edit Profile</h4>
                <form @submit.prevent="editProfile">
                    <span v-if ="message" class = "msg-error">{{ message }}</span>
                    <!-- Name Field -->
                    <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        v-model="dataProfile.name"
                        class="form-control" 
                        id="name" 
                        placeholder="Enter your name" 
                        required
                    />
                    </div>
                    <span v-if ="errors.email" class = "msg-error">{{ errors.name[0] }} </span>
                    <!-- Email Field -->
                    <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        v-model="dataProfile.email"
                        class="form-control" 
                        id="email" 
                        placeholder="Enter your email" 
                        required
                    />
                    </div>
                    <span v-if ="errors.email" class = "msg-error">{{ errors.email[0] }} </span>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                </div>
            </div>

            <!-- Change Password Column -->
            <div class="col-md-6">
                <div class="card p-4">
                <h4>Change Password</h4>
                <form @submit.prevent="changePassword">
                    <!-- Current Password Field -->
                    <div class="mb-3">
                    <label for="current-password" class="form-label">Current Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="current-password" 
                        placeholder="Enter your current password" 
                        required
                    />
                    </div>

                    <!-- New Password Field -->
                    <div class="mb-3">
                    <label for="new-password" class="form-label">New Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="new-password" 
                        placeholder="Enter new password" 
                        required
                    />
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="confirm-password" 
                        placeholder="Confirm your new password" 
                        required
                    />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { 
        ref, 
        onMounted ,
        reactive,
    } from 'vue';
    import { useRouter } from 'vue-router';
    import NavMenu from '../admin/NavMenu.vue';
    import api from '../../axios.js';
    import { useAuthStore } from '../../../stores/authStore';
    export  default {
        components: {
            NavMenu
        },
        setup(){
            const errors = reactive({});
            const router = useRouter();
            const message = ref('');
            const dataProfile = reactive({
                name: '',
                email: '',
            });
            const authStore = useAuthStore();

            const editProfile = async() =>{
                await api.post('/api/edit-profile', dataProfile)
                
                .then(response => {
                    
                    //console.log(response);
                    //message.value = response.data.message;
                    authStore.fetchUser();
                    alert('Đổi thông tin thành công!');
                })
                .catch(error => {
                    console.error("api error: ", error);
                        if (error.response && error.response.status == 422) {
                        Object.assign(errors, error.response.data.errors);

                        if(error.response.data.message) {
                            message.value = error.response.data.message;
                        }
                    }
                })
            }

            
            onMounted(() => {
                dataProfile.name = authStore.user.name;
                dataProfile.email = authStore.user.email;
            });

            return {
                dataProfile,
                editProfile,
                errors,
                message,
            }
        }
    }
</script>

