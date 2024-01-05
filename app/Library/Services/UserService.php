<?php

namespace App\Library\Services;

use Exception;
use App\Models\User;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserService extends BaseService
{

    private function actionHtml($row)
    {
        $actionHtml = '';

        if ($row->id) {
            $actionHtml = '
            <a class="dropdown-item" href="' . route('admin.ams.category.edit', $row->id) . '" ><i class="far fa-edit"></i> Edit</a>
            <a class="dropdown-item text-danger" href="' . route('admin.ams.category.delete', $row->id) . '" ><i class="fas fa-trash-alt"></i> Delete</a>';
        } else {
            $actionHtml = '';
        }

        return '<div class="action dropdown">
                    <button class="btn btn2-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="fas fa-tools"></i> Action
                    </button>
                    <div class="dropdown-menu">
                        ' . $actionHtml . '
                    </div>
                </div>';
    }
    public function dataTable()
    {
        $query = User::select('*');
        $data = $query->get();

        return Datatables::of($data)
                ->addIndexColumn()
                ->make(true);
    }


    public function updatePassword(User $user, array $data)
    {
        $this->checkRolePermission($user, 'user_update_password');

        try {
            $user->update([
                'password' => bcrypt($data['password']),
            ]);

            return $this->handleSuccess('Successfully updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function updateStatus(User $user, int $data)
    {
        $this->checkRolePermission($user, 'user_update_status');

        try {
            $user->update(['status' => $data]);

            return $this->handleSuccess('Successfully updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function deleteUser(User $user)
    {
        DB::beginTransaction();

        try {

            if ($user->isEmployee()) {
                $user->employee()->trainings()->delete();
                $user->employee()->attachments()->delete();
                $user->employee()->delete();
            } elseif ($user->isMember()) {
                $user->member()->attachments()->delete();
                $user->member()->delete();
            }

            deleteFile([$user->getAvatar(), $user->getPhotoId(), $user->emergency->getImage()]);

            $user->emergency()->delete();
            $user->houseHold()->delete();
            $user->health()->delete();
            $user->address()->delete();
            $user->attachments()->delete();
            //$user->assigns()->delete();
            $user->delete();
            DB::commit();

            return $this->handleSuccess('Successfully Deleted');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);
        abort_unless($user, 404, 'Not found');

        $this->checkRolePermission($user, 'user_restore');

        DB::beginTransaction();

        try {
            $user->restore();

            if ($user->isMember()) {
                $user->member()->restore();
            } elseif ($user->isEmployee()) {
                $user->employee()->restore();
            }

            DB::commit();

            return $this->handleSuccess('Successfully Restored');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function checkRolePermission(User $user, string $permission_suffix)
    {
        $auth_role = User::getAuthUser()->role();

        if ($user->isEmployee() || $user->isAdmin()) {
            abort_unless($auth_role->hasPermission($permission_suffix), 401, 'Permission denied');
            $redirect = route('admin.employee.index');
        } elseif ($user->isMember()) {
            abort_unless($auth_role->hasPermission($permission_suffix), 401, 'Permission denied');
            $redirect = route('admin.member.index');
        }

        //This redirect variable will be used only for delete operation
        return $redirect;
    }

    //==================----- For User Profile -----=====================//
    public function updateProfile($data)
    {
        DB::beginTransaction();

        try {
            $user = User::getAuthUser();
            $operator_id = auth()->id();

            // User
            $user_data = $data['user'];
            $user_data['phone'] = $data['mobile'];
            $user_data['operator_id'] = $operator_id;

            if (isset($user_data['avatar'])) {
                deleteFile($user->getAvatar());
                $user_data['avatar'] = Helper::uploadImage($user_data['avatar'], Enum::USER_AVATAR_DIR, 200, 200);
            }

            if (isset($user_data['photo_id'])) {
                deleteFile($user->getPhotoId());
                $user_data['photo_id'] = Helper::uploadImage($user_data['photo_id'], Enum::USER_PHOTO_ID_DIR, 200, 200);
            }
            $data['operator_id'] = $operator_id;

            $user->update($user_data);
            unset($data['user']);

            // Address
            $address_data = $data['address'];
            $address_data['user_id'] = $user->id;
            $address_data['operator_id'] = $operator_id;

            $user->address->update($address_data);
            unset($data['address']);

            DB::commit();

            return $this->handleSuccess('Successfully Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }

    public function updateProfilePassword($data)
    {
        DB::beginTransaction();

        try {
            $user = User::getAuthUser();
            $user->update([
                'password' => bcrypt($data['password']),
            ]);

            return $this->handleSuccess('Successfully Password Updated');
        } catch (Exception $e) {
            Helper::log($e);

            return $this->handleException($e);
        }
    }
}
