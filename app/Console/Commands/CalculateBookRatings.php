<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateBookRatings extends Command
{
    protected $signature = 'books:calculate-ratings';
    protected $description = 'Calculate and update average ratings and voter counts for all books';

    public function handle()
    {
        $this->info('Calculating book ratings and voter counts...');

        $stats = DB::table('ratings')
            ->select(
                'book_id',
                DB::raw('AVG(rating) as ratings_avg'),
                DB::raw('COUNT(id) as voter_count')
            )
            ->groupBy('book_id')
            ->get();

        foreach ($stats->chunk(1000) as $chunk) {
            $cases = [];
            $voterCases = [];
            $ids = [];

            foreach ($chunk as $stat) {
                $cases[] = "WHEN {$stat->book_id} THEN {$stat->ratings_avg}";
                $voterCases[] = "WHEN {$stat->book_id} THEN {$stat->voter_count}";
                $ids[] = $stat->book_id;
            }

            $caseSql = "CASE id " . implode(' ', $cases) . " END";
            $voterCaseSql = "CASE id " . implode(' ', $voterCases) . " END";

            DB::table('books')
                ->whereIn('id', $ids)
                ->update([
                    'ratings_avg' => DB::raw($caseSql),
                    'voter_count' => DB::raw($voterCaseSql)
                ]);
        }

        $this->info('Finished calculating ratings.');
        return 0;
    }
}