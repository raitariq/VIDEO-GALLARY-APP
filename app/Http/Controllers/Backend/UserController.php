<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.modal');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone'         => 'required|regex:/^[0-9]+$/|min:11|max:11',
            'email'         => 'required|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/|unique:users',
            'password' => 'required',
            ]);
            DB::beginTransaction();
            try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'creator'
            ]);
            DB::commit();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User Added Successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.modal',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required|string',
            'phone' => 'required|regex:/^[0-9]+$/|min:11|max:11',
            'email' => ['required', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', 'unique:users,email,' . $id],
        ]);
            DB::beginTransaction();
            try {
                $user =   User::find($id);
                $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password ? Hash::make($request->password) :  $user->password,
            ]);
            DB::commit();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User Updated Successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        try{
                
            User::where(['id' => $id])->delete();
            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => "Successfully Deleated.."
            ], JsonResponse::HTTP_OK);   
        }catch(Exception $e){
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   
        } 
    }
    public function datatable(){
        $users = User::where('user_type', '!=', 'admin')->latest()->get();
        return Datatables::of($users)
            ->addColumn('date', function ($user) {
                return Carbon::parse($user->created_at)->format('d M Y');
            })
            ->addColumn('actions', function ($user) {
                $actions = '';
                $actions .= ' <a href="javascript:void(0);" data-act="ajax-modal" data-complete-location="true" data-method="get"
                data-action-url="' . route("users.edit", $user->id) . '" data-table="#user-table"><em class="icon ni ni-edit "></em>Edit
                </a>';
                    $actions .= '<a href="javascript:void(0)" class="delete " data-table="users-table" data-url="' . route('users.destroy', $user->id) . '"><em class="icon ni ni-trash text-danger"></em><span>Delete</span> </a>';

                ;
                return $actions;
            })
            ->editColumn('status', function ($user) {
                $isChecked = $user->status == 'active' ? 'checked' : '';
                $message = $user->status == 'active' ? 'You want to deactivate this record.' : 'You want to activate this record.';
                $statusTobeUpdate = $user->status == 'active' ? 'inactive' : 'active';
                return '<div class="preview-block">
                <div class="custom-control custom-switch custom-control-sm">
                    <input type="checkbox" class="custom-control-input toggle-clicked" data-message="'.$message.'"  id="customSwitch' . $user->id . '" ' . $isChecked . ' data-status="' . $statusTobeUpdate . '" data-url="' . route('change-user-status', $user->id) . '" data-table="#users-table">
                    <label class="custom-control-label switch-style2" for="customSwitch' . $user->id . '"></label>
                </div>
            </div>';
            })
            ->rawColumns(['date','actions','status'])
            ->addIndexColumn()->make(true);
    }
    public function changeStatus(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->status !== null && $user->status == 'inactive' && $request->status == 'inactive') {
                return response()->json([
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'User already Dactivated.'
                ], JsonResponse::HTTP_OK);
            }

            if ($user->status !== null && $user->status == 'active' && $request->status == 'active') {
                return response()->json([
                    'status' => JsonResponse::HTTP_OK,
                    'message' => 'User already activated.'
                ], JsonResponse::HTTP_OK);
            }

            $user->update([
                'status' => $request->status
            ]);

            return response()->json([
                'status' => JsonResponse::HTTP_OK,
                'message' => 'User status updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
