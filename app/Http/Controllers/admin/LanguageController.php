<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Language;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class LanguageController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Language::all();
        $theads = [
            'Id',
            'Description',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'description' => $m->description
                ];
            }
        endforeach;

        $class = 'language';

        return view('languages.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Language::findById($id);
        return compact('success', 'data');
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit($id)
    {
        $model = Language::findById($id);
        $attributes = [
            'description' => [
                'label' => 'Description', 
                'value' => $model->description, 
                'type' => 'text'
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'language';

        return view('languages.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function create()
    {
        $attributes = [
            'description' => [
                'label' => 'Description', 
                'value' => '', 
                'type' => 'text'
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'language';

        return view('languages.create', ['data' => $attributes, 'class' => $class]);
    }

    public function store()
    {
        $input = Request::all();
        
        $model = new Language;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/language/index');
        } else {
            return view('errors.error500');
        }

    }

    public function update($id)
    {
        $input = Request::all();
        
        $model = Language::findById($id);
        $result = $model->setAttributesAndSave(array_merge($input, ['id' => $id]));
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/language/index');
        } else {
            return view('errors.error500');
        }
    }
}