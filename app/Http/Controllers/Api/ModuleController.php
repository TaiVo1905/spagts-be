<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Services\Api\ModuleService;
use App\Http\Resources\Api\ModuleResource;
use App\Http\Requests\Api\ModuleRequest;
use App\Http\Filters\Api\ModuleFilter;
use App\Models\Module;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Log;


class ModuleController extends BaseController
{
    public function __construct(ModuleService $service, ModuleRequest $request)
    {
        parent::__construct($service, ModuleResource::class, $request, ModuleFilter::class);
    }

    public function getUserModules(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        
        
        $modules = $user->modules()->get();

        return $this->successResponse($modules);
    }

    public function getModuleUsers(Request $request, $moduleId)
{
    try {
        $module = Module::findOrFail($moduleId);

        $users = User::query()
            ->where('roles', $request->roles)
            ->whereHas('classes.modules', function ($query) use ($moduleId) {
                $query->where('modules.id', $moduleId);
            })
            ->get();

        return $this->successResponse($users, 'Users for module retrieved successfully.');

    } catch (ModelNotFoundException $exception) {
        return $this->errorResponse('Module not found.', 404);
    } catch (Exception $exception) {
        Log::error('Failed to retrieve module users:', [
            'error' => $exception->getMessage(),
            'module_id' => $moduleId,
            'trace' => $exception->getTraceAsString()
        ]);
        return $this->errorResponse('Failed to retrieve users for this module.', 500);
    }
}

    public function addClassesToModule(Request $request, $moduleId)
    {
        
        $validator = Validator::make($request->all(), [
            'classIds' => 'required|array',
            'classIds.*' => 'integer|exists:classes,id', 
        ]);

        if ($validator->fails()) {
            return $this->errorResponse( $validator->errors(), 400);
        }

        $classIds = $request->input('classIds');

        try {
            $module = Module::findOrFail($moduleId);

            
            $module->classes()->syncWithoutDetaching($classIds);

            return $this->successResponse([], 'Module linked to classes successfully.');

        } catch (ModelNotFoundException $exception) {
            return $this->errorResponse( 'Module with ID ' . $moduleId . ' not found.', 404);
        } catch (Exception $exception) {
            
            Log::error('Failed to link module to classes:', ['error' => $exception->getMessage(), 'module_id' => $moduleId, 'class_ids' => $classIds]);
            return $this->errorResponse('An internal error occurred.', 500);
        }
    }

    public function getClassesFromModule($moduleId)
    {
        try {
            $module = Module::findOrFail($moduleId);
            $classes = $module->classes()->get();

            return $this->successResponse(
                 $classes
            );
        } catch (\Exception $e) {
            return $this->errorResponse( 'Failed to get classes from module: ' . $e->getMessage()
            , 500);
        }
    }

    public function destroy($id)
    {
        try {
            $module = Module::findOrFail($id);
            
            
            $module->classes()->detach(); 
            
            
            $module->delete();

            return $this->successResponse(null, 'Module deleted successfully');
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse('Module not found', 404);
        } catch (\Exception $e) {
            Log::error('Failed to delete module:', [
                'error' => $e->getMessage(),
                'module_id' => $id
            ]);
            return $this->errorResponse('Failed to delete module: ' . $e->getMessage(), 500);
        }
    }
}
