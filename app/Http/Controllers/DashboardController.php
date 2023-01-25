<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoriesCount = Category::count();
        $usersCount = User::count();
        return view('dashboard', ['book_count' => $bookCount, 'categories_count' => $categoriesCount, 'users_count' => $usersCount]);
    }
}
