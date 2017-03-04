<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Videos;
use App\GameCategory;
use App\Language;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

class VideosController extends Controller
{   
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Videos::all();
        
        $theads = [
            'Id',
            'Category', 
            'language',
            'Name',
            'File Path',
            'Thumbnail Path',
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
                    'name' => $m->file_name,
                    'file_url' =>  $m->file_path,
                    'thumbnail_url' => $m->image_path
                ];
            }
        endforeach;

        $class = 'videos';

        return view('videos.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Videos::findById($id);
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

        $model = Videos::findById($id);

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
            'file_name' => ['label' => 'Name', 'value' => $model->file_name, 'type' => 'text'],
            'file_path' => ['label' => 'File Path', 'value' => $model->file_path, 'type' => 'file'],
            'image_path' => ['label' => 'Thumbnail Url', 'value' => $model->image_path, 'type' => 'file'],
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'videos';

        return view('videos.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        /**
         * @todo  set mandatory fields
         */
        $file_path_url_ = '';
        if (isset($input['file_path']))  {
            $input['file_path']->move(base_path('public') . "/uploads/", $input['file_path']->getFilename() . ".mp4");
            $file_path_url_ = $input['file_path']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = '';
        if (isset($input['image_path'])) {
            $input['image_path']->move(base_path('public') . "/uploads/", $input['image_path']->getFilename() . ".png");
            $thumbnail_url_ =  $input['image_path']->getFilename() . ".png";
        }

        $model = new Videos;
        $result = $model->setAttributesAndSave([
            'file_name' => $input['file_name'],
            'file_path' => $file_path_url_,
            'image_path' => $thumbnail_url_,
            'category_id' => $input['category_id'],
            'lang_id' => $input['lang_id']
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/videos/index');
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
            'file_name' => ['label' => 'Name', 'value' => '', 'type' => 'text'],
            'file_path' => ['label' => 'File Path', 'value' => '', 'type' => 'file'],
            'image_path' => ['label' => 'Thumbnail Url', 'value' => '', 'type' => 'file'],
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'videos';

        return view('videos.create', ['data' => $attributes, 'class' => $class]);
    }

    public function update($id)
    {
        $input = Request::all();

        /**
         * @todo  set mandatory fields
         */
        $file_path_url_ = '';
        if (isset($input['file_path']))  {
            $input['file_path']->move(base_path('public') . "/uploads/", $input['file_path']->getFilename() . ".mp4");
            $file_path_url_ = $input['file_path']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = '';
        if (isset($input['image_path'])) {
            $input['image_path']->move(base_path('public') . "/uploads/", $input['image_path']->getFilename() . ".png");
            $thumbnail_url_ =  $input['image_path']->getFilename() . ".png";
        }

        $model = Videos::findById($id);
        $result = $model->setAttributesAndSave([
            'id' => $id,
            'file_name' => $input['file_name'],
            'file_path' => $file_path_url_,
            'image_path' => $thumbnail_url_,
            'category_id' => $input['category_id'],
            'lang_id' => $input['lang_id']
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/videos/index');
        } else {
            return view('errors.error500');
        }
    }
}