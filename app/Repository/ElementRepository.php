<?php

namespace App\Repository;

use App\Model\Element;
use Illuminate\Support\Arr;

class ElementRepository
{
    public function getAll()
    {
        return Element::all();
    }

    public function get($getArr)
    {
        $element = new Element;

        if (Arr::has($getArr, 'uuid')) {
            $element->where('uuid', $getArr['uuid']);
        }
        if (Arr::has($getArr, 'name')) {
            $element->where('name', $getArr['name']);
        }
        if (Arr::has($getArr, 'description')) {
            $element->where('description', $getArr['description']);
        }
        if (Arr::has($getArr, 'group')) {
            $element->where('group', $getArr['group']);
        }

        return $element->get();
    }

    public function create($uuid, $name, $group, $description = null)
    {
        $element = Element::create([
            'uuid' => $uuid,
            'name' => $name,
            'group' => $group,
            'description' => $description,
        ]);

        return $element;
    }

    public function update($id, $updateArr)
    {
        $element = Element::where('id', $id)->first();

        if (!$element) {
            return false;
        }

        try {
            if (Arr::has($updateArr, 'uuid')) {
                $element->uuid = $updateArr['uuid'];
            }
            if (Arr::has($updateArr, 'name')) {
                $element->name = $updateArr['name'];
            }
            if (Arr::has($updateArr, 'description')) {
                $element->description = $updateArr['description'];
            }
            if (Arr::has($updateArr, 'group')) {
                $element->group = $updateArr['group'];
            }
    
            $element->save();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }

    public function delete($id)
    {
        $element = Element::where('id', $id)->first();

        if (!$element) {
            return false;
        }
        
        try {
            $element->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }
}
