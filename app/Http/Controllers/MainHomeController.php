<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MainHomeController extends Controller
{
    public function welcome()
    {
        $sliderproducts = DB::table('test')
            ->orderBy('price', 'DESC')
            ->limit(4)
            ->get();
            
        return view('welcome', [
            'sliderproducts' => $sliderproducts
        ]);
    }
    
public function catalog(Request $request)
{
    $query = DB::table('test');
    
    if ($request->has('sort_year')) {
        if ($request->sort_year == 'new') {
            $query->orderBy('year', 'DESC');
        } elseif ($request->sort_year == 'old') {
            $query->orderBy('year', 'ASC');
        }
    }
    
    if ($request->has('sort_rating')) {
        if ($request->sort_rating == 'high') {
            $query->orderBy('price', 'DESC');
        } elseif ($request->sort_rating == 'low') {
            $query->orderBy('price', 'ASC');
        }
    }
    
    
    if (!$request->has('sort_year') && !$request->has('sort_rating')) {
        $query->orderBy('name', 'ASC');
    }
    
    $myproducts = $query->get();
    
    return view('catalog', [
        'myproducts' => $myproducts
    ]);
}

    public function where()
    {
        return view('where');
    }
    
    public function product($id)
    {
        $product = DB::table('test')->where('id', $id)->limit(1)->get();
        return view('product', ['myproducts' => $product]);
    }
    
    public function review($id)
    {
        $product = DB::table('test')->where('id', $id)->first();
        
        if (!$product) {
            abort(404);
        }
        
        return view('review', ['product' => $product]);
    }
    
    public function panel(){
        $yy = DB::table('test')->get();
        $tt = DB::table('test')->orderBy('id', 'DESC')->first();
        return view('panel', ['yy'=> $yy, 'tt'=> $tt]);
    }
    
    public function del(Request $gg){
        DB::table('test')->where('id', $gg->id)->delete();
        return redirect()->back();
    }
    
    public function redact(Request $gg){
        DB::table('test')->where('id', $gg->id)->update(['name' => $gg->name]);
        return redirect()->back();
    }

    public function add_img(Request $request){
        $img = $request->file('image');
        $typeImg = $img->extension();
        $uniqName = Str::uuid();
        $nameImg = $uniqName.'.'.$typeImg;
        $path = 'images';
        $img->move(public_path($path), $nameImg);

        DB::table('test')->insert([
            'name' => $request->name_product,
            'price' => $request->price_product,
            'about' => $request->about_product,
            'year' => $request->year_product,
            'review' => $request->review_product,
            'img' => $nameImg,
        ]);

        return redirect(url()->previous())->with(['msg' => 'Фильм добавлен!']);
    }
}