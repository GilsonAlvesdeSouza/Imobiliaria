<?php

namespace LaraDev\Http\Controllers\Web;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Model\Admin\Property;

class WebController extends Controller
{
    public function home()
    {
        $propertiesForSale = Property::sale()->available()->orderBy('id', 'DESC')->limit(3)->get();
        $propertiesForRent = Property::rent()->available()->orderBy('id', 'DESC')->limit(3)->get();
        return view('web.home',[
            'propertiesForSale' => $propertiesForSale,
            'propertiesForRent' => $propertiesForRent
        ]);
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function rent()
    {
        return view('web.filter');
    }

    public function rentProperty($slug)
    {
        $property = Property::where('slug', $slug)->first();

        return view('web.property', [
            'property' => $property
        ]);
    }

    public function buy()
    {
        return view('web.filter');
    }

    public function buyProperty($slug)
    {
        $property = Property::where('slug', $slug)->first();

        return view('web.property', [
            'property' => $property
        ]);
    }

    public function filter()
    {
        return view('web.filter');
    }
}
