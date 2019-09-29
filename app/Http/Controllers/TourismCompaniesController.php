<?php

namespace App\Http\Controllers;

use App\TourismCompanies;
use App\TourismCompanies_Gallery;
use Illuminate\Http\Request;

class TourismCompaniesController extends Controller
{
    public function index(){
        $items = TourismCompanies::orderby('created_at','desc')->paginate(10);
        return view('tourism_companies',compact('items'));
    }

    public function index_view($slug = null,$id = null){
        $item = TourismCompanies::where([
            'id' => $id,
            'slug' => $slug,
        ])->first();
        if($item == null){
            return redirect()->to('/');
        }
        $gallery = TourismCompanies_Gallery::where('tourism_companies_id',$item->id)->get();
        return view('tourism_companies_view',compact('item','gallery'));
    }

}
