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
        $validatedData = $request->validate([
            'video' => 'required|mimes:mp4,avi,mov,wmv',
            'second_video' => 'required|mimes:mp4,avi,mov,wmv',
            'title' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'rooms' => 'nullable',
        ]);

        $service = new Service();
        $service->name = $validatedData['name'];
        $service->discription = $validatedData['discription'];
        $service->title = $validatedData['title'];
        if (!empty($validatedData['name'])){
                
            $validatedData['slug'] = str_replace(' ', '_', strtolower($validatedData['name'])) . '-' . Str::random(5);
        }
        if (!empty($validatedData['video'])) {
            $service->video_name = $validatedData['video']->getClientOriginalName();
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/service'), $img_name);
            $service->video = '/image/service/' . $img_name;
        }
        if (!empty($validatedData['second_video'])) {
            $img_name = Str::random(10) . '.' . $validatedData['second_video']->getClientOriginalExtension();
            $validatedData['second_video']->move(public_path('/image/service/secondvideo'), $img_name);
            $service->second_video = '/image/service/secondvideo/' . $img_name;
        }
        if(!isset($validatedData['rooms'])){
            $validatedData['rooms'] = [];
        }
        $service->slug = $validatedData['slug'];
        $service->atribute = $validatedData['rooms'];

        $service->save();
        return redirect()->route('dashboard.service.index')->with('success', 'Data uploaded successfully.');
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
        $validatedData = $request->validate([
            'video' => 'mimes:mp4,avi,mov,wmv',
            'second_video' => 'mimes:mp4,avi,mov,wmv',
            'title' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'rooms' => 'nullable',
        ]);

        $service = Service::find($id);
        $service->name = $validatedData['name'];
        $service->discription = $validatedData['discription'];
        $service->title = $validatedData['title'];
        if (!empty($validatedData['name'])){
                
            $validatedData['slug'] = str_replace(' ', '_', strtolower($validatedData['name'])) . '-' . Str::random(5);
        }
        if (!empty($validatedData['video'])) {
            $service->video_name = $validatedData['video']->getClientOriginalName();
            if (is_file(public_path($service->video))) {
                unlink(public_path($service->video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/service'), $img_name);
            $service->video = '/image/service/' . $img_name;
        }
        if (!empty($validatedData['second_video'])) {
            if (is_file(public_path($service->second_video))) {
                unlink(public_path($service->second_video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['second_video']->getClientOriginalExtension();
            $validatedData['second_video']->move(public_path('/image/service/secondvideo'), $img_name);
            $service->second_video = '/image/service/secondvideo/' . $img_name;
        }
        $service->slug = $validatedData['slug'];
        if(!isset($validatedData['rooms'])){
            $validatedData['rooms'] = [];
        }
        $service->atribute = $validatedData['rooms'];
        $service->save();
        return redirect()->route('dashboard.service.index')->with('success', 'Data updated successfully.');

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
        return back()->with('success', 'Data deleted.');
    }
}
