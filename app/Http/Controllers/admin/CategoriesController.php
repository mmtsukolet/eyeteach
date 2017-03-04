<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\GameCategory;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class CategoriesController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = GameCategory::all();

        $theads = [
            'Id',
            'Name',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'category_name' => $m->category_name
                ];
            }
        endforeach;

        $class = 'categories';

        return view('categories.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
        
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = GameCategory::findById($id);
        return compact('success', 'data');
    }

    /**
     * Landing page for Create
     * @return [type] [description]
     */
    public function create()
    {
        $attributes = [
            'category_name' => [
                'label' => 'Category Name', 
                'value' => '', 
                'type' => 'text'
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'categories';

        return view('categories.create', ['data' => $attributes, 'class' => $class]);
    }

     /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();
        
        $model = new GameCategory;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/categories/index');
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
        $model = GameCategory::findById($id);
    	$attributes = [
            'category_name' => [
                'label' => 'Category Name', 
                'value' => $model->id, 
                'type' => 'text'
            ]
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'categories';

        return view('categories.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function update($id)
    {
        $input = Request::all();
        
        $model = new GameCategory;
        $result = $model->setAttributesAndSave(array_merge($input, ['id' =>$id]));
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/categories/index');
        } else {
            return view('errors.error500');
        }
    }
}