<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class ResourceController extends Controller
{
    protected $repository;

    protected $requestRootPath = 'App\Http\Requests';
    protected $requestMidPath = '';

    protected $pagination = false;
    protected $perPage = 15;

    public function __construct()
    {
        $this->boot();
    }

    public function boot()
    {
        $this->repository = resolve($this->repository());
    }

    abstract public function repository();

    abstract public function entityName();

    public function requests($prefixName, $nullable = false)
    {
        $midPath = '';
        if ($this->requestMidPath) {
            $midPath = Str::finish($this->requestMidPath, '\\');
        }

        $class = $this->requestRootPath . '\\' . $midPath . $this->entityName() . '\\' . $prefixName . 'Request';

        try {
            $classExisted = class_exists($class);
        } catch (\ErrorException $th) {
            $classExisted = false;
        }

        if (!$classExisted && $nullable) {
            return null;
        }

        return resolve($class);
    }

    public function index(Request $request)
    {
        $request = $this->requests('Index', true) ?? $request;
        if ($this->pagination) {
            $data = $this->repository->paginate($this->perPage);
        } else {
            $data = $this->repository->all();
        }
        return $this->respond($data);
    }

    public function store(Request $request)
    {
        $request = $this->requests('Create');
        $this->creating($this->repository, $request);
        $data = $this->repository->create($request->all());
        $this->created($data, $this->repository, $request);
        return $this->respondCreated($data);
    }

    public function show(Request $request, $id)
    {
        $this->requests('Show', true);
        $data = $this->repository->find($id);
        return $this->respond($data);
    }

    public function update(Request $request, $id)
    {
        $request = $this->requests('Update');
        $this->updating($id, $this->repository, $request);
        $data = $this->repository->update($request->all(), $id);
        $this->updated($id, $data, $this->repository, $request);
        return $this->respond($data);
    }

    public function destroy(Request $request, $id)
    {
        $this->requests('Destroy');
        $data = $this->repository->find($id);
        $this->deleting($this->repository, $id, $data);
        $this->repository->delete($id);
        $this->deleted($id, $data, $this->repository);
        return $this->respond($data);
    }

    protected function creating($repository, $request)
    {
        //
    }

    protected function created($data, $repository, $request)
    {
        //
    }

    protected function updating($id, $repository, $request)
    {
        //
    }

    protected function updated($id, $data, $repository, $request)
    {
        //
    }

    protected function deleting($repository, $id, $data)
    {
        //
    }

    protected function deleted($id, $data, $repository)
    {
        //
    }
}
