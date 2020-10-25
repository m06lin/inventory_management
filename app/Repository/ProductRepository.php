<?php

namespace App\Repository;

use DB;
use App\Model\Product;
use Illuminate\Support\Arr;

class ProductRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function get($getArr)
    {
        $product = new Product;

        if (Arr::has($getArr, 'uuid')) {
            $product->where('uuid', $getArr['uuid']);
        }
        if (Arr::has($getArr, 'name')) {
            $product->where('name', $getArr['name']);
        }
        if (Arr::has($getArr, 'description')) {
            $product->where('description', $getArr['description']);
        }
        if (Arr::has($getArr, 'group')) {
            $product->where('group', $getArr['group']);
        }

        return $product->get();
    }

    public function create($uuid, $name, $group, $description, $unit, $status, $compriseElementIds)
    {
        DB::beginTransaction();
        try {
            $product = Product::create([
                'uuid' => $uuid,
                'name' => $name,
                'group' => $group,
                'description' => $description,
                'unit' => $unit,
                'status' => $status,
            ]);

            $product->elements()->attach($compriseElementIds);
            DB::commit();
        } catch (\Exception $e) {
            \Log::error($e);
            DB::rollBack();
            return null;
        }

        return $product;
    }

    public function update($id, $updateArr)
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return false;
        }

        try {
            if (Arr::has($updateArr, 'uuid')) {
                $product->uuid = $updateArr['uuid'];
            }
            if (Arr::has($updateArr, 'name')) {
                $product->name = $updateArr['name'];
            }
            if (Arr::has($updateArr, 'description')) {
                $product->description = $updateArr['description'];
            }
            if (Arr::has($updateArr, 'group')) {
                $product->group = $updateArr['group'];
            }
            if (Arr::has($updateArr, 'unit')) {
                $product->group = $updateArr['unit'];
            }
            if (!empty($updateArr['elementIds'])) {
                $product->elements()->attach($updateArr['elementIds']);
            }
    
            $product->save();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();

        if (!$product) {
            return false;
        }
        
        try {
            $product->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return false;
        }
        return true;
    }
}
