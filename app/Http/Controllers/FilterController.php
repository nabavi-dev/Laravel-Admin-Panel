<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class FilterController extends Controller
{
    public function index()
    {
        return view('filter.index');
    }

    function action(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $product_img = '';
            $price = $request->get('price');
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            if ($price != '') {
                $data = DB::table('products as p')
                    ->join('categories as c', 'p.category_id', '=', 'c.id')
                    ->join('sub_categories as sc', 'p.sub_category_id', '=', 'sc.id')
                    ->orWhere('p.price', '=', $price)
                    ->whereBetween('p.created_at', [$from_date, $to_date])
                    ->orderBy('p.id', 'desc')
                    ->get();
            }

            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    foreach (json_decode($row->product_image, true) as $img) {
                        $product_img .= '<img style="border-radius: 50%;" id="blah"
                             src="http://127.0.0.1:8000/product_image/' . $img . '"
                             alt="Feature Image"
                             height="40px" width="40px"/>';
                    }
                    $output .= '
                    <tr>
                     <td>' . $row->name . '</td>
                     <td>' . $row->price . '</td>
                     <td>' . $row->description . '</td>
                     <td>' . $row->category_name . '</td>
                     <td>' . $row->sub_category_name . '</td>
                     <td>' .
                        '<img style="border-radius: 50%;" id="blah"
                             src="http://127.0.0.1:8000/storage/feature_image/' . $row->feature_image . '"
                             alt="Feature Image"
                             height="40px" width="40px"/>'
                        . '</td>
                     <td>' . $product_img . '</td>
                    </tr>
                    ';
                }
            } else {
                $output = '
                   <tr>
                    <td align="center" colspan="7">No Data Found</td>
                   </tr>
                   ';
            }
            $data = array(
                'table_data' => $output,
                'total_data' => $total_row
            );
            echo json_encode($data);
        }
    }
}
