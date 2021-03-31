<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriberRequest;
use App\Models\Category;
use App\Models\House;
use App\Models\Role;
use App\Models\User;
use App\Models\Infrastructure;
use App\Models\Subscriber;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $houses = House::with(['categories', 'infrastructures'])
            ->searchResults()

            ->paginate(12);

        $mapHouses = $houses->makeHidden(['available', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'photos', 'media']);
        $latitude = $houses->count() && (request()->filled('category') || request()->filled('search')) ? $houses->average('latitude') : 51.5073509;
        $longitude = $houses->count() && (request()->filled('category') || request()->filled('search')) ? $houses->average('longitude') : -0.12775829999998223;


        return view('welcome',compact('mapHouses','latitude','longitude','categories','houses'));
    }



    public function house(House $house)
    {
        $categories = Category::all();
        $house->load(['categories','infrastructures']) ;
        return view('house',compact('house','categories'));
    }
    public function booking(BookingRequest $request)
    {
        $data = array_merge($request->validated(), ['status' => 'processing']);
        $booking=Booking::create($data);
        return redirect()->back()->withStatus('Your house request is sent and is currently being processed');
    }

    public function owners()
    {

        $owners = User::whereHas('roles',function ($q){
            return $q->where('title','User');
        })->get();
        return view('owners',compact('owners'));

    }
    public function subscribe(StoreSubscriberRequest $request){
        $subscriber = Subscriber::create($request->all());
        return redirect()->route('welcome');
    }
}
