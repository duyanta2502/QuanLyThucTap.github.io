<template>
    <div class="container mt-5">
        <h1 class="mt-4">Quản lý Sinh viên</h1>

        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">Thêm Sinh viên</button>

        <!-- Modal Thêm mới / Cập nhật sinh viên -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Thêm mới Sinh viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Họ tên</label>
                                <input type="text" class="form-control" placeholder="Nhập họ và tên" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mã Sinh viên</label>
                                <input type="text" class="form-control" placeholder="Nhập mã sinh viên" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ngày Sinh</label>
                                <input type="date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lớp</label>
                                <input type="text" class="form-control" placeholder="Nhập lớp" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Nhập email" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="Nhập số điện thoại">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Lưu</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bảng danh sách sinh viên -->
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
                <tr>
                    <td>1</td>
                    <td>Nguyễn Văn A</td>
                    <td>SV001</td>
                    <td>01/01/2000</td>
                    <td>A1</td>
                    <td>a.nguyen@example.com</td>
                    <td>0123456789</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">Sửa</button>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Trần Thị B</td>
                    <td>SV002</td>
                    <td>02/02/1999</td>
                    <td>B1</td>
                    <td>b.tran@example.com</td>
                    <td>0987654321</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addStudentModal">Sửa</button>
                        <button class="btn btn-danger btn-sm">Xóa</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import { ref } from 'vue';
    export  default {
        setup(){
            const countStudents = ref(0);
            return {
                countStudents
            }
        }
    }
</script>