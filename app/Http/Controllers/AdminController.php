<?php

namespace App\Http\Controllers;

use App\Contestant;
use App\Vote;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index() {
        //get all the data about fk & whole
        $fresher_kings = Contestant::where('type', 'fresher-king') -> get();
        $fresher_queens = Contestant::where('type', 'fresher-queen') -> get();
        $whole_kings = Contestant::where('type', 'whole-king') -> get();
        $whole_queens = Contestant::where('type', 'whole-queen') -> get();

        foreach($fresher_kings as $fresher_king) {
            $waist_number = $fresher_king['id'];
            $name = $fresher_king['name'];
            $vote_count =  Vote::where('contestant_id', $fresher_king['id']) -> count();
            $vote_counts[] = $vote_count;
            $fresher_kings_array[] = compact('waist_number','name', 'vote_count');
        }

        foreach($fresher_queens as $fresher_queen) {
            $waist_number = $fresher_queen['id'];
            $name = $fresher_queen['name'];
            $vote_count =  Vote::where('contestant_id', $fresher_queen['id']) -> count();
            $vote_counts[] = $vote_count;
            $fresher_queens_array[] = compact('waist_number','name', 'vote_count');
        }

        foreach($whole_kings as $whole_king) {
            $waist_number = $whole_king['id'];
            $name = $whole_king['name'];
            $vote_count =  Vote::where('contestant_id', $whole_king['id']) -> count();
            $vote_counts[] = $vote_count;
            $whole_kings_array[] = compact('waist_number','name', 'vote_count');
        }

        foreach($whole_queens as $whole_queen) {
            $waist_number = $whole_queen['id'];
            $name = $whole_queen['name'];
            $vote_count =  Vote::where('contestant_id', $whole_queen['id']) -> count();
            $vote_counts[] = $vote_count;
            $whole_queens_array[] = compact('waist_number','name', 'vote_count');
        }


        $contestants['fresher king'] = $fresher_kings_array;
        $contestants['fresher queen'] = $fresher_queens_array;
        $contestants['whole king'] = $whole_kings_array;
        $contestants['whole queen'] = $whole_queens_array;


        foreach($contestants as &$contestant) {
            usort($contestant, function($a, $b) {
                return $b['vote_count'] <=> $a['vote_count'];
            });
        }


        //contestants('fresher-king' => [....], 'fresher-queen' => [....] etc)

        return view('admin.index') -> with('results', $contestants);
    }
}
