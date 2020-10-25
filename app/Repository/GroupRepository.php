<?php

namespace App\Repository;

use App\Model\Group;
use Illuminate\Support\Arr;

class GroupRepository
{
    public function getAll()
    {
        return Group::all();
    }

    public function get($getArr)
    {
        $group = new Group;

        if (Arr::has($getArr, 'name')) {
            $group->where('name', $getArr['name']);
        }
        if (Arr::has($getArr, 'description')) {
            $group->where('description', $getArr['description']);
        }

        return $group->get();
    }

    public function create($name)
    {
        $group = Group::create([
            'name' => $name,
        ]);

        return $group;
    }

    public function update($id, $updateArr)
    {
        $group = Group::where('id', $id)->first();

        if (!$group) {
            return false;
        }

        try {
            if (Arr::has($updateArr, 'name')) {
                $group->name = $updateArr['name'];
            }
    
            $group->save();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }

    public function delete($id)
    {
        $group = Group::where('id', $id)->first();

        if (!$group) {
            return false;
        }
        
        try {
            $group->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }
}
