<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\Api\Contracts\ServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseController extends Controller
{
    use ApiResponse;

    protected $request;
    protected $service;
    protected $resource;

    public function __construct(ServiceInterface $service, string $resource, Request $request)
    {
        $this->request = $request;
        $this->service = $service;
        $this->resource = $resource;
    }

    public function index()
    {
        $items = $this->service->list($this->request->filter ?? null);
        return $this->successResponse($this->resource::collection($items));
    }

    public function store()
    {
        $item = $this->service->create($this->request->validated());
        return $this->successResponse(new $this->resource($item), 'Created successfully', 201);
    }

    public function show($id)
    {
        $item = $this->service->find($id);
        return $this->successResponse(new $this->resource($item));
    }

    public function update($id)
    {
        $item = $this->service->find($id);
        $item = $this->service->update($item, $this->request->validated());
        return $this->successResponse(new $this->resource($item), 'Updated successfully');
    }

    public function destroy($id)
    {
        $item = $this->service->find($id);
        $this->service->delete($item);
        return $this->successResponse(new $this->resource($item), 'Deleted successfully', 204);
    }
    
    
}
