<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\ChangePasswordCommand;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Bus;

class ChangePasswordController extends Controller
{
    public function __invoke(ChangePasswordRequest $request, $uuid)
    {
        $request->validate();

        $changePasswordCommand = new ChangePasswordCommand($request->password, $uuid);
        Bus::dispatch($changePasswordCommand);

        session()->flash('success', 'Cập nhật mật khẩu thành công');
        return redirect()->back();
    }
}
