<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sinhvien;

class SinhVienController extends Controller
{

    public function index()
    {
        $sinhviens = Sinhvien::all();
        return response()->json($sinhviens);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'HoTen' => 'required|string|max:100',
            'MaSinhVien' => 'required|string|unique:sinhvien,MaSinhVien|max:20',
            'NgaySinh' => 'required|date',
            'Lop' => 'required|string|max:50',
            'Email' => 'required|email|unique:sinhvien,Email|max:100',
            'SoDienThoai' => 'nullable|string|max:15',
        ]);
        $sinhvien = Sinhvien::create($validated);
        return response()->json(['message' => 'them sinh vien thanh cong','sinh vien' => $sinhvien], 201);
    }

    public function storeMany(Request $request)
    {
        $validated = $request->validate([
            'sinhviens' => 'required|array',
            'sinhviens.*.HoTen' => 'required|string|max:100',
            'sinhviens.*.MaSinhVien' => 'required|string|unique:sinhvien,MaSinhVien|max:20',
            'sinhviens.*.NgaySinh' => 'required|date',
            'sinhviens.*.Lop' => 'required|string|max:50',
            'sinhviens.*.Email' => 'required|email|unique:sinhvien,Email|max:100',
            'sinhviens.*.SoDienThoai' => 'nullable|string|max:15',
        ]);

        $sinhviens = Sinhvien::insert($validated['sinhviens']);

        return response()->json([
            'message' => 'Thêm nhiều sinh viên thành công',
            'sinhviens' => $validated['sinhviens']
        ], 201);
    }

    public function show(string $id)
    {
        $sinhvien = Sinhvien::find($id);

        if (!$sinhvien) {
            return response()->json(['message' => 'Sinh viên không tồn tại'], 404);
        }

        return response()->json($sinhvien);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'HoTen' => 'required|string|max:100',
            'MaSinhVien' => 'required|string|unique:sinhvien,MaSinhVien,' . $id . ',id|max:20',
            'NgaySinh' => 'required|date',
            'Lop' => 'required|string|max:50',
            'Email' => 'required|email|unique:sinhvien,Email,' . $id . ',id|max:100',
            'SoDienThoai' => 'nullable|string|max:15',
        ]);

        $sinhvien = Sinhvien::find($id);

        if (!$sinhvien) {
            return response()->json(['message' => 'Sinh viên không tồn tại'], 404);
        }

        $sinhvien->update($validated);

        return response()->json(["message" => "Cập nhật thành công", "sinhvien" => $sinhvien], 200);
    }

    public function destroy(string $id)
    {
        $sinhvien = Sinhvien::find($id);

        if (!$sinhvien) {
            return response()->json(['message' => 'Sinh viên không tồn tại'], 404);
        }
        $sinhvien->delete();
        return response()->json(['message' => 'Sinh viên đã được xóa']);
    }
}