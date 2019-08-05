<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class, 40)->create();
        factory(App\Book::class, 'book', 40)->create()->each(function ($book) {
            $book->comments()->saveMany(factory(App\Comment::class, 'comment', rand(1, 8))->make());
        });

        $books = App\Book::all();
        $comments = App\Comment::all();

        App\Author::all()->each(function ($user) use ($books) {
            $user->books()->attach(
                $books->random(rand(1, 6))->pluck('id')->toArray()
            );
        });

    }
}
