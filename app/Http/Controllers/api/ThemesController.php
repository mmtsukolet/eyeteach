<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Themes;

/**
 * Helpers
 */
use Illuminate\Http\Request as LaraRequest;


class ThemesController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $data = Themes::all();
        return compact('success', 'data');
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
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Themes::all();

        $model = new Strokes;
        $result = $model->setAttributesAndSave($input);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
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
        $model = Themes::findById($id);
        $model->is_deleted = 1;
        $success = $model->save();

        echo json_encode(['success' => $success]);
    }
}