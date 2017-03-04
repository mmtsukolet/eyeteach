<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model 
{
    protected $fillable = [
        'id', 'qna_desc', 'qna_answer',
        'qna_image_question', 'qna_video_question'
    ];
    protected $table = "questions_and_answers";

    /**
     * Return details by id
     * @param  [type] $query [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function scopefindById($query, $id)
    {
        $model = self::where('id', $id)->first();
        if (!$model) 
            return false;
        else 
            return $model;
    }

    /**
     * Checks if attributes is valid
     * @param  [type]  $attr [description]
     * @return boolean       [description]
     */
    public function hasAttribute($attr)
    {
        return in_array($attr, $this->getFillable());
    }

     /**
     * Handles New saving records
     * @param [type] $attributes [description]
     */
    public function setAttributesAndSave($attributes)
    {
        $errors = [];
        $data = [];
        $success = false;

        foreach ($attributes as $key => $value) {
            if ($this->hasAttribute($key) === FALSE) 
                $errors[] = ['message' => "`{$key}`" . " column does not exist."];
        }

        if (!empty($errors)) {
            return compact('success', 'data', 'errors');
        }

        try {
            $this->fill($attributes);
            $data = $this->save($attributes);
            $success = ($data) ? 1 : 0;
            return compact('success', 'data', 'errors');
        } catch (Exception $e) {
            $errors = ['message' => $e->getMessage()];
            return compact('success', 'data', 'errors');
        }
    }

    public static function getResults($category_id, $lang_id){
        $model = self::join('game_object', 'questions_and_answers.qna_answer', '=', 'game_object.id')
                ->where('lang_id', '=', $lang_id)
                ->where('category_id', '=', $category_id)
                ->select(
                            'questions_and_answers.id', 
                            'questions_and_answers.qna_desc', 
                            'questions_and_answers.qna_answer', 
                            'questions_and_answers.qna_image_question', 
                            'questions_and_answers.qna_video_question'
                        )
                ->get(); 
       
        if (!$model) 
            return false;
        else 
            return $model;
    }
}
