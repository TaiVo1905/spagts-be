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
use App\Models\Classes; // Assuming 'Classes' is your Class model name
use Illuminate\Support\Facades\Validator; // Import Validator
use Illuminate\Database\Eloquent\ModelNotFoundException; // Import ModelNotFoundException
use Exception; // Import Exception
use Illuminate\Support\Facades\Log; // Import Log facade


class ModuleController extends BaseController
{
    public function __construct(ModuleService $service, ModuleRequest $request)
    {
        parent::__construct($service, ModuleResource::class, $request, ModuleFilter::class);
    }

    public function getUserModules(Request $request)
    {
        // $this->validate(request(), [
        //     'user_id' => 'required|integer|exists:users,id'
        // ]);

        $user = User::findOrFail(3);
        
        // Get modules through the hasManyThrough relationship
        $modules = $user->modules()->get();

        return $this->successResponse($modules);
    }

    public function getModuleUsers(Request $request, $moduleId)
{
    try {
        $module = Module::findOrFail($moduleId);

        $users = User::query()
            ->where('roles', 'Student')
            ->whereHas('classes.modules', function ($query) use ($moduleId) {
                $query->where('modules.id', $moduleId);
            })
            ->get();

        return $this->successResponse($users, 'Users for module retrieved successfully.');

    } catch (ModelNotFoundException $exception) {
        return $this->errorResponse('Module not found.', 404);  // More generic error message
    } catch (Exception $exception) {
        Log::error('Failed to retrieve module users:', [
            'error' => $exception->getMessage(),
            'module_id' => $moduleId,
            'trace' => $exception->getTraceAsString()  // Added stack trace
        ]);
        return $this->errorResponse('Failed to retrieve users for this module.', 500);
    }
}

    public function addClassesToModule(Request $request, $moduleId)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'classIds' => 'required|array',
            'classIds.*' => 'integer|exists:classes,id', // Ensure each ID exists in the classes table
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $classIds = $request->input('classIds');

        try {
            $module = Module::findOrFail($moduleId);

            // Assuming a many-to-many relationship named 'classes' is defined in the Module model,
            // and a pivot table 'class_module' exists with 'module_id' and 'class_id' columns.
            // This method syncs the given IDs to the model, without detaching existing ones.
            $module->classes()->syncWithoutDetaching($classIds);

            return $this->sendResponse([], 'Module linked to classes successfully.');

        } catch (ModelNotFoundException $exception) {
            return $this->sendError('Module not found.', ['module' => 'Module with ID ' . $moduleId . ' not found.'], 404);
        } catch (Exception $exception) {
            // Log the error for debugging
            Log::error('Failed to link module to classes:', ['error' => $exception->getMessage(), 'module_id' => $moduleId, 'class_ids' => $classIds]);
            return $this->sendError('Failed to link module to classes.', ['error' => 'An internal error occurred.'], 500);
        }
    }
}
