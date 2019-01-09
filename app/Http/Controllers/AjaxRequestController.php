<?php

namespace App\Http\Controllers;

use App\Contestant;
use App\User;
use App\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxRequestController extends Controller
{

    public function validate_qr_code($contestant_id, $qr_code) {
        $contestants_data = Contestant::where('id', $contestant_id) -> first() -> toArray();
        $qr_code = User::where('qr-code', $qr_code) -> take(1) -> get() -> toArray();
        $response = array();

        if(!empty($qr_code)) {
            foreach($qr_code as $code) {
                $response['user_id'] = $code['id'];
                $response['qrCode'] = $code['qr-code'];
            }
        }

        $response['is_valid'] = !empty($qr_code) ? true : false;

        $response['contestant_id'] = $contestants_data['id'];
        $response['contestant_name'] = $contestants_data['name'];
        $response['contestant_type'] = $contestants_data['type'];
        return $response;

    }

    public function vote_up($user_id, $contestant_id) {
        $contestant_type = Contestant::where('id', $contestant_id) -> pluck('type') -> first();

        //this condition need two more logic for whole king and queen
        if(Vote::where('user_id', $user_id) -> count() >= 4) {
            return "Malicious Attack";
        }

        Vote::create([
            'user_id' => $user_id,
            'contestant_id' => $contestant_id
        ]);

        Session::put('status', 'logged_in');
        Session::put('user_id', $user_id);
        Session::push('contestant_ids', $contestant_id);
        Session::push('contestant_types', $contestant_type);
        Session::save();

        return "Success";

    }
}
