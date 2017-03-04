<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Tutorials;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class TutorialsController extends Controller
{   
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Tutorials::all();
        
        $theads = [
            'Id',
            'Name',
            'File Path',
            'Thumbnail Path',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            $tdata[] = [
                'id' => $m->id,
                'name' => $m->name,
                'file_url' => $m->file_url,
                'thumbnail_url' => $m->thumbnail_url
            ];
        endforeach;

        $class = 'tutorials';

        return view('tutorials.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Tutorials::findById($id);
        return compact('success', 'data');
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit()
    {
    	echo json_encode(['success' => true, 'data' => 'this is for edit page.']);
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new Tutorials;
        $file_path_url_ = $input['file_url']->path();
        $thumbnail_url_ = $input['thumbnail_url']->path();

        $result = $model->setAttributesAndSave(array_merge($input, [
            'file_url' => $file_path_url_,
            'thumbnail_url' => $thumbnail_url_
         ]));
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/tutorials/index');
        } else {
            return view('errors.error500');
        }
    }

    /**
     * Landing view page for add
     * @return [type] [description]
     */
    public function create()
    {
        $attributes = [
            'name' => ['label' => 'Name', 'value' => '', 'type' => 'text'],
            'file_url' => ['label' => 'File Path', 'value' => '', 'type' => 'file'],
            'thumbnail_url' => ['label' => 'Thumbnail Url', 'value' => '', 'type' => 'file']
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'tutorials';

        return view('tutorials.create', ['data' => $attributes, 'class' => $class]);
    }
}