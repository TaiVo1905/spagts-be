<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\UserService;
use App\Http\Resources\Api\UserResource;
use App\Http\Resources\Api\UserCollection;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\Api\UserFilter;
use Illuminate\Http\Request;
use App\Services\Clouds\CloudinaryService;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends BaseController
{
    protected $cloudinaryService;

    public function __construct(UserService $service, UserRequest $request, CloudinaryService $cloudinaryService)
    {
        parent::__construct($service, UserResource::class, $request, UserFilter::class);
        $this->cloudinaryService = $cloudinaryService;
    }

    public function getUserClasses($id)
    {
        try {
            $user = User::findOrFail($id);
            
            $classes = $user->classes()
                ->get();
                

            return $this->successResponse($classes);
        } catch (\Exception $e) {
                        return $this->errorResponse( $e->getMessage(), 500);

        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            
            DB::table('certificates')->where('student_id', $id)->delete();
            
            
            DB::table('timetables')->where('user_id', $id)->delete();
            
            
            DB::table('semester_goals')->where('student_id', $id)->delete();
            
            
            DB::table('in_class_plan')->where('student_id', $id)->delete();
            
            
            DB::table('self_study_plan')->where('student_id', $id)->delete();
            
            
            DB::table('weekly_goals')->where('student_id', $id)->delete();
            
            
            DB::table('user_class')->where('user_id', $id)->delete();
            
            
            $user = User::find($id);
            if ($user && $user->roles === 'Teacher') {
                
                $moduleIds = DB::table('modules')->where('teacher_id', $id)->pluck('id');
                
                
                DB::table('class_module')->whereIn('module_id', $moduleIds)->delete();
                
                
                DB::table('modules')->where('teacher_id', $id)->delete();
                
                
                DB::table('classes')->where('teacher_id', $id)->delete();
            }
        
            
            DB::table('personal_access_tokens')->where('tokenable_id', $id)
                ->where('tokenable_type', 'App\\Models\\User')
                ->delete();
                
            
            DB::table('sessions')->where('user_id', $id)->delete();
            
            
            $user->delete();
            
            DB::commit();
            
            return response()->json([
                'message' => 'User deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }
}
