<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // 1. Khai báo tên bảng (Nếu tên bảng không phải là 'roles')
    protected $table = 'roles';

    // 2. Khai báo khóa chính (Laravel mặc định tìm 'id', bạn đổi thành 'role_id')
    protected $primaryKey = 'role_id';

    // 3. Khai báo các cột được phép nhập dữ liệu (Mass Assignment)
    protected $fillable = ['role_name'];

    // 4. Tắt Timestamps (Vì migration của bạn không có $table->timestamps())
    public $timestamps = false;
    /**
 * Một user upload nhiều tài liệu
 */
public function taiLieus()
{
    return $this->hasMany(TaiLieu::class, 'nguoi_upload', 'user_id');
}
}