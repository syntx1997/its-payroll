<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeductionCategory;
use Illuminate\Support\Facades\Validator;

class DeductionCategoryController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        DeductionCategory::create(['name' => $request->name]);

        return response(['message' => 'Category Added Successfully!'], 201);
    }

    public function get_all() {
        $data = [];
        $categories = DeductionCategory::all()->sortByDesc('id');

        foreach ($categories as $category) {

            $attribute = <<<HERE
                data-id="$category->id" data-name="$category->name"
            HERE;

            $actions = <<<HERE
                <button id="edit-btn" type="button" class="btn btn-light text-success" $attribute><i class="la la-edit"></i></button>
                <button id="delete-btn" type="button" class="btn btn-light text-danger" $attribute><i class="la la-trash"></i></button>
            HERE;



            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'actions' => $actions
            ];
        }

        return response(['data' => $data], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $category = DeductionCategory::find($request->id);
        $category->update(['name' => $request->name]);
        return response(['message' => 'Category updated successfully!'], 201);
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $category = DeductionCategory::find($request->id);
        $category->delete();
        return response(['message' => 'Category deleted successfully!'], 201);
    }
}
