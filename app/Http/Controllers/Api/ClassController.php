<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Services\Api\ClassService;
use App\Http\Resources\Api\ClassResource;
use App\Http\Requests\Api\ClassRequest;
use App\Http\Filters\Api\ClassFilter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;


class ClassController extends BaseController
{
    public function __construct(ClassService $service, ClassRequest $request)
    {
        parent::__construct($service, ClassResource::class, $request, ClassFilter::class);
    }

    public function getClassMembers($id)
    {
        try {
            $class = Classes::findOrFail($id);
            
            $students = $class->users()
                ->where('roles', 'Student')
                ->get();
                
            $teachers = $class->users()
                ->where('roles', 'Teacher')
                ->get();

            return $this->successResponse([
                'students' => $students,
                'teachers' => $teachers
            ], 'Class members retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse( $e->getMessage(), 500);
        }
    }

    public function updateClassMembers(Request $request, $id)
    {
        $rules = [
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id',
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:users,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ], 422);
        }

        try {
            DB::beginTransaction();

            
            DB::table('user_class')->where('class_id', $id)->delete();

            
            foreach ($request->student_ids as $studentId) {
                
                $existingClass = DB::table('user_class')
                    ->join('users', 'users.id', '=', 'user_class.user_id')
                    ->where('users.id', $studentId)
                    ->where('users.roles', 'Student')
                    ->first();

                if ($existingClass) {
                    throw new Exception("Student ID {$studentId} is already in another class");
                }

                DB::table('user_class')->insert([
                    'class_id' => $id,
                    'user_id' => $studentId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            
            foreach ($request->teacher_ids as $teacherId) {
                DB::table('user_class')->insert([
                    'class_id' => $id,
                    'user_id' => $teacherId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            DB::commit();
            return $this->successResponse(null, 'Cập nhật thành viên lớp học thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function deleteClassUsers($id)
    {
        try {
            $class = Classes::findOrFail($id);
            $class->users()->detach();
            return $this->successResponse(null, 'Xóa thành viên lớp học thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function deleteClassModules($id)
    {
        try {
            $class = Classes::findOrFail($id);
            $class->modules()->detach();
            return $this->successResponse(null, 'Xóa module lớp học thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            
            
            DB::table('user_class')->where('class_id', $id)->delete();
            
            
            DB::table('class_module')->where('class_id', $id)->delete();
            
            
            DB::table('semester_goals')
                ->whereIn('student_id', function($query) use ($id) {
                    $query->select('user_id')
                        ->from('user_class')
                        ->where('class_id', $id);
                })
                ->delete();
            
            
            DB::table('in_class_plan')
                ->whereIn('student_id', function($query) use ($id) {
                    $query->select('user_id')
                        ->from('user_class')
                        ->where('class_id', $id);
                })
                ->delete();
            
            
            DB::table('self_study_plan')
                ->whereIn('student_id', function($query) use ($id) {
                    $query->select('user_id')
                        ->from('user_class')
                        ->where('class_id', $id);
                })
                ->delete();
            
            
            DB::table('weekly_goals')
                ->whereIn('student_id', function($query) use ($id) {
                    $query->select('user_id')
                        ->from('user_class')
                        ->where('class_id', $id);
                })
                ->delete();
            
            
            $class = Classes::findOrFail($id);
            $class->delete();
            
            DB::commit();
            
            return response()->json([
                'message' => 'Class deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error deleting class: ' . $e->getMessage()
            ], 500);
        }
    }
}
