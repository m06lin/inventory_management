<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\GroupRepository;

class GroupController extends Controller
{
    private $repo;

    public function __construct(GroupRepository $repositroy)
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
        $name = $request->name;
        $model = $this->repo->create($name);
        return response()->json(['success' => 'success'], 200);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $item = [
            'name' => $request->name
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
