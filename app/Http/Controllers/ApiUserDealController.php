<?php

namespace App\Http\Controllers;

use App\UserDeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Optimus\Optimus;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use Laravolt\Avatar\Facade as Avatar;

use Carbon\Carbon;
use DataTables;
use Html;
use Excel;

use App\UserContact;
use App\Countries;

class ApiUserDealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team_id = Auth::user()->currentTeam->id;

        $contacts = UserDeal::select(\DB::raw('user_contacts.open_id, user_contacts.image, user_contacts.name, user_contacts.email, 
        user_contacts.phone, user_contacts.contact1'))
            ->where('user_contacts.team_id', $team_id)
            ->orderBy('user_contacts.open_id','desc')
            ->get();


        return DataTables::of($contacts)
            ->editColumn('image', function ($model) {
                //return '<img src=\'https://www.datatables.net/media/images/nav-dt.png\' style=\'height:30px; width:30px\'>';
                return '<img src="'.$model->image.'" style="height:25px; width:25px" />';
            })
            ->addColumn('action', function ($model) {
                return '
                <a type="button" class="btn btn-xs btn-primary" onclick="editContact('. $model->open_id .');">
                <i class="glyphicon glyphicon-edit"></i></a>
                <a type="button" class="btn btn-xs btn-danger" onclick="deleteContact('. $model->open_id .');">
                <i class="glyphicon glyphicon-trash"></i></a>
                ';
            })
            ->rawColumns(['image','action'])
            //->parameters()
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
