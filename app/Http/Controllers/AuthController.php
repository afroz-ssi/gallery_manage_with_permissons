<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Permission;
use App\Models\{Gallery, User, Role};
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;
use Illuminate\Support\Facades\File;


class AuthController extends Controller
{

    function loginViewPage()
    {
        return view('login_view_page');
    }


    function multiUserLogin(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $udata = '';
            $credentials = $req->only('email', 'password');
            if (Auth::guard('admin')->attempt($credentials)) {
                $udata = auth('admin')->user();
                $user = 'admin';
            }
            // customer / user login
            else if (Auth::guard('web')->attempt($credentials)) {
                $udata = auth::user();
                $user = 'customer';
            }

            if ($udata == null) {
                return response()->json(['success' => false, 'error' => 'Your account does not exist!.'], 404);
            }
            if ($user == 'customer' && $udata->login_status != 1) {
                return response()->json(['success' => false, 'error' => 'Your account is not active, Please contact to Admin!.'], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Successfull Login. ',
                'data' => ['user' => $user]
            ], 200);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    function adminDashboard()
    {
        $roleCount = Role::count();
        $userCount = User::count();
        $galleryCount = Gallery::count();


        return view('admin.admin_dash', compact('roleCount', 'userCount', 'galleryCount'));
    }


    function CreateRolePage()
    {
        $permissions = Permission::get();
        return view('admin.create_role', compact('permissions'));
    }

    function CreateRole(Request $req)
    {
        try {
            $data = ['role_name' => $req->role_name, 'permissions' => $req->permissions];
            $inserted = Role::create($data);
            if ($inserted) {
                return redirect()->route('create_role_pg')->with('success', 'Role is created successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('create_role_pg')->with('error', $e->getMessage());
        }
    }


    function RoleDetails()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.role_list', compact('roles'));
    }

    function EditRole(Request $req)
    {
        $role = Role::find($req->id);
        $permissions = Permission::get();
        if ($role) {
            return view('admin.edit_role', compact('role', 'permissions'));
        } else {
            return redirect()->route('role_details')->with('error', 'Role not found!.');
        }
    }
    function UpdateRole(Request $req)
    {
        try {
            $data = ['role_name' => $req->role_name, 'permissions' => $req->permissions];
            // dd($data);
            $updated = Role::where('id', $req->id)->update($data);
            if ($updated) {
                return redirect()->route('role_details')->with('success', 'Role details updated successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('edit_role', ['id' => $req->id])->with('error', $e->getMessage());
        }
    }

    function DeleteRole(Request $req)
    {
        $role = Role::find($req->id);
        if ($role) {
            $name = strtoupper($role->role_name);
            $role->delete();
            return redirect()->route('role_details')->with('error', $name . ' role delete successfully!.');
        }
    }

    function CreateUserPage()
    {
        $roles = Role::get();
        return view('admin.create_user', compact('roles'));
    }

    function SaveUser(Request $req)
    {
        try {
            // Do validation 
            $data = [
                "name" => $req->user_name,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "view_password" => $req->password,
                "login_status" => $req->login_status,
                "role_id" => $req->role,
            ];
            // dd($data);
            $inserted = User::create($data);
            if ($inserted) {
                return redirect()->route('create_user_pg')->with('success', 'User created & Role is assigned successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('create_user_pg')->with('error', $e->getMessage());
        }
    }

    function UserLists()
    {
        $users = User::with('role')->orderBy('id', 'desc')->get();
        return view('admin.users_list', compact('users'));
    }

    function DeleteUser(Request $req)
    {
        $user = User::find($req->id);
        if ($user) {
            $name = strtoupper($user->name);
            $user->delete();
            return redirect()->route('userists')->with('error', 'User ' . $name . ' deleted successfully!.');
        }
    }

    function EditUser(Request $req)
    {
        $roles = Role::get();
        $user = User::with('role')->where('id', $req->id)->first();
        if ($user) {
            return view('admin.edit_user', compact('user', 'roles'));
        } else {
            return redirect()->route('userists')->with('error', 'User not found!.');
        }
    }

    function UpdateUser(Request $req)
    {
        try {
            $data = [
                "name" => $req->user_name,
                "email" => $req->email,
                "password" => Hash::make($req->password),
                "view_password" => $req->password,
                "login_status" => $req->login_status,
                "role_id" => $req->role,
            ];
            // dd($req->all());
            $updated = User::where('id', $req->id)->update($data);
            if ($updated) {
                return redirect()->route('userists')->with('success', $req->user_name . ' details updated successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('edit_user', ['id' => $req->id])->with('error', $e->getMessage());
        }
    }




    public function AdminActDeactCustomer(Request $req)
    {
        try {
            $id = $req->userId;
            $newStatus = $req->accnt_status;
            $user = User::find($id);
            if (!$user) {
                throw new \Exception('User id not found.');
            }
            $user->login_status = $newStatus;
            $user->save();
            return response()->json(['success' => true, 'message' => $user->name . ' account status updated successfully', 'data' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    function AdminGalleryLists()
    {
        $galleries  = Gallery::get();
        return view('user.gallery_list', compact('galleries'));
    }

    function AdminLogout(Request $req)
    {
        auth()->guard('admin')->logout();
        $req->session()->invalidate();
        return redirect('/');
    }


    // =========================== Customer sectoions Starts ==================================
    function userDashboard()
    {
        return view('user.user_dashboard');
    }

    function CreateGalleryPage()
    {
        return view('user.create_gallery');
    }


    function createPermission()
    {
        $status = false;
        $user = User::with('role')->where('id', auth::user()->id)->first();
        if ($user) {
            if ($user->role != null) {
                foreach ($user->role->permissions as $key => $p) {
                    if ($p == 'create-gallery') {
                        $status = true;
                    }
                }
            }
            return $status;
        }
        return $status;
    }


    function editPermission()
    {
        $status = false;
        $user = User::with('role')->where('id', auth::user()->id)->first();
        if ($user) {
            foreach ($user->role->permissions as $key => $p) {
                if ($p == 'edit-gallery') {
                    // || $p == 'edit-gallery' || $p == 'list-gallery' || $p == 'delete-gallery') {
                    $status = true;
                }
            }
        }
        return $status;
    }





    function deletePermission()
    {
        $status = false;
        $user = User::with('role')->where('id', auth::user()->id)->first();
        if ($user) {
            foreach ($user->role->permissions as $key => $p) {
                if ($p == 'delete-gallery') {
                    $status = true;
                }
            }
        }
        return $status;
    }

    function StoreGallery(Request $req)
    {

        $phtotoPath = '';
        try {
            if ($this->createPermission() != true) {
                return redirect()->route('create_gallery')->with('error', 'You do not have permission to create gallery!.');
            }
            if ($req->hasFile('images')) {
                $photos = $req->file('images');
                $phtotoPath = $this->UploadMultiImage($photos, "gallery");
                $data = [
                    'gallery_name' => $req->gallery_name,
                    'gallery_type' => $req->gallery_type,
                    'gallery_img' => $phtotoPath,
                    'user_id' => auth()->user()->id,

                ];
                $inserted = Gallery::create($data);
                if ($inserted) {
                    return redirect()->route('create_gallery')->with('success', 'Gallery is created successfully!');
                }
            }
            return redirect()->route('create_gallery')->with('error', 'Please select image!');
        } catch (\Exception $e) {
            return redirect()->route('create_gallery')->with('error', $e->getMessage());
        }
    }

    function GalleryLists(Request $req)
    {
        $galleries = Gallery::orderBy('id', 'desc')->get();
        return view('user.gallery_list', compact('galleries'));
    }

    function ShowGallery(Request $req)
    {
        $gallery_id = $req->id;
        $gallery = Gallery::find($gallery_id);
        return view('user.view_gallery', compact('gallery'));
    }

    function DeleteGalleryImg(Request $req)
    {
        try {
            if ($this->deletePermission() != true) {
                return response()->json(['success' => false, 'error' => 'You do not have permission!.'], 403);
            }
            $id = $req->id;
            $img_index = $req->img_index;
            if ($img_index == "NaN") {
                $img_index = 0;
            }
            $gallery = Gallery::find($id);
            if ($gallery) {
                $galleryImages = $gallery->gallery_img;
                if (isset($galleryImages[$img_index])) {
                    $filePath = $galleryImages[$img_index];
                    if (file_exists(public_path($filePath))) {
                        unlink(public_path($filePath));
                    }
                    unset($galleryImages[$img_index]);
                    $gallery->gallery_img = array_values($galleryImages);
                    $msg = 'Gallery Image deleted!';
                    $status = 200;
                    $gallery->save();
                    // check array is empty
                    if (empty($gallery->gallery_img)) {
                        $gallery->delete();
                        $msg = 'Gallery deleted!';
                        $status = 204;
                    }
                    return response()->json(['success' => true, 'status' => $status, 'message' => $msg], 200);
                } else {
                    // $gallery->delete();
                    return response()->json(['success' => true, 'message' => 'No Gallery Image found!.'], 404);
                }
            } else {
                return response()->json(['success' => false, 'error' => 'Gallery not found!.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    function EditGallery(Request $req)
    {
        $gallery = Gallery::find($req->id);
        return view('user.edit_gallery', compact('gallery'));
    }

    function UpdateGallery(Request $req)
    {
        $phtotoPath = '';
        try {
            if ($this->editPermission() != true) {
                return redirect()->route('edit_gallery', ['id' => $req->id])->with('error', 'You do not have permission!.');
            }
            if ($req->hasFile('images')) {
                $photos = $req->file('images');
                $phtotoPath = $this->UploadMultiImage($photos, "gallery");
                $data = [
                    'gallery_name' => $req->gallery_name,
                    'gallery_type' => $req->gallery_type,
                    'gallery_img' => $phtotoPath,
                    'user_id' => auth()->user()->id,

                ];
                $updated = Gallery::where('id', $req->id)->update($data);
                if ($updated) {
                    return redirect()->route('galleries')->with('success', 'Gallery is updated successfully!');
                }
            }
            return redirect()->route('galleries')->with('error', 'Please select image!');
        } catch (\Exception $e) {
            return redirect()->route('galleries')->with('error', $e->getMessage());
        }
    }


    protected function UploadMultiImage($imageReqName, $upload_path)
    {
        foreach ($imageReqName as $pic) {
            $path = 'gallery_' . time() . '.' . $pic->getClientOriginalName();
            $pic->move(public_path($upload_path), $path);
            $picsPath[] =  $upload_path . '/' . $path;
        }
        return $picsPath;
    }

    function Logout(Request $req)
    {
        auth()->logout();
        $req->session()->invalidate();
        return redirect('/');
    }
}
