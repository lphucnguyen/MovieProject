<?php

namespace App\Http\Controllers\User;

use App\Commands\User\UpdateProfileCommand;
use App\DTOs\User\UpdateProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
use Illuminate\Support\Facades\Bus;

class UpdateProfileController extends Controller
{
    public function __invoke(UpdateProfileRequest $request, $uuid)
    {
        $request->validated();

        $updateProfileCommand = new UpdateProfileCommand(
            $uuid,
            UpdateProfileDTO::fromRequest($request)
        );
        Bus::dispatch($updateProfileCommand);

        session()->flash('success', 'Hồ sơ cập nhật thành công');
        return redirect()->back();
    }
}
