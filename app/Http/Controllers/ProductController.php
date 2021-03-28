<?php

namespace App\Http\Controllers;

use App\Category;
use App\CoreMechanism\Files;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::with('category', 'sub_category')->get();
        return view('product.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::select('id', 'category_name')->get();
        $data['sub_categories'] = SubCategory::select('id', 'sub_category_name')->get();
        return view('product.create', $data);
    }

    public function store(Request $request, Files $fileObj)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required |unique:products,name',
            'price' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'feature_image' => 'required',
            'description' => 'required',
            'product_image' => 'required',
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        $product_name = trim($request->input('name'));
        $price = trim($request->input('price'));
        $description = trim($request->input('description'));
        $category_id = $request->input('category_id');
        $sub_category_id = $request->input('sub_category_id');
        $logged_user = auth()->user();

        if ($request->hasFile('feature_image')) {
            $dir_name = "feature_image";
            $files = $request->file('feature_image');
            $image = $fileObj->upload_file($files, $dir_name);
            $title_input = $request->input($dir_name);
            $profile_pic = !empty($title_input) ? $title_input : $image;
        }

        if($request->hasfile('product_image'))
        {
            foreach($request->file('product_image') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/product_image/', $name);
                $data[] = $name;
            }
        }

        Product::insert([
            'name' => $product_name,
            'price' => $price,
            'description' => $description,
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'feature_image' => $profile_pic,
            'product_image' => json_encode($data),
            'created_by' => $logged_user->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        session()->flash('message', 'Product has been created successfully.');
        return redirect('/product');
    }

    public function destroy( $id)
    {

        $product = Product::find($id);
        if (!empty($product)) {
            $product->delete();
            session()->flash('message', 'Product has been deleted successfully.');
        } else {
            session()->flash('message', 'Somethings wents wrong');
            session()->flash('alert_tag', 'alert-danger');
        }
        return redirect('/product');
    }
}
