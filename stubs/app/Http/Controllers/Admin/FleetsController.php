<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Fleets;
use App\User;
use Illuminate\Http\Request;
use Toastr;
class FleetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
     public function __construct()
     {
         // Module Data
         $this->title = trans_choice('module_vehicle', 1);
         $this->route = 'admin.fleets';
         $this->view = 'admin.fleets';
         $this->path = 'fleets';
         $this->access = 'fleets';
 
 
         $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete|'.$this->access.'-card', ['only' => ['index','show','status','sendPassword']]);
         $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
         $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update','status']]);
         $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
     }
    public function index()
    {

        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        $data['statuses'] = Fleets::STATUSES;
        $fleet= Fleets::query();
        $data['rows'] = $fleet->orderBy('id', 'desc')->get();

        return view($this->view.'.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // try {
          
            $data['title'] = $this->title;
            $data['route'] = $this->route;
            $data['view'] = $this->view;
            $data['path'] = $this->path;
            $data['access'] = $this->access;
            $data['statuses'] = Fleets::STATUSES;
            // $users = User::query();
            $role = Role::where('name','Driver')->first();
            
            $data['users'] = User::where('status', '1')
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'driver');
            })
            ->get();
            return view($this->view.'.create', $data);
        // } catch(\Exception $e){

            Toastr::error(__('msg_error'));

            return redirect()->back();
        // } 
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

        //    return $request->all();
        // Insert Data
        $fleet = new Fleets;
        $fleet->name = $request->name;
        $fleet->plate_no = $request->plate_no;
        $fleet->status = $request->status;
        $fleet->driver_id  = $request->driver_id ;
        $fleet->save();
        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fleets  $fleets
     * @return \Illuminate\Http\Response
     */
    public function show(Fleets $fleet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fleets  $fleets
     * @return \Illuminate\Http\Response
     */
    public function edit(Fleets $fleet)
    {
        //
        try {
            $data['title'] = $this->title;
            $data['route'] = $this->route;
            $data['view'] = $this->view;
            $data['path'] = $this->path;
            $data['access'] = $this->access;
            $data['statuses'] = Fleets::STATUSES;
            $role = Role::where('name','Driver')->first();
            $data['users'] = User::where('status', '1')
            ->with('roles')
            ->whereHas('roles', function ($query) {
                $query->where('slug', 'driver');
            })
            ->get();
            $data['row'] = $fleet;
            return view($this->view.'.edit', $data);
        } catch(\Exception $e){

            Toastr::error(__('msg_updated_successfully'), __('msg_error'));

            return redirect()->back();
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fleets  $fleets
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fleets $fleet)
    {
        //
        try{

        $fleet->name = $request->name;
        $fleet->plate_no = $request->plate_no;
        $fleet->status = $request->status;
        $fleet->driver_id  = $request->driver_id ;

        $fleet->save();
        Toastr::success(__('msg_updated_successfully'), __('msg_success'));
        return redirect('admin/fleets')->with( __('msg_success'), __('msg_updated_successfully'));
        }
        catch(\Exception $e){

            Toastr::error(__('msg_updated_error'), __('msg_error'));

            return redirect()->back();
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fleets  $fleets
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $fleet = Fleets::find($id);
            if ($fleet) {
                 $fleet->delete();
            }
            Toastr::success(__('msg_deleted_successfully'), __('msg_success'));
            return redirect()->back();
        }catch(\Exception $e){

            Toastr::error(__('msg_deleted_fail'), __('msg_error'));

            return redirect()->back();
        }
    }
}
