<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\GameCategory;
use App\GameCategoryDetail;

/**
 * Helpers
 */
use Illuminate\Http\Request as LaraRequest;

class CategoryController extends Controller
{
 	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $success = true;
        $data[] = array(
                    'category' => GameCategory::all(),
                    'category_detail' => GameCategoryDetail::all()
                );
        return compact('success', 'data');
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $success = true;
        $data = GameCategory::findById($id);
        return compact('success', 'data');
    }

    /**
     * Handles saving 
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $model = new GameCategory;
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
        $model = GameCategory::findById($id);
        $model->is_deleted = 1;
        $success = $model->save();
        
        echo json_encode(['success' => (boolean) $success]);
    }

}