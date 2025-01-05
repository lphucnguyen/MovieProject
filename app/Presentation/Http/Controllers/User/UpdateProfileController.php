<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\UpdateProfileCommand;
use App\Application\DTOs\User\UpdateProfileDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\User\UpdateProfileRequest;
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
