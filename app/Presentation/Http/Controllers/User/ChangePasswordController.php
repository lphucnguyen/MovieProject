<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\ChangePasswordCommand;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Bus;

class ChangePasswordController extends Controller
{
    public function __invoke(string $uuid, ChangePasswordRequest $request)
    {
        $request->validated();

        $changePasswordCommand = new ChangePasswordCommand($uuid, $request->password);
        Bus::dispatch($changePasswordCommand);

        return redirect()->back()->withSuccess('Cập nhật mật khẩu thành công');
    }
}
