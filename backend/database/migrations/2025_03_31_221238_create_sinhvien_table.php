// database/migrations/xxxx_xx_xx_xxxxxx_create_sinhvien_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhvienTable extends Migration
{
public function up()
{
    Schema::create('sinhvien', function (Blueprint $table) {
        $table->id('id'); // Khóa chính
        $table->string('HoTen', 100);
        $table->string('MaSinhVien', 20)->unique();
        $table->date('NgaySinh');
        $table->string('Lop', 50);
        $table->string('Email', 100)->unique();
        $table->string('SoDienThoai', 15)->nullable();
        $table->timestamps();
    });
}

public function down()
{
        Schema::dropIfExists('sinhvien');
    }
}
