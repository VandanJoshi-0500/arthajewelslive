<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Hash;
use Session;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\Log;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct() {
        $setting=Setting::first();
        $user = User::first();
        view()->share('setting', $setting);
    }
    public function dashboard(Request $req){
        $page = 'Admin Dashboard';
        $icon = 'dashboard.png';
        return view('admin.dashboard',compact('page','icon'));
    }
    public function logs(){
        $logs = Log::orderBy('id','Desc')->get();
        $page       = 'Logs';
        $icon       = 'logs.png';
        return view('admin.logs.logs',compact('logs','page','icon'));
    }
    public function edit_profile(){
        $userId = Auth::check() ? Auth::id() : true;
        $user=User::where('id',$userId)->first();
        $page       = 'Profile';
        $icon       = 'profile.png';
        if(Auth::user()->role == 1){
            return view('admin/profile/edit_profile',compact('user','page','icon'));
        }else{
            return view('agent/profile/edit_profile',compact('user','page','icon'));
        }
    }
    public function view_profile(){
        $userId     = Auth::check() ? Auth::id() : true;
        $user       = User::where('id',$userId)->first();
        $page       = 'Profile';
        $icon       = 'profile.png';
        if(Auth::user()->role == 1){
            return view('admin/profile/view_profile',compact('user','page','icon'));
        }else{
            return view('agent/profile/view_profile',compact('user','page','icon'));
        }
    }
}
