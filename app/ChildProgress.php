<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildProgress extends Model 
{
    protected $fillable = [
        'id', 'child_id', 'activity_id',
        'object_id', 'played_game', 'progress_status','progress_mobile_id'
    ];

    protected $table = "child_progress";

    protected function getChildProgress($childId, $activityId, $status = 1)
    {
        /** @var status denotes correct/incorrect */
        $model = self::where('child_id', '=', $childId)
                       ->where('activity_id', '=', $activityId)
                       ->where('progress_status', '=', $status)->get();

        return $model;
    }

    public function scopegetByActivityAndChildId($query, $activity, $childId)
    {
        return self::where('activity_id',  '=', $activity)
                      ->where('child_id', '=', $childId)->get();
    }

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
            $success = ($data) ? $this->id : 0;
            return compact('success', 'data', 'errors');
        } catch (Exception $e) {
            $errors = ['message' => $e->getMessage()];
            return compact('success', 'data', 'errors');
        }
    }




}
