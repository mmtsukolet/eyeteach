<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pronounce extends Model 
{
    protected $fillable = [
        'game_object_id', 'word_pronunce'
    ];
    protected $table = "pronunciation";

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
            $data = self::create($attributes);
            $success = ($data) ? 1 : 0;
            return compact('success', 'data', 'errors');
        } catch (Exception $e) {
            $errors = ['message' => $e->getMessage()];
            return compact('success', 'data', 'errors');
        }
    }

    public static function getResults($category_id, $lang_id){
        $sql = "SELECT p.* FROM pronunciation p
                INNER JOIN game_object g
                ON (p.game_object_id=g.id)
                WHERE g.category_id = '$category_id' 
                AND g.lang_id = '$lang_id'";
        $model = DB::select($sql); 
       
        if (!$model) 
            return array();
        else 
            return $model;
    }
}
