<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nathanmac\Utilities\Parser\Facades\Parser;

class ParseXmlController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $parser = simplexml_load_file('img/cozinha.xml');
        foreach($parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY->ITEMS->ITEM as $item){
            echo "<pre>";
            print_r($item->attributes()->DESCRIPTION[0]);
            echo "<pre>";

            break;
        }
        /*echo "<pre>";
        print_r($parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY->ITEMS);
        echo "<pre>";*/


        /*return view('welcome');*/
    }
}
