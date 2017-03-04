<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Pronounce;
use App\GameCategory;
use App\GameObject;
use App\Language;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class PronounceController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Pronounce::all();

        $theads = [
            'Id',
            'Game Object', 
            'Word Pronounce',
            '', ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'game_object_id' => GameObject::findById($m->game_object_id)->getModel()->obj_name,
                    'word_pronunce' => $m->word_pronunce
                ];
            }
        endforeach;

        $class = 'pronounce';

        return view('pronounce.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Pronounce::findById($id);
        return compact('success', 'data');
    }

    public function store()
    {
        $input = Request::all();

        $model = new Pronounce;
        $result = $model->setAttributesAndSave([
            'game_object_id' => $input['game_object_id'],
            'word_pronunce' => $input['word_pronunce']
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/pronounce/index');
        } else {
            return view('errors.error500');
        }
    }

    public function create()
    {
        $attributes = [
            'game_object_id' => ['label' => 'Game Object', 'value' => '', 'type' => 'text'],
            'word_pronunce' => ['label' => 'Word Pronounce', 'value' => '', 'type' => 'textarea']
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'pronounce';

        return view('pronounce.create', ['data' => $attributes, 'class' => $class]);
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit($id)
    {
        $model = Pronounce::findById($id);

        $categories = GameCategory::all();
        $category_opt = [];
        if (!empty($categories)) {
            foreach ($categories as $category) :
                $category_opt = $category_opt + [$category->id => $category->category_name];           
            endforeach;
        }

    	$attributes = [
            'category_id' => [
                'label' => 'Categories',
                'type' => 'selectbox',
                'value' => $model->category_id,
                'option' => $category_opt
            ],
            'word_pronunce' => ['label' => 'Word Pronounce', 'value' => $model->word_pronunce, 'type' => 'textarea']
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'pronounce';

        return view('pronounce.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function update($id)
    {
        $input = Request::all();

        $model = Pronounce::findById($id);
        $result = $model->setAttributesAndSave([
            'id' => $id,
            'game_object_id' => $input['game_object_id'],
            'word_pronunce' => $input['word_pronunce']
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/pronounce/index');
        } else {
            return view('errors.error500');
        }
    }
}