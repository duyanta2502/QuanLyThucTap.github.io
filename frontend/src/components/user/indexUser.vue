<template>
    <div>
        <Addstudent></Addstudent>
         <!-- Menu -->
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
                                <!-- Căn chỉnh 3 nút đều nhau -->
                                <div class="d-flex gap-2 flex-wrap">
                                    <!-- Nút trạng thái -->
                                    <button
                                        :class="sinhvien.TrangThai === 1 ? 'btn btn-success' : 'btn btn-warning'"
                                        @click="changeTrangThai(sinhvien, sinhvien.TrangThai === 1 ? 0 : 1)"
                                        style="min-width: 150px; height: 40px"
                                    >
                                        {{ sinhvien.TrangThai === 1 ? 'Đã thực tập xong' : 'Chưa thực tập' }}
                                    </button>

                                    <!-- Nút sửa -->
                                    <button
                                        class="btn btn-info text-white"
                                        @click="editUser(sinhvien)"
                                        style="min-width: 80px; height: 40px"
                                    >
                                        Sửa
                                    </button>

                                    <!-- Nút xóa -->
                                    <button
                                        class="btn btn-danger"
                                        @click="deleteStudent(sinhvien.id)"
                                        style="min-width: 80px; height: 40px"
                                    >
                                        Xóa
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p v-if="message" class="alert alert-danger">{{ message }}</p>

            <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-outline-success" @click="exportExcel">
                📤 Xuất file Excel
            </button>
            </div>


            <p v-if="message" class="alert alert-danger">{{ message }}</p>
            </div>
</template>

<script>

    import Addstudent from './Addstudent.vue';
    import { 
        ref, 
        onMounted,
    } from 'vue';
    import api from '../../axios.js';
    
    export default {
        components: {
            Addstudent,
        },
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

            const exportExcel = () => {
                window.open('http://localhost:8000/api/export-sinhvien', '_blank')
            }
            
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
                if (!confirm('Bạn có chắc muốn xóa sinh viên này?')) return;

                try {
                    await api.delete(`/api/sinhvien/${id}`)
                    alert('Xóa sinh viên thành công!')

                    // Gọi lại danh sách sau khi xóa
                    fetchSinhViens()
                } catch (error) {
                    console.error(error)
                    message.value = 'Không thể xóa sinh viên.'
                }
                }

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
                exportExcel
            };
        }
    };
</script>
