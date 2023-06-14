<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\ServiceSingle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    private $servicesingleController;
    private $servicesectionController;
    public function __construct(ServiceSectionController $servicesingleController, ServiceSectionController $servicesectionController)
    {
        $this->servicesingleController = $servicesingleController;
        $this->servicesectionController = $servicesectionController;
    }

    public function index()
    {
        $services = Service::orderBy('id', 'desc')->get();
        return view('dashboard.service.index', [
            'services'=>$services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);

        $service = new Service();
        $service->name = $request->name;
        $service->discription = $request->discription;
        $service->title = $request->title;
        if (!empty($request->file('video'))) {
            $img_name = Str::random(10) . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('/image/service'), $img_name);
            $service->video = '/image/service/' . $img_name;
        }
        if (!empty($request->file('second_video'))) {
            $img_name = Str::random(10) . '.' . $request->file('second_video')->getClientOriginalExtension();
            $request->file('second_video')->move(public_path('/image/service/secondvideo'), $img_name);
            $service->second_video = '/image/service/secondvideo/' . $img_name;
        }
        if(!isset($request['rooms'])){
            $request['rooms'] = [];
        }
        $service->atribute = $request->rooms;

        $service->save();
        return redirect()->route('dashboard.service.index');
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
        $service = Service::find($id);
        return view('dashboard.service.edit', [
            'service'=>$service
        ]);
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
        // dd($request->all());

        $service = Service::find($id);
        $service->name = $request->name;
        $service->discription = $request->discription;
        $service->title = $request->title;
        if (!empty($request->file('video'))) {
            if (is_file(public_path($service->video))) {
                unlink(public_path($service->video));
            }
            $img_name = Str::random(10) . '.' . $request->file('video')->getClientOriginalExtension();
            $request->file('video')->move(public_path('/image/service'), $img_name);
            $service->video = '/image/service/' . $img_name;
        }
        if (!empty($request->file('second_video'))) {
            if (is_file(public_path($service->second_video))) {
                unlink(public_path($service->second_video));
            }
            $img_name = Str::random(10) . '.' . $request->file('second_video')->getClientOriginalExtension();
            $request->file('second_video')->move(public_path('/image/service/secondvideo'), $img_name);
            $service->second_video = '/image/service/secondvideo/' . $img_name;
        }
        if(!isset($request['rooms'])){
            $request['rooms'] = [];
        }
        $service->atribute = $request->rooms;
        $service->save();
        return redirect()->route('dashboard.service.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if (is_file(public_path($service->video))) {
            unlink(public_path($service->video));
        }
        if (is_file(public_path($service->second_video))) {
            unlink(public_path($service->second_video));
        }

        foreach (ServiceSingle::where('service_id', $id)->get() as $prod){
            $this->servicesingleController->destroy($prod->id);
        }
        foreach (ServiceSection::where('service_id', $id)->get() as $prod){
            $this->servicesectionController->destroy($prod->id);
        }
        $service->delete();
        return back();
    }
}
