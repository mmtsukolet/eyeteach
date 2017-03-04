<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Questions;
use App\GameObject;
use App\GameCategory;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class QuestionsController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $model = Questions::all();

        $theads = [
            'Id',
            'Description', 
            'Answer',
            'Image Question Url',
            'Video Question Url',
            '',
            ''
        ];

        $tdata = [];
        foreach ($model as $m) {
            if (!$m->is_deleted) {
                $tdata[] = [
                    'id' => $m->id,
                    'qna_desc' => $m->qna_desc,
                    'qna_answer' => $m->qna_answer,
                    'qna_image_question' => $m->qna_image_question,
                    'qna_video_question' => $m->qna_video_question
                ];
            }
        }

        $class = 'questions';

        return view('videos.index', ['class' => $class, 'thead' => $theads, 'tdata' => $tdata]);
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = Questions::findById($id);
        return compact('success', 'data');
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit($id)
    {
    	$gameObj = GameObject::all();
        $game_opt = [];
        foreach ($gameObj as $m) {
            $game_opt = $game_opt + [ $m->id => $m->obj_name . " - " . GameCategory::findById($m->category_id)->category_name ];
        }

        $model = Questions::findById($id);
        $attributes = [
            'qna_desc' => ['label' => 'Description', 'value' => $model->qna_desc, 'type' => 'text'],
            'qna_answer' => [
                'label' => 'Answer',
                'type' => 'selectbox',
                'value' => $model->qna_answer,
                'option' => $game_opt
            ],
            'qna_image_question' => ['label' => 'Image Path', 'value' => $model->qna_image_question, 'type' => 'file'],
            'qna_video_question' => ['label' => 'Video Path', 'value' => $model->qna_video_question, 'type' => 'file']
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'questions';

        return view('questions.edit', ['data' => $attributes, 'class' => $class, 'id' => $id]);
    }

    public function create()
    {
        $gameObj = GameObject::all();
        $game_opt = [];
        foreach ($gameObj as $m) {
            $game_opt = $game_opt + [ $m->id => $m->obj_name . " - " . GameCategory::findById($m->category_id)->category_name ];
        }

        $attributes = [
            'qna_desc' => ['label' => 'Description', 'value' => '', 'type' => 'text'],
            'qna_answer' => [
                'label' => 'Answer',
                'type' => 'selectbox',
                'value' => '',
                'option' => $game_opt
            ],
            'qna_image_question' => ['label' => 'Image Path', 'value' => '', 'type' => 'file'],
            'qna_video_question' => ['label' => 'Video Path', 'value' => '', 'type' => 'file']
        ];

        $hidden = [];
        $select_boxes = [];
        $class = 'questions';

        return view('questions.create', ['data' => $attributes, 'class' => $class]);
    }

    public function store()
    {
        $input = Request::all();

        /**
         * @todo  set mandatory fields
         */
        $file_path_url_ = '';
        if (isset($input['qna_video_question']))  {
            $input['qna_video_question']->move(base_path('public') . "/uploads/", $input['qna_video_question']->getFilename() . ".mp4");
            $file_path_url_ = $input['qna_video_question']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = '';
        if (isset($input['qna_image_question'])) {
            $input['qna_image_question']->move(base_path('public') . "/uploads/", $input['qna_image_question']->getFilename() . ".png");
            $thumbnail_url_ =  $input['qna_image_question']->getFilename() . ".png";
        }

        $model = new Questions;
        $result = $model->setAttributesAndSave([
            'qna_desc' => $input['qna_desc'],
            'qna_answer' => $input['qna_answer'],
            'qna_image_question' => $thumbnail_url_,
            'qna_video_question' => $file_path_url_
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/questions/index');
        } else {
            return view('errors.error500');
        }
    }

    public function update($id)
    {
        $input = Request::all();

        $model = Questions::findById($id);

        /**
         * @todo  set mandatory fields
         */
        $file_path_url_ = $model->qna_video_question;
        if (isset($input['qna_video_question']))  {
            $input['qna_video_question']->move(base_path('public') . "/uploads/", $input['qna_video_question']->getFilename() . ".mp4");
            $file_path_url_ = $input['qna_video_question']->getFilename() . ".mp4";
        }

        /**
         * @todo  set as mandatory field
         */
        $thumbnail_url_ = $model->qna_image_question;
        if (isset($input['qna_image_question'])) {
            $input['qna_image_question']->move(base_path('public') . "/uploads/", $input['qna_image_question']->getFilename() . ".png");
            $thumbnail_url_ =  $input['qna_image_question']->getFilename() . ".png";
        }

        $result = $model->setAttributesAndSave([
            'id' => $model->id,
            'qna_desc' => $input['qna_desc'],
            'qna_answer' => $input['qna_answer'],
            'qna_image_question' => $thumbnail_url_,
            'qna_video_question' => $file_path_url_
         ]);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        if ($success) {
            return redirect('admin/questions/index');
        } else {
            return view('errors.error500');
        }
    }
}