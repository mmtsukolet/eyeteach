<?php


namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\ChildProgress;
use App\Child;

/**
 * Helpers
 */
use Illuminate\Http\Request as LaraRequest;

class ChildprogressController extends Controller
{
    public function index()
    {
       	// Display by parent's children
    	$theads = [];
    	$tdata = [];
    	$class = 'childprogress';

        $child = Child::getByParentId(1);

        $theads = [
            'Id', 
            'Child Name',
            ''
        ];

        $tdata = [];
        foreach ($child as $c) {
            $tdata[] = [
                'id' => $c->id,
                'child_name' => $c->child_name,
                'view' => '<a href="' . url('admin/childprogress/' . $c->id . "/child") . '" class="btn btn-info">View</a>' 
            ];
        }

        $class = 'Childprogress';

        return view('childprogress.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    	// return view('childprogress.reports', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    public function show($id)
    {
        $theads = [];
        $tdata = [];
        $class = 'childprogress';

        $child = Child::getByParentId($id);

        $theads = [
            'Id', 
            'Child Name',
            ''
        ];

        $tdata = [];
        foreach ($child as $c) {
            $tdata[] = [
                'id' => $c->id,
                'child_name' => $c->child_name,
                'view' => '<a href="' . url('admin/childprogress/' . $c->id . "/child") . '" class="btn btn-info">View</a>' 
            ];
        }

        $class = 'Childprogress';

        return view('childprogress.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }


    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new ChildProgress;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
    }

    public function getChildProgress($child_id)
    {
        return view('childprogress.reports', ['child_id' => $child_id]);
    }
}