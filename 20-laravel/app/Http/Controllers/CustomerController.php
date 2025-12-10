<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{

    //myprofile
    public function myprofile()
    {
        $user = User::find(Auth::user()->id);
        //dd($user->toArray());
        return view("customer/myprofile")->with("user", $user);
    }
    public function updateprofile(Request $request)
    {

        $validation = $request->validate([
            'document' => ['required', 'numeric', 'unique:' . User::class . ',document,' . $request->id],
            'fullname' => ['required', 'string'],
            'gender' => ['required'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required'],
            'email' => ['required', 'lowercase', 'email', 'unique:' . User::class . ',email,' . $request->id],
        ]);
        if ($validation) {
            //dd($request->all());
            if ($request->hasFile('photo')) {
                $photo = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('images'), $photo);
                if ($request->originphoto != 'no-photo.png') {
                    unlink(public_path('images/') . $request->originphoto);
                }
            } else {
                $photo = $request->originphoto;
            }
        }

        $user = User::find($request->id);
        $user->document = $request->document;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        $user->photo = $photo;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($user->save()) {
            return redirect('dashboard')->with('message', 'My profile was successfully edited!.');
        }
    }

    //myadoptions
    public function myadoptions()
    {
        $adoptions = Adoption::where('user_id', Auth::user()->id)->get();
        return view("customer.myadoptions")->with("adopts", $adoptions);
    }
    public function showadoption(Request $request)
    {
        $adopt = Adoption::find($request->id);
        //dd($adopt->toArray());
        return view("customer.showadoption")->with("adopt", $adopt);
    }

    //make adoption
    public function listpets()
    {
        $pets = Pet::where('status', 0)->orderBy('id', 'desc')->paginate(10);
        return view('customer.makeadoptions')->with('pets', $pets);
    }
    public function confirmadoption(Request $request) {}
    public function makeadoption(Request $request)
    {
        return "Make adoptions";
    }
    public function search(Request $request)
    {
        $q = trim($request->input('q',''));
        $query = Pet::where('status', 0);
        if ($q !== '') {
            $query->where(function($qb) use ($q) {
                $qb->where('name', 'like', "%{$q}%")
                   ->orWhere('kind', 'like', "%{$q}%")
                   ->orWhere('breed', 'like', "%{$q}%")
                   ->orWhere('location', 'like', "%{$q}%");
            });
        }
        $pets = $query->orderBy('id','desc')->paginate(10);
        return view('pets.search')->with('pets', $pets);
    }
}
