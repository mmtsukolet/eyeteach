<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Strokes;
use App\GameCategory;
use App\Language;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;


class StrokesController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Strokes::all();

        $theads = [
            'Id',
            'Game Object', // FK Game
            'Language', // FK Game
            'Name',
            'Description',
            'File Path',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'category_id' => GameCategory::findById($m->category_id)->category_name,
                    'lang_id' => Language::findById($m->lang_id)->description,
                    'description' => $m->description
                ];
            }
        endforeach;

        $class = 'strokes';

        return view('strokes.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Strokes::findById($id);
        return compact('success', 'data');
    }

    /**
     * Landing page for Create
     * @return [type] [description]
     */
    public function create()
    {
        $categories = GameCategory::all();
        $category_opt = [];
        if (!empty($categories)) {
            foreach ($categories as $category) :
                $category_opt = $category_opt + [$category->id => $category->category_name];           
            endforeach;
        }

        $languages = Language::all();
        $lang_opt = [];
        if (!empty($languages)) {
            foreach ($languages as $lang) :
                $lang_opt = $lang_opt + [ $lang->id => $lang->description ];
            endforeach; 
        }

        $attributes = [
            'category_id' => [
                'label' => 'Game Object',
                'type' => 'selectbox',
                'option' => $category_opt
            ],
            'lang_id' => [
                'label' => 'Language',
                'type' => 'selectbox',
                'option' => $lang_opt
            ],
            'description' => [
                'label' => 'Description',
                'type' => 'text',
                'value' => ''
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'strokes';

        return view('strokes.create', ['data' => $attributes, 'class' => $class]);
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new Strokes;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/strokes/index');
        } else {
            return view('errors.error500');
        }
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit($id)
    {
    	$categories = GameCategory::all();
        $category_opt = [];
        if (!empty($categories)) {
            foreach ($categories as $category) :
                $category_opt = $category_opt + [$category->id => $category->category_name];           
            endforeach;
        }

        $languages = Language::all();
        $lang_opt = [];
        if (!empty($languages)) {
            foreach ($languages as $lang) :
                $lang_opt = $lang_opt + [ $lang->id => $lang->description ];
            endforeach; 
        }

        $model = Strokes::findById($id);
        $attributes = [
            'category_id' => [
                'label' => 'Game Object',
                'type' => 'selectbox',
                'value' => $model->category_id,
                'option' => $category_opt
            ],
            'lang_id' => [
                'label' => 'Language',
                'type' => 'selectbox',
                'value' => $model->lang_id,
                'option' => $lang_opt
            ],
            'description' => [
                'label' => 'Description',
                'type' => 'text',
                'value' => $model->description
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'strokes';

        return view('strokes.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function update($id)
    {
        $input = Request::all();

        $model = Strokes::findById($id);
        $result = $model->setAttributesAndSave(array_merge($input, ['id' => $model->id]));
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/strokes/index');
        } else {
            return view('errors.error500');
        }
    }
}