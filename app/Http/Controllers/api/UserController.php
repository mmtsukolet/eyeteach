<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\User;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

/**
 * `game_object`
 */
class UserController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $data = User::all();
        return compact('success', 'data');
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = User::findById($id);
        return compact('success', 'data');
    }

    public function store(){
        $input = Request::all();

        $success = 1;
        $errors = array();
        $data = User::where('email', $input['email'])
                    ->where('password', $input['password'])
                    ->first();

        if($data){

        }else{
            $model = new User;
            $result = $model->setAttributesAndSave($input);
            
            $success = $result['success'];
            $data = User::findById($result['data']);
            $errors = $result['errors'];
        }

        

        return compact('success', 'data', 'errors');
    }

    public function login(){
        $input = Request::all();

        $success = 1;
        $errors = array();
        $data = User::where('email', $input['email'])
                    ->where('password', $input['password'])
                    //->select('id')
                    ->first();
        $retData = 0;
        if(empty($data)){
            $retData = 0;
        }else{
            $retData = $data->id;
        }
                    
        return json_encode(compact('success', 'data', 'error'));
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit()
    {
    	echo json_encode(['success' => true, 'data' => 'this is for edit page.']);
    }

    public function delete($id)
    {
        $model = User::findById($id);
        $model->is_deleted = 1;
        $success = $model->save();

        echo json_encode(['success' => $success]);
    }
}