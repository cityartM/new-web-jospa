<?php

namespace App\Http\Controllers;

use App\Models\HomeBookService;
use App\Models\ServiceHome;
use App\Models\StaffHome;
use Illuminate\Http\Request;
use App\Models\ServiceGroupHome;
use Modules\Package\Models\Package;
use Modules\Package\Models\PackageService;
use Illuminate\Support\Facades\DB;

class SaloneBookController extends Controller
{


public function show($id)
    {
        // جلب بيانات الباكيج
        $package = DB::table('packages')->where('id', $id)->first();

        if (!$package) {
            abort(404, 'Package not found');
        }

        // جلب الخدمات المرتبطة بالباكيج مع تفاصيل كل خدمة
        $services = DB::table('package_services')
            ->join('services', 'package_services.service_id', '=', 'services.id')
            ->select(
                'package_services.id as package_service_id',
                'package_services.service_price',
                'package_services.discounted_price',
                'services.id as service_id',
                'services.name as service_name',
                'services.duration_min',
                'services.default_price'
            )
            ->where('package_services.package_id', $id)
            ->get();

        // حساب مجموع أسعار الخدمات
        $totalServicePrice = $services->sum('service_price');
        $totalService = $services->sum('discounted_price');

        // إرجاع البيانات للـ view
        return view('home.details', compact('package', 'services', 'totalServicePrice','totalService'));
    }
    
    
    public function index()
    {
        return response()->json(StaffHome::all());
    }

    public function getServiceGroups($gender)
    {
        $groups = ServiceGroupHome::where('gender', $gender)->get();

        return response()->json($groups);
    }

    public function getServicesByGroup($serviceGroupId)
    {
        $services = ServiceHome::where('service_group_homes_id', $serviceGroupId)->get();

        return response()->json($services);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'mobile_no'         => 'required|string|max:20',
            'neighborhood'      => 'required|string|max:255',
            'gender'            => 'required|in:men,women',
            'service_group_id'  => 'required|exists:service_group_homes,id',
            'service_id'        => 'required|exists:service_homes,id',
            'date'              => 'required|date',
            'time'              => 'required|string',
            'staff_id'          => 'required|exists:staff_homes,id',
        ]);
        
        $data['type'] = 'salon';

        HomeBookService::create($data);

        return response()->json(['message' => 'Booking saved successfully']);
    }

}
