<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\GameObject;
use App\GameCategory;
use App\Language;
use App\Themes;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;


class GameController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = GameObject::all();
        
        $theads = [
            'Id',
            'Category',
            'Language',  
            'Theme',  
            'Name',
            'Path',
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
                    'theme_id' => Themes::findById($m->theme_id)->name,
                    'name' => $m->obj_name,
                    'obj_image_path' => $m->obj_image_path

                ];
            }
        endforeach;

        $class = 'game';

        return view('games.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);

    }

    /**
     * Load create page
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

        $themes = Themes::all();
        $themes_opt = [];
        if (!empty($themes)) {
            foreach ($themes as $theme) {
                $themes_opt = $themes_opt + [$theme->id => $theme->name];
            }
        }

        $attributes = [
            'category_id' => [
                'label' => 'Categories',
                'type' => 'selectbox',
                'value' => '',
                'option' => $category_opt
            ],
            'lang_id' => [
                'label' => 'Languages',
                'type' => 'selectbox',
                'value' => '',
                'option' => $lang_opt
            ],
            'theme_id' => [
                'label' => 'Themes',
                'type' => 'selectbox',
                'value' => '',
                'option' => $themes_opt
            ],
            'obj_name' => [
                'label' => 'Game Object Name',
                'type' => 'text',
                'value' => ''
            ],
            'obj_desc' => [
                'label' => 'Game Object Description',
                'type' => 'text',
                'value' => ''
            ],
            'obj_image_path' => ['label' => 'Image Path', 'value' => '', 'type' => 'file'],
            
        ];

        $hidden = [];

        $class = 'game';

        return view('games.create', ['data' => $attributes, 'class' => $class]);
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $thumbnail_url_ = '';
        if (isset($input['obj_image_path'])) {
            $input['obj_image_path']->move(base_path('public') . "/uploads/", $input['obj_image_path']->getFilename() . ".png");
            $thumbnail_url_ =  $input['obj_image_path']->getFilename() . ".png";
        }

        $model = new GameObject;
        $result = $model->setAttributesAndSave([
            'category_id' => $input['category_id'],
            'lang_id' => $input['lang_id'],
            'theme_id' => $input['theme_id'],
            'obj_name' => $input['obj_name'],
            'obj_desc' => $input['obj_desc'],
            'obj_image_path' => $thumbnail_url_
        ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/game/index');
        } else {
            return view('errors.error500');
        }
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = GameObject::findById($id);
        return compact('success', 'data');
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

        $themes = Themes::all();
        $themes_opt = [];
        if (!empty($themes)) {
            foreach ($themes as $theme) {
                $themes_opt = $themes_opt + [$theme->id => $theme->name];
            }
        }

        $model = GameObject::findById($id);

        $attributes = [
            'category_id' => [
                'label' => 'Categories',
                'type' => 'selectbox',
                'value' => $model->category_id,
                'option' => $category_opt
            ],
            'lang_id' => [
                'label' => 'Languages',
                'type' => 'selectbox',
                'value' => $model->lang_id,
                'option' => $lang_opt
            ],
            'theme_id' => [
                'label' => 'Themes',
                'type' => 'selectbox',
                'value' => $model->theme_id,
                'option' => $themes_opt
            ],
            'obj_name' => [
                'label' => 'Game Object Name',
                'type' => 'text',
                'value' => $model->obj_name
            ],
            'obj_desc' => [
                'label' => 'Game Object Description',
                'type' => 'text',
                'value' => $model->obj_desc
            ],
            'obj_image_path' => ['label' => 'Image Path', 'value' => $model->obj_image_path, 'type' => 'file'],
            
        ];

        $hidden = [];

        $class = 'game';

        return view('games.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function update($id)
    {
        $input = Request::all();

        $model = GameObject::findById($id);

        $thumbnail_url_ = $model->obj_image_path;
        if (isset($input['obj_image_path'])) {
            $input['obj_image_path']->move(base_path('public') . "/uploads/", $input['obj_image_path']->getFilename() . ".png");
            $thumbnail_url_ =  $input['obj_image_path']->getFilename() . ".png";
        }

        $result = $model->setAttributesAndSave([
            'id' => $model->id,
            'category_id' => $input['category_id'],
            'lang_id' => $input['lang_id'],
            'theme_id' => $input['theme_id'],
            'obj_name' => $input['obj_name'],
            'obj_desc' => $input['obj_desc'],
            'obj_image_path' => $thumbnail_url_
        ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/game/index');
        } else {
            return view('errors.error500');
        }
    }
}