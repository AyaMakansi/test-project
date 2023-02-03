<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\offerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Mcamara\LaravelLocalization\LaravelLocalization as LaravelLocalizationLaravelLocalization;

class CrudController extends Controller
{
   use offerTrait;
       public function getoffers()
   {
    return Offer::select('id','name','details')->get();
   }

  /* public function store()
   {
    Offer::create([
        'name'=>'offer1',
        'price'=>'123',
        'details'=>'assajdssk',
    ]);
   }*/
   
   public function create(){
    return view('offers.create');
   }
   public function store(OfferRequest $request){
   /* $messages=$this->getMessage();
    $rules = $this->getRules();
    $validator = Validator::make(
        $request->all()
    ,$rules,$messages);
    
    if($validator->fails())
    {
        return redirect()->back()->withErrors($validator)->withInputs($request->all());
    }
    */
    //save photo in folder
    $file_name=$this->saveImage($request->photo,'images/offers');
    
    Offer::create([
        'photo'=>$file_name,
        'name_en'=>$request->name_en,
        'name_ar'=>$request->name_ar,
        'price'=>$request->price,
        'details_en'=>$request->details_en,
        'details_ar'=>$request->details_ar,
     ]);
     return redirect()->back()->with(['success'=>__('messeges.offer added successfully')]);
    }
    
  /*protected function getMessage(){
  return $messages=[
    'name.required'=>trans('messeges.offer name required'),
    'name.unique'=>__('messeges.offer name unique'),
    'price.required'=>__('messeges.offer price required'),
    'price.numeric'=>__('messeges.offer price must be numbers'),
    'details.required'=>__('messeges.offer details required'),

   ];    
  }
  protected function getRules(){
    return $rules =[
        'name'=>'required|max:10|unique:offers,name',
        'price'=>'required|numeric',
        'details'=>'required',
    ];   
    }*/
    public function getalloffers(){
       $offers= Offer::select('id',
       'name_'.LaravelLocalization::getCurrentLocale().' as name','price',
       'details_'.LaravelLocalization::getCurrentLocale().' as details','photo')->get();
       return view('offers.all',compact('offers'));
    }
    public function editoffer($offer_id)
    {
       $offers= Offer::find($offer_id);
       if(!$offers)
       return redirect()->back();
       $offer=Offer::select('id','photo','name_en','name_ar','price','details_en','details_ar')->find($offer_id);
      return view('offers.edit',compact('offer'));
    }
    public function deletoffer($offer_id){
     
        $offer= Offer::find($offer_id);
        if(!$offer)
        return redirect()->back()->with(['error'=>__('messeges.offer not exist')]);
        $offer->delete();
        return redirect()->route('offers.all')->with(['success'=>__('messeges.offer deleted successfully')]);
    }

    public function updateoffer(OfferRequest $request,$offer_id)
    { 
        //valdation

       
        //check if offer exists
        $offer= Offer::find($offer_id);
       if(!$offer)
       return redirect()->back();
        //update data
       $offer->update($request->all());
       $file_name=$this->saveImage($request->photo,'images/offers/') ;
       $offer->update(['photo' => $file_name]);   
       return redirect()->back()->with(['success'=>__('messeges.offer updated successfully')]);
    }
    public function getvideo(){

        $video=Video::first();
        event(new VideoViewer($video));
        return view('video')->with('video',$video);
    }   
   
}
