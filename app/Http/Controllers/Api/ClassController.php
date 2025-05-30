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
    public function __construct(ClassService $service, ClassRequest $request,)
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

            return $this->sendResponse([
                'students' => $students,
                'teachers' => $teachers
            ], 'Class members retrieved successfully');
        } catch (\Exception $e) {
            return $this->sendError('Error retrieving class members', $e->getMessage(), 500);
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
            $this->service->updateClassMembers($id, $request->all());
            return $this->successResponse(null, 'Cập nhật thành viên lớp học thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function deleteClassUsers($id)
    {
        try {
            $class = $this->service->find($id);
            if (!$class) {
                return $this->errorResponse('Lớp học không tồn tại');
            }
            $class->users()->detach();
            return $this->successResponse(null, 'Xóa thành viên lớp học thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function deleteClassModules($id)
    {
        try {
            $class = $this->service->find($id);
            if (!$class) {
                return $this->errorResponse('Lớp học không tồn tại');
            }
            $class->modules()->detach();
            return $this->successResponse(null, 'Xóa module lớp học thành công');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
