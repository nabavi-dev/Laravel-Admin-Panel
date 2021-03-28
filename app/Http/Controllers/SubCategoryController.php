<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SubCategoryController extends Controller
{
    public function index()
    {
        $data['subcategories'] = SubCategory::all();

        return view('subcategory.index', $data);
    }


    public function create()
    {
        return view('subcategory.create');
    }


    public function store( Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:sub_categories,sub_category_name',
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }
        $sub_category_name = trim($request->input('name'));
        $sub_category_slug = strtolower(str_replace(' ', '-', $sub_category_name));
        $logged_user = auth()->user();

        SubCategory::insert([
            'sub_category_name' => $sub_category_name,
            'sub_category_slug' => $sub_category_slug,
            'created_by' => $logged_user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        session()->flash('message', 'Sub-Category has been created successfully.');
        return redirect('/subcategory');
    }


    public function edit( $id)
    {
        $data['subcategories'] = SubCategory::find($id);
        return view('subcategory.edit', $data);
    }


    public function update( Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:sub_categories,sub_category_name,' . $id,
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $sub_category_name = trim($request->input('name'));
        $sub_category_slug = strtolower(str_replace(' ', '-', $sub_category_name));
        $logged_user = auth()->user();

        SubCategory::where('id', $id)->update([
            'sub_category_name' => $sub_category_name,
            'sub_category_slug' => $sub_category_slug,
            'updated_by' => $logged_user->id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->flash('message', 'Sub-Category has been updated successfully.');
        return redirect('/subcategory');
    }


    public function destroy( $id)
    {

        $sub_category = SubCategory::find($id);
        if (!empty($sub_category)) {
            $sub_category->delete();
            session()->flash('message', 'Sub-Category has been deleted successfully.');
        } else {
            session()->flash('message', 'Somethings wents wrong');
            session()->flash('alert_tag', 'alert-danger');
        }
        return redirect('/subcategory');
    }
}
