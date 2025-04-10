<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'sinhvien'; 

    protected $fillable = [
        'HoTen', 'MaSinhVien', 'NgaySinh', 'Lop', 'Email', 'SoDienThoai',
    ];
}