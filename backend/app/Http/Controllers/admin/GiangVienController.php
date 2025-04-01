<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiangVien;
class GiangVienController extends Controller
{

    public function index()
    {
        $giangviens = GiangVien::all();
        return response()->json($giangviens);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'HoTen' => 'required|string|max:100',
            'MaGiangVien' => 'required|string|unique:giangvien,MaGiangVien|max:20',
            'Email' => 'required|email|unique:giangvien,Email|max:100',
            'SoDienThoai' => 'nullable|string|max:15',
            'BoMon' => 'required|string|max:100',
        ]);

        $giangvien = GiangVien::create($validated);

        return response()->json($giangvien, 201);
    }
    public function storeMany(Request $request)
    {
        $validated = $request->validate([
            'giangviens' => 'required|array',
            'giangviens.*.HoTen' => 'required|string|max:100',
            'giangviens.*.MaGiangVien' => 'required|string|unique:giangvien,MaGiangVien|max:20',
            'giangviens.*.Email' => 'required|email|unique:giangvien,Email|max:100',
            'giangviens.*.SoDienThoai' => 'nullable|string|max:15',
            'giangviens.*.BoMon' => 'required|string|max:100',
        ]);

        $giangviens = GiangVien::insert($validated['giangviens']);

        return response()->json([
            'message' => 'Thêm nhiều giảng viên thành công',
            'giangviens' => $validated['giangviens']
        ], 201);
    }

    public function show(string $id)
    {
        $giangvien = GiangVien::find($id);

        if (!$giangvien) {
            return response()->json(['message' => 'Giảng viên không tồn tại'], 404);
        }

        return response()->json($giangvien);
    }


    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'HoTen' => 'required|string|max:100',
            'MaGiangVien' => 'required|string|unique:giangvien,MaGiangVien,' . $id . ',id|max:20',
            'Email' => 'required|email|unique:giangvien,Email,' . $id . ',id|max:100',
            'SoDienThoai' => 'nullable|string|max:15',
            'BoMon' => 'required|string|max:100',
        ]);

        $giangvien = GiangVien::find($id);

        if (!$giangvien) {
            return response()->json(['message' => 'Giảng viên không tồn tại'], 404);
        }

        $giangvien->update($validated);

        return response()->json($giangvien);
    }


    public function destroy(string $id)
    {
         $giangvien = GiangVien::find($id);

         if (!$giangvien) {
             return response()->json(['message' => 'Giảng viên không tồn tại'], 404);
         }

         $giangvien->delete();

         return response()->json(['message' => 'Giảng viên đã được xóa']);
    }
}
