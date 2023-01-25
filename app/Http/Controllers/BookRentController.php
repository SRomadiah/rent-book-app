<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('book-rent', ['users' => $users, 'books' => $books]);
    }
    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString();

        // membuat logika agar user hanya bisa meminjam buku dengan status instock
        $book = Book::findOrFail($request->book_id)->only('status');
        if ($book['status'] != 'in stock') {
            Session::flash('message', 'Book Not Available');
            Session::flash('alert-class', 'alert-danger');
            return redirect('book-rent');

            // melakukan pengecekan berapa kali user meminjam buku. 
            // jika lebih dari 3 dan blum di kembalikan (tidak boleh meminjam lagi)

        } else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();
            if ($count >= 3) {
                Session::flash('message', 'User has a limit in borrowing books');
                Session::flash('alert-class', 'alert-danger');
                return redirect('book-rent');
            } else {
                try {
                    DB::beginTransaction();
                    // process insert to rent_logs table
                    RentLogs::create($request->all());
                    // process update to book table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->save();
                    DB::commit();

                    Session::flash('message', 'Successfull Book Borrowed');
                    Session::flash('alert-class', 'alert-success');
                    return redirect('book-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }
    }
    public function returnBook()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('return-book', ['users' => $users, 'books' => $books]);
    }
    public function saveReturnBook(Request $request)
    {
        // user & buku yang di pili benar maka berhasil mengembalikan buku
        // user & buku yang di pilih salah bukan buku yang di pinjam user(message error)
        $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)
            ->where('actual_return_date', null);
        $rentData = $rent->first();
        $countData = $rent->count();
        if ($countData == 1) {
            $rentData->actual_return_date = Carbon::now()->toDateString();
            $rentData->save();
            Session::flash('message', 'The book returned successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect('return-book');
        } else {
            Session::flash('message', 'There is error in proccess');
            Session::flash('alert-class', 'alert-danger');
            return redirect('return-book');
        }
    }
}
