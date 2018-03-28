<?php

namespace App\Http\Controllers;

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

class ApiUserContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $team_id = Auth::user()->currentTeam->id;

        $contacts = UserContact::select(\DB::raw('user_contacts.open_id, user_contacts.image, user_contacts.name, user_contacts.email, 
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
        $team_id = Auth::user()->currentTeam->id;
        $user_id = Auth::user()->id;

        $last_contact = UserContact::where('team_id', '=', $team_id)
                        ->orderBy('id', 'desc')
                        ->first();          //returns last latest row

        if ($last_contact) {
            $new_contact_number = $last_contact->open_id + 1;
        } else {
            $new_contact_number = 1;
        }

        $contact            = new UserContact;

        $contact->team_id   = $team_id;
        $contact->open_id   = $new_contact_number;

        $contact->name      = ucwords(strtolower($request->name));
        $contact->email     = strtolower($request->email);
        $contact->emails    = empty($request->emails) ? null : json_encode($request->emails); //

        $contact->phone     = empty($request->phone) ? null : $request->phone;
        $contact->contact1  = ucwords(strtolower($request->contact1));
        $contact->contact2  = ucwords(strtolower($request->contact2));

        $contact->currency_id   = empty($request->currency_id) ? 840 : $request->currency_id;
        $contact->payment_terms = empty($request->payment_terms) ? 15 : $request->payment_terms;

        $contact->bill_address1 = ucwords(strtolower($request->bill_address1));
        $contact->bill_address2 = ucwords(strtolower($request->bill_address2));

        $contact->bill_city         = ucwords(strtolower($request->bill_city));
        $contact->bill_state        = ucwords(strtolower($request->bill_state));
        $contact->bill_postal_code  = $request->bill_postal_code;
        $contact->bill_country_id   = $request->bill_country_id;

        $contact->ship_phone        = $request->ship_phone;
        $contact->ship_contact      = ucwords(strtolower($request->ship_contact));
        $contact->ship_address1     = ucwords(strtolower($request->ship_address1));
        $contact->ship_address2     = ucwords(strtolower($request->ship_address2));
        $contact->ship_city         = ucwords(strtolower($request->ship_city));
        $contact->ship_state        = $request->ship_state;
        $contact->ship_postal_code  = $request->ship_postal_code;
        $contact->ship_country_id   = $request->ship_country_id;
        $contact->instructions      = $request->instructions;

        $contact->account_no        = $request->account_no;
        $contact->id_no             = $request->id_no;
        $contact->vat_no            = $request->vat_no;
        $contact->fax_no            = $request->fax_no;
        $contact->mobile_no         = $request->mobile_no;
        $contact->toll_free_no      = $request->toll_free_no;
        $contact->website           = strtolower($request->website);
        //gst_code
        $contact->gst_code          = empty($request->gst_code) ? null : $request->gst_code;

        $contact->created_by_id     = $user_id;
        $contact->modified_by_id    = $user_id;

        $contact->save();

        if ($contact->id) {

            $optimus = new Optimus(1985855171, 1276010987, 448363082);
            $encrypt_id = $optimus->encode($contact->id);

            $contact_images_folder = storage_path('app/public/contacts/images/');

            //image generation
            if($request->image){

                $avatar = $request->image;
            }
            else {

                $avatar = Avatar::create($contact->name)->toBase64();

            }

            $img    = Image::make($avatar);

            if($img) {

                // resize the image to a width of 300 and constrain aspect ratio (auto height)
                $img->resize(150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // save file as jpg with medium quality
                $img->save($contact_images_folder . $encrypt_id . '.png', 90);

            }
            else{
                $encrypt_id = 'default';
            }

            $contact->image = "/storage/contacts/images/" . $encrypt_id . ".png";//$request->image;
            $contact->save();

        }

        return response()->json($contact);

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
        $team_id = Auth::user()->currentTeam->id;
        $user_id = Auth::user()->id;

        $contact = UserContact::where('team_id', '=', $team_id)
            ->where('open_id', '=', $id)
            ->first();

        $contact->emails = json_decode($contact->emails);

        return response()->json($contact);
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
        $team_id = Auth::user()->currentTeam->id;
        $user_id = Auth::user()->id;

        $contact = UserContact::where('team_id', '=', $team_id)
            ->where('open_id', '=', $id)
            ->first();

        if($contact) {

            $contact->name = ucwords(strtolower($request->name));
            $contact->email = strtolower($request->email);
            $contact->emails = empty($request->emails) ? null : json_encode($request->emails); //

            $contact->phone = $request->phone;
            $contact->contact1 = ucwords(strtolower($request->contact1));
            $contact->contact2 = ucwords(strtolower($request->contact2));

            $contact->currency_id = $request->currency_id;
            $contact->payment_terms = $request->payment_terms;

            $contact->bill_address1 = ucwords(strtolower($request->bill_address1));
            $contact->bill_address2 = ucwords(strtolower($request->bill_address2));

            $contact->bill_city = ucwords(strtolower($request->bill_city));
            $contact->bill_state = ucwords(strtolower($request->bill_state));
            $contact->bill_postal_code = $request->bill_postal_code;
            $contact->bill_country_id = $request->bill_country_id;

            $contact->ship_phone = $request->ship_phone;
            $contact->ship_contact = ucwords(strtolower($request->ship_contact));
            $contact->ship_address1 = ucwords(strtolower($request->ship_address1));
            $contact->ship_address2 = ucwords(strtolower($request->ship_address2));
            $contact->ship_city = ucwords(strtolower($request->ship_city));
            $contact->ship_state = ucwords(strtolower($request->ship_state));
            $contact->ship_postal_code = $request->ship_postal_code;
            $contact->ship_country_id = $request->ship_country_id;
            $contact->instructions = $request->instructions;

            $contact->account_no = $request->account_no;
            $contact->id_no = $request->id_no;
            $contact->vat_no = $request->vat_no;
            $contact->fax_no = $request->fax_no;
            $contact->mobile_no = $request->mobile_no;
            $contact->toll_free_no = $request->toll_free_no;
            $contact->website = strtolower($request->website);

            $contact->gst_code = empty($request->gst_code) ? null : $request->gst_code;

            //image update start

            if(substr($request->image, 0, 4) == 'data'){

                $optimus = new Optimus(1985855171, 1276010987, 448363082);
                $encrypt_id = $optimus->encode($contact->id);

                //delete previous image
                Storage::delete('/public/contacts/images/' . $encrypt_id . '.png');

                $contact_images_folder = storage_path('app/public/contacts/images/');

                $avatar = $request->image;

                $img = Image::make($avatar);

                if ($img) {

                    // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $img->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    // save file as jpg with medium quality
                    $img->save($contact_images_folder . $encrypt_id . '.png', 90);

                } else {
                    $encrypt_id = 'default';
                }

                $contact->image = "/storage/contacts/images/" . $encrypt_id . ".png";//$request->image;

            }
            //end of image update

            $contact->modified_by_id = $user_id;

            $contact->save();

            return response()->json(true);

        }
        else {
            return response()->json(false);
        }

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
        $user_id = Auth::user()->id;
        $team_id = Auth::user()->currentTeam->id;

        $contact = UserContact::where('team_id', '=', $team_id)
            ->where('open_id', '=', $id)
            ->first();

        if ($contact) {

            $optimus    = new Optimus(1985855171, 1276010987, 448363082);
            $encrypt_id = $optimus->encode($contact->id);

            Storage::delete('/public/contacts/images/' . $encrypt_id . '.png');

            $contact_id                 = $contact->id;
            $contact->modified_by_id    = $user_id;   //user who deleted the contact
            $contact->save();
            UserContact::find($contact_id)->delete();
        }


    }
}
