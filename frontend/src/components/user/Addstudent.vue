<template>
        <div>
            <br>
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Quản lý Sinh viên</h4>
            <button class="btn btn-success" @click="showModal = true">
            + Thêm sinh viên
            </button>
            </div>
        </div>
    <!-- Modal -->
    <div v-if="showModal" class="modal fade show d-block" style="background-color: rgba(0, 0, 0, 0.5)">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Thêm mới Sinh viên</h5>
            <button type="button" class="btn-close" @click="closeModal"></button>
        </div>
        <div class="modal-body">
            <form @submit.prevent="submitForm">
            <div class="mb-3">
                <label class="form-label">Họ tên</label>
                <input v-model="sinhvien.HoTen" type="text" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Mã Sinh viên</label>
                <input v-model="sinhvien.MaSinhVien" type="text" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày Sinh</label>
                <input v-model="sinhvien.NgaySinh" type="date" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Lớp</label>
                <input v-model="sinhvien.Lop" type="text" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input v-model="sinhvien.Email" type="email" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input v-model="sinhvien.SoDienThoai" type="text" class="form-control" />
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
            <!-- Nút Import từ Excel bên trái -->
            <!-- File input ẩn -->
            <input
            type="file"
            ref="fileInput"
            @change="handleFileChange"
            accept=".xlsx,.xls"
            style="display: none"
            />

            <!-- Nút hiển thị -->
            <button type="button" class="btn btn-outline-primary" @click="triggerFileInput">
            Import từ Excel
            </button>


            <!-- Nút Lưu và Đóng bên phải -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Lưu</button>
                <button type="button" class="btn btn-secondary" @click="closeModal">Đóng</button>
            </div>
            </div>

            </form>
        </div>
        </div>
    </div>
    </div>
</template>


<script setup>

import { ref } from 'vue'
import api from '../../axios.js'
const showModal = ref(false)
const fileInput = ref(null)

const triggerFileInput = () => {
  fileInput.value.click()
}

const sinhvien = ref({
  HoTen: '',
  MaSinhVien: '',
  NgaySinh: '',
  Lop: '',
  Email: '',
  SoDienThoai: '',
})

const closeModal = () => {
  showModal.value = false
  resetForm()
}

const resetForm = () => {
  sinhvien.value = {
    HoTen: '',
    MaSinhVien: '',
    NgaySinh: '',
    Lop: '',
    Email: '',
    SoDienThoai: '',
  }
}

const submitForm = async () => {
  try {
    await api.post('/api/sinhvien', sinhvien.value)
    alert('Thêm sinh viên thành công!')
    closeModal()
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors
      const messages = Object.values(errors).flat().join('\n')
      alert(`Lỗi validate:\n${messages}`)
    } else {
      alert('Đã xảy ra lỗi khi thêm sinh viên.')
    }
    console.error(error)
  }
}
const handleFileChange = async (event) => {
  const file = event.target.files[0]
  if (!file) return

  const formData = new FormData()
  formData.append('file', file)

  try {
    await api.post('/api/import-sinhvien', formData)
    alert('Import thành công!')
    fetchSinhViens() // nếu có hàm này để reload danh sách
  } catch (error) {
    console.error(error)
    alert('Import thất bại!')
  }
}
</script>