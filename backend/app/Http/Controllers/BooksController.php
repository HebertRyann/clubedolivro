<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;
use App\Models\Reservation;
use Response;

class BooksController extends Controller
{
    public function index() {
        $list_Books = Books::all();
        return Response::json($list_Books, 200);
    }

    public function store(Request $request) {
        $list_Books = Books::all();
        $find_book = Books::where('name', '=' , $request->name)->first();

        if(count($list_Books) !== 0) {
            if($find_book) {
                return Response::json('This book already exist',400);
            } else {
                Books::create($request->all());
                return Response::json($request->all(),200);
            }; 
        } else {
            Books::create($request->all());
            return Response::json($request->all(),200); 
        }      
        
    }
    
    public function destroy($id) {
        $book = Books::findOrFail($id);
        $find_book = Reservation::where('book_name', '=', $book->name)->get();
        if($book) {
            if(!count($find_book)) {
                $book->delete();

                return Books::all();
            } else {
                return Response::json("This book cant delet because are reserved", 400);
            }
            
        } else {
            return Response::json("This book not exist", 400);
        }
    }
    public function find($id) {
        $book = Books::findOrFail($id);
        if($book) {
            return Response::json($book, 200);
            
        } else {
            return Response::json("This book not exist", 400);
        }
    }
        
}
