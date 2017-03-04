<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\GameObject;
use App\Questions;
use App\Videos;
use App\Pronounce;

/**
 * Helpers
 */
use Illuminate\Http\Request as LaraRequest;

class OverallController extends Controller
{
    public function specific($category_id, $lang_id)
    {
        $success = true;
     
        $data[] = array(
                    'game' => GameObject::getResults($category_id,$lang_id),
                    'question' => Questions::getResults($category_id,$lang_id),
                    'videos' => Videos::getResults($category_id,$lang_id),
                    'pronounce' => Pronounce::getResults($category_id,$lang_id)
                );
        return compact('success', 'data');
    }
}