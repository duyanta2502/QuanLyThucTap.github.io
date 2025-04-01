// database/migrations/xxxx_xx_xx_xxxxxx_create_giangvien_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiangvienTable extends Migration
{
public function up()
{
Schema::create('giangvien', function (Blueprint $table) {
$table->id('id'); // Khóa chính
$table->string('HoTen', 100);
$table->string('MaGiangVien', 20)->unique();
$table->string('Email', 100)->unique();
$table->string('SoDienThoai', 15)->nullable();
$table->string('BoMon', 100); // Bộ môn
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('giangvien');
}
}