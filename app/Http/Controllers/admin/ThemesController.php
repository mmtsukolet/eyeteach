<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Themes;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;


class ThemesController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Themes::all();
            
        $theads = [
            'Id',
            'Name',
            'File Path',
            'Thumbnail Path',
            'Theme Song Name',
            'Theme Song Url',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) :
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'name' => $m->name,
                    'file_url' => $m->file_url,
                    'thumbnail_url' => $m->thumbnail_url,
                    'theme_song_name' => $m->theme_song_name,
                    'theme_song_url' => $m->theme_song_url
                ];
            }
        endforeach;

        $class = 'themes';

        return view('themes.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);

    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Themes::findById($id);
        return compact('success', 'data');
    }

    /**
     * Landing page for Create
     * @return [type] [description]
     */
    public function create()
    {
        $attributes = [
            'name' => [
                'label' => 'Name', 
                'type' => 'text'
            ],
            'file_url' => [
                'label' => 'File Path', 
                'value' => '', 
                'type' => 'file'
            ],
            'thumbnail_url' => [
                'label' => 'File Path', 
                'value' => '', 
                'type' => 'file'
            ],
            'theme_song_name' => [
                'label' => 'Theme Song Name', 
                'type' => 'text'
            ],
            'theme_song_url' => [
                'label' => 'Theme Song Url', 
                'value' => '', 
                'type' => 'file'
            ],
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'themes';

        return view('themes.create', ['data' => $attributes, 'class' => $class]);
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
        if (isset($input['file_url']))  {
            $input['file_url']->move(base_path('public') . "/uploads/", $input['file_url']->getFilename() . ".mp4");
            $file_path_url_ = $input['file_url']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = '';
        if (isset($input['thumbnail_url'])) {
            $input['thumbnail_url']->move(base_path('public') . "/uploads/", $input['thumbnail_url']->getFilename() . ".png");
            $thumbnail_url_ =  $input['thumbnail_url']->getFilename() . ".png";
        }

        $theme_song_url_ = '';
        if (isset($input['theme_song_url'])) {
            $input['theme_song_url']->move(base_path('public') . "/uploads/", $input['theme_song_url']->getFilename() . ".png");
            $theme_song_url_ =  $input['theme_song_url']->getFilename() . ".png";
        }

        $model = new Themes;
        $result = $model->setAttributesAndSave([
            'name' => $input['name'],
            'theme_song_name' => $input['theme_song_name'],
            'file_url' => $file_path_url_,
            'thumbnail_url' => $thumbnail_url_,
            'theme_song_url' => $theme_song_url_
        ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/themes/index');
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

        $model = Themes::findById($id);

    	$attributes = [
            'name' => [
                'label' => 'Name', 
                'type' => 'text',
                'value' => $model->name
            ],
            'file_url' => [
                'label' => 'File Path', 
                'value' =>  $model->file_url, 
                'type' => 'file'
            ],
            'thumbnail_url' => [
                'label' => 'File Path', 
                'value' => $model->thumbnail_url, 
                'type' => 'file'
            ],
            'theme_song_name' => [
                'label' => 'Theme Song Name', 
                'type' => 'text',
                'value' => $model->theme_song_name
            ],
            'theme_song_url' => [
                'label' => 'Theme Song Url', 
                'value' => $model->theme_song_url, 
                'type' => 'file'
            ],
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'themes';

        return view('themes.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function update($id)
    {
        $input = Request::all();

        $model = Themes::findById($id);

        /**
         * @todo  set mandatory fields
         */
        $file_path_url_ = $model->file_url;
        if (isset($input['file_url']))  {
            $input['file_url']->move(base_path('public') . "/uploads/", $input['file_url']->getFilename() . ".mp4");
            $file_path_url_ = $input['file_url']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = $model->thumbnail_url;
        if (isset($input['thumbnail_url'])) {
            $input['thumbnail_url']->move(base_path('public') . "/uploads/", $input['thumbnail_url']->getFilename() . ".png");
            $thumbnail_url_ =  $input['thumbnail_url']->getFilename() . ".png";
        }

        $theme_song_url_ = $model->theme_song_url;
        if (isset($input['theme_song_url'])) {
            $input['theme_song_url']->move(base_path('public') . "/uploads/", $input['theme_song_url']->getFilename() . ".png");
            $theme_song_url_ =  $input['theme_song_url']->getFilename() . ".png";
        }
        
        $result = $model->setAttributesAndSave([
            'id' => $model->id,
            'name' => $input['name'],
            'theme_song_name' => $input['theme_song_name'],
            'file_url' => $file_path_url_,
            'thumbnail_url' => $thumbnail_url_,
            'theme_song_url' => $theme_song_url_
        ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/themes/index');
        } else {
            return view('errors.error500');
        }
    }
}