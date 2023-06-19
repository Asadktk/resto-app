<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }



public function show(Category $category) {
    $menus = Menu::where('category_id', $category->id)->get();
    $categories = Category::all();

    return view('categories.show', compact('category', 'menus', 'categories'));
}

    
    
}
