<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    {
        return view('db.index');
    }
    public function b2a()
    {
        $sql = 'select ab.bid, b.name, count(ab.aid) as caid
            from authors_books as ab
            left join books as b on ab.bid = b.id
            group by ab.bid
            having count(ab.aid) = 2';
        $data = \DB::select($sql);
        return view('db.res', ['data' => $data, 'sql' => $sql]);
    }
    public function bua()
    {
        $sql = 'select ab.bid, b.name 
            from authors_books as ab 
            left join books as b on ab.bid = b.id 
            where ab.aid in 
                (select aid as cbid from authors_books group by aid having count(bid) = 1)
            group by ab.bid';
        $data = \DB::select($sql);
        return view('db.res', ['data' => $data, 'sql' => $sql]);
    }
    public function aa7()
    {
        $sql = 'select ab.aid, a.name 
            from authors_books as ab 
            left join authors as a on ab.aid = a.id 
            where ab.bid in 
                (select bid from books as b 
                  left join comments as c on b.id = c.bid 
                  where b.id not in 
                    (select bid from comments where mark < 5) group by b.id having round(avg(c.mark), 1) > 7.0) 
            group by ab.aid';
        $data = \DB::select($sql);
        return view('db.res', ['data' => $data, 'sql' => $sql]);
    }
}
