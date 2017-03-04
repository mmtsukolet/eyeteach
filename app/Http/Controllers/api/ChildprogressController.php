<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\ChildProgress;
use App\User;
use App\Child;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class ChildprogressController extends Controller
{
    const ACTIVIY_QNA = 1;
    const ACTIVTIY_COLOR = 2;
    const ACTIVITY_WRITING = 3;
    const ACTIVITY_PRONUNCIATION = 4;

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        /*print_r($input);
        die('stop');*/

        $model = new ChildProgress;

        $result = $model->setAttributesAndSave($input);
        $cp = 0;
        if ($result['success'] != 0){
            $temp = ChildProgress::findById($result['success']);
            $cp = $temp->progress_mobile_id;
        }

        return $cp;
    }

    /**
     * This accepts query string
     * @param  [type] $child_id [description]
     * @return [type]           [description]
     */
    public function getChildProgress($child_id)
    {  
        $data = [];
        foreach ($this->getActivities() as $k => $m) {

            $res = ChildProgress::getByActivityAndChildId($m, $child_id);
            $counter = 0;
            foreach ($res as $inner) {
                $data[$k] = $data + [
                    'correct' => ($inner->progress_status) ? $counter + 1 : $counter + 0,
                    'incorrect' => (!$inner->progress_status) ? $counter + 1 : $counter + 0
                ];
            }
        }

        // echo json_encode(['data' =>$data]);
        return compact('data');
    }

    public function getActivities()
    {
        return [
            'qna' => self::ACTIVIY_QNA,
            'coloring' => self::ACTIVTIY_COLOR,
            'writing' => self::ACTIVITY_WRITING,
            'pronunciation' => self::ACTIVITY_PRONUNCIATION
        ];
    }

}