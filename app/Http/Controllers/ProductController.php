<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    private $repo;

    public function __construct(ProductRepository $repositroy)
    {
        $this->repo = $repositroy;
    }
    public function get(Request $request)
    {
        $id = $request->id ?? null;

        if ($id) {
            $model = $this->repo->get(['id' => $id]);
        } else {
            $model = $this->repo->getAll();
        }
        return  response()->json($model->toArray());
    }

    public function create(Request $request)
    {
        $uuid = $request->uuid ?? null;
        $name = $request->name ?? null;
        $group = $request->group ?? null;
        $description = $request->description ?? null;
        $unit = $request->unit ?? null;
        $status = $request->status ?? null;
        $elementIds = $request->elementIds ?? [];

        $model = $this->repo->create($uuid, $name, $group, $description, $unit, $status, $elementIds);
        $isSuccess = empty($model);

        return  response()->json([ 'success' => $isSuccess ], 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $item = [
            'uuid' => $request->uuid ?? null,
            'name' => $request->name ?? null,
            'group' => $request->group ?? null,
            'description' => $request->description ?? null,
            'unit' => $request->unit ?? null,
            'status' => $request->status ?? null,
            'elementIds' => $request->elementIds ?? [],
        ];

        $isSuccess = $this->repo->update($id, $item);
        return  response()->json(['success' => $isSuccess ], 200);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $isSuccess = $this->repo->delete($id);
        return response()->json(['success' => $isSuccess ], 200);
    }
}
