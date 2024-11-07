<?php

namespace App\DTOs\Admin;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateAdminDTO extends BaseDTO
{
    public string|null $name = '';
    public string|null $email = '';
    public string|null $password = '';
    public UploadedFile|string|null $avatar = null;
    public array|null $permissions = [];
}
