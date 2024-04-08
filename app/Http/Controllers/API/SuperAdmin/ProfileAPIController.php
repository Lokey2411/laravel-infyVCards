<?php

namespace App\Http\Controllers\API\SuperAdmin;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProfileAPIController extends AppBaseController
{
    public UserRepository $userRepository;

    /**
     * UserController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function editProfile()
    {
        $user = Auth::user();
        $language = Language::where('iso_code', getCurrentLanguageName())->value('name');

        $data[] =[
            'profile_image' => $user->profile_image,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'region_code' => $user->region_code,
            'contact' => $user->contact,
            'language' => $language,
        ];

        return $this->sendResponse($data, 'Profile Data Retrieve Successfully.');
    }

    public function updateProfile(Request $request)
    {
        $this->userRepository->updateProfileAPI($request->all());

        return $this->sendSuccess('Profile updated Successfully.');
    }

    public function updateLanguage(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();

        if ($user !== null) {
            $user->update($input);
        }

        return $this->sendSuccess('Language update successfully.');
    }

}
