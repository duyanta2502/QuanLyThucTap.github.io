<?php

namespace App\Http\Controllers\admin;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sinhvien;

class SinhVienController extends Controller
{

    public function import_sinhvien(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        unset($sheetData[1]); // Bỏ dòng tiêu đề

        $insertData = [];

        foreach ($sheetData as $row) {
            $insertData[] = [
                'HoTen' => $row['A'] ?? '',
                'MaSinhVien' => $row['B'] ?? '',
                'NgaySinh' => isset($row['C']) ? date('Y-m-d', strtotime($row['C'])) : null,
                'Lop' => $row['D'] ?? '',
                'Email' => $row['E'] ?? '',
                'SoDienThoai' => $row['F'] ?? '',
                'TrangThai' => 0, // mặc định chưa thực tập
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        try {
            Sinhvien::insert($insertData);
            return response()->json(['message' => 'Import thành công!', 'count' => count($insertData)], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Import thất bại', 'error' => $e->getMessage()], 500);
        }
    }

    public function export_sinhvien()
    {
        $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'HoTen');
    $sheet->setCellValue('B1', 'MaSinhVien');
    $sheet->setCellValue('C1', 'NgaySinh');
    $sheet->setCellValue('D1', 'Lop');
    $sheet->setCellValue('E1', 'Email');
    $sheet->setCellValue('F1', 'SoDienThoai');

    $sinhviens = Sinhvien::all();
    $row = 2;
    foreach ($sinhviens as $sv) {
        $sheet->setCellValue("A$row", $sv->HoTen);
        $sheet->setCellValue("B$row", $sv->MaSinhVien);
        $sheet->setCellValue("C$row", $sv->NgaySinh);
        $sheet->setCellValue("D$row", $sv->Lop);
        $sheet->setCellValue("E$row", $sv->Email);
        $sheet->setCellValue("F$row", $sv->SoDienThoai);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'danh_sach_sinhvien.xlsx';
    $tempFile = tempnam(sys_get_temp_dir(), $filename);
    $writer->save($tempFile);

    return response()->download($tempFile, $filename);
    }

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
            'TrangThai' => 'required|boolean',
        ]);

        $sinhvien = Sinhvien::find($id);

        if (!$sinhvien) {
            return response()->json(['message' => 'Sinh viên không tồn tại'], 404);
        }

        $sinhvien->update([
            'HoTen' => $validated['HoTen'],
            'MaSinhVien' => $validated['MaSinhVien'],
            'NgaySinh' => $validated['NgaySinh'],
            'Lop' => $validated['Lop'],
            'Email' => $validated['Email'],
            'SoDienThoai' => $validated['SoDienThoai'],
            'TrangThai' => $validated['TrangThai'],
        ]);

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
