<template>
    <div>
        <div class="container mt-5">
            <h3 class="mt-4">Danh sách Sinh viên Thực Tập</h3>
            
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Mã SV</th>
                        <th>Ngày Sinh</th>
                        <th>Lớp</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sinhvien in sinhviens" :key="sinhvien.id">
                        <td>{{ sinhvien.id }}</td>
                        <td>{{ sinhvien.HoTen }}</td>
                        <td>{{ sinhvien.MaSinhVien }}</td>
                        <td>{{ sinhvien.NgaySinh }}</td>
                        <td>{{ sinhvien.Lop }}</td>
                        <td>{{ sinhvien.Email }}</td>
                        <td>{{ sinhvien.SoDienThoai }}</td>
                        <td>
                            <div>
                                <!-- Kiểm tra nếu TrangThai == 1 và thực hiện thay đổi khi bấm nút -->
                                <button v-if="sinhvien.TrangThai === 1" @click="changeTrangThai(sinhvien, 0)" class="btn btn-success mt-2">
                                    Đã thực tập xong
                                </button>
                                
                                <!-- Nếu TrangThai != 1 (TrangThai == 0 hoặc giá trị khác) -->
                                <button v-else @click="changeTrangThai(sinhvien, 1)" class="btn btn-warning mb-2">
                                    Chưa thực tập
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p v-if="message" class="alert alert-danger">{{ message }}</p>
        </div>
    </div>
</template>

<script>
    import { 
        ref, 
        onMounted,
        reactive 
    } from 'vue';
    import api from '../../axios.js';

    export default {
        setup() {
            const sinhviens = ref([]); 
            const message = ref(''); 
            const changeTrangThai = async (sinhvien, newTrangThai) => {
                try {
                    await api.put(`/api/sinhvien/${sinhvien.id}`, {
                        TrangThai: newTrangThai,
                        HoTen: sinhvien.HoTen,
                        MaSinhVien: sinhvien.MaSinhVien,
                        NgaySinh: sinhvien.NgaySinh,
                        Lop: sinhvien.Lop,
                        Email: sinhvien.Email,
                        SoDienThoai: sinhvien.SoDienThoai
                    });

                    sinhvien.TrangThai = newTrangThai;

                    alert('Trạng thái sinh viên đã được cập nhật!');
                } catch (error) {
                    console.error("Error updating TrangThai: ", error);
                    message.value = 'Không thể cập nhật trạng thái sinh viên.';
                }
            };


            const fetchSinhViens = async () => {
                try {
                    const response = await api.get('/api/sinhvien');
                    sinhviens.value = response.data; // Gán dữ liệu nhận được từ API vào biến sinhviens
                } catch (error) {
                    console.error("Error fetching sinhviens: ", error);
                    message.value = 'Không thể tải danh sách sinh viên.'; // Hiển thị thông báo lỗi
                }
            };

            // xóa sinh viên
            const deleteStudent = async (id) => {
                try {
                    await api.delete(`/api/sinhvien/${id}`);
                    fetchSinhViens();
                    alert('Sinh viên đã bị xóa.');
                } catch (error) {
                    console.error("Error deleting sinhvien: ", error);
                    message.value = 'Không thể xóa sinh viên.';
                }
            };

            //  sửa thông tin sinh viên
            const editUser = async (sinhvien) => {
                alert(`Sửa thông tin sinh viên ${sinhvien.HoTen}`);
            };

            onMounted(() => {
                fetchSinhViens();
            });

            return {
                sinhviens,
                message,
                deleteStudent,
                editUser,
                changeTrangThai,
            };
        }
    };
</script>
