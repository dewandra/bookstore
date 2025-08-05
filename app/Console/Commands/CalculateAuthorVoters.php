<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateAuthorVoters extends Command
{
    protected $signature = 'authors:calculate-voters';
    protected $description = 'Calculate and update voter counts for all authors';

    public function handle()
    {
        $this->info('Calculating author voter counts (rating > 5)...');

        DB::table('authors')->update(['voter_count' => 0]);

        $stats = DB::table('ratings')
            ->join('books', 'ratings.book_id', '=', 'books.id')
            ->select('books.author_id', DB::raw('COUNT(ratings.id) as total_votes'))
            ->where('ratings.rating', '>', 5)
            ->groupBy('books.author_id')
            ->get();

        foreach ($stats as $stat) {
            DB::table('authors')
                ->where('id', $stat->author_id)
                ->update(['voter_count' => $stat->total_votes]);
        }

        $this->info('Finished calculating author voter counts.');
        return 0;
    }
}