<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();

        return view('category.index', $data);
    }


    public function create()
    {
        return view('category.create');
    }


    public function store( Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:categories,category_name',
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }
        $category_name = trim($request->input('name'));
        $category_slug = strtolower(str_replace(' ', '-', $category_name));
        $logged_user = auth()->user();

        Category::insert([
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'created_by' => $logged_user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        session()->flash('message', 'Category has been created successfully.');
        return redirect('/category');
    }


    public function edit( $id)
    {
        $data['categories'] = Category::find($id);
        return view('category.edit', $data);
    }


    public function update( Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:categories,category_name,' . $id,
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $category_name = trim($request->input('name'));
        $category_slug = strtolower(str_replace(' ', '-', $category_name));
        $logged_user = auth()->user();

        Category::where('id', $id)->update([
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'updated_by' => $logged_user->id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        session()->flash('message', 'Category has been updated successfully.');
        return redirect('/category');
    }


    public function destroy( $id)
    {

        $category = Category::find($id);
        if (!empty($category)) {
            $category->delete();
            session()->flash('message', 'Category has been deleted successfully.');
        } else {
            session()->flash('message', 'Somethings wents wrong');
            session()->flash('alert_tag', 'alert-danger');
        }
        return redirect('/category');
    }
}
