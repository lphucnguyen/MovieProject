<?php

namespace App\Application\DTOs\Admin;

use App\Shared\Application\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateAdminDTO extends BaseDTO
{
    public string|null $name = '';
    public string|null $email = '';
    public string|null $password = '';
    public UploadedFile|string|null $avatar = null;
    public array|null $permissions = [];
}
