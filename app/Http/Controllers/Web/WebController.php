<?php

namespace LaraDev\Http\Controllers\Web;

use Illuminate\Http\Request;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Model\Admin\Property;

class WebController extends Controller
{
    public function home()
    {
        $propertiesForSale = Property::sale()->available()->orderBy('id', 'DESC')->get();
        $propertiesForRent = Property::rent()->available()->orderBy('id', 'DESC')->get();
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

    public function buy()
    {
        return view('web.filter');
    }

    public function filter()
    {
        return view('web.filter');
    }
}
