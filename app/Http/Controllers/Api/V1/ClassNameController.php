<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Api\V1\ClassNameRequest;
use App\Http\Resources\Api\V1\ClassNameResource;
use App\Services\Api\V1\ClassNameService;
use Illuminate\Http\Request;

class ClassNameController extends BaseController
{
    protected $service;
    protected $resourceClass = ClassNameResource::class;

    public function __construct(ClassNameService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->all();
        return $this->resourceClass::collection($data);
    }

    public function store(ClassNameRequest $request)
    {
        $data = $this->service->create($request->validated());
        return new $this->resourceClass($data);
    }

    public function show($id)
    {
        $data = $this->service->find($id);
        return new $this->resourceClass($data);
    }

    public function update(ClassNameRequest $request, $id)
    {
        $data = $this->service->update($id, $request->validated());
        return new $this->resourceClass($data);
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return response()->json(['message' => 'Class deleted successfully']);
    }
}
