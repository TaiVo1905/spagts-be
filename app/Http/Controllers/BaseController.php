<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Filters\Api\BaseFilter;
use App\Services\Api\Contracts\ServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;


class BaseController extends Controller
{
    use ApiResponse;

    protected $request;
    protected $service;
    protected $resource;
    protected $filter;

    public function __construct($service, $resource, $request, $filter)
    {
        $this->request = $request;
        $this->service = $service;
        $this->resource = $resource;
        $this->filter = $filter;
    }

    public function index()
    {
        $items = $this->service->list($this->filter ?? null);
        $resource = $this->resource::collection($items);
        return $this->successResponse($resource->response()->getData(true)['data'], $resource->response()->getData(true)['links'], $resource->response()->getData(true)['meta']);
    }

    public function store()
    {
        $item = $this->service->create($this->request->all());
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
        $item = $this->service->update($item, $this->request->all());
        return $this->successResponse(new $this->resource($item), 'Updated successfully');
    }

    public function destroy($id)
    {
        $item = $this->service->find($id);
        $this->service->delete($item);
        return $this->successResponse(new $this->resource($item), 'Deleted successfully', 204);
    }
}
