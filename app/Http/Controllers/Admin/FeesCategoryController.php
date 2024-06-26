<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeesCategory;
use App\Models\FeesTypeMaster;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class FeesCategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_fees_category', 1);
        $this->route = 'admin.fees-category';
        $this->view = 'admin.fees-category';
        $this->path = 'fees-category';
        $this->access = 'fees-category';


        $this->middleware('permission:'.$this->access.'-view|'.$this->access.'-create|'.$this->access.'-edit|'.$this->access.'-delete', ['only' => ['index','show']]);
        $this->middleware('permission:'.$this->access.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.$this->access.'-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:'.$this->access.'-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $data['access'] = $this->access;
        
        $data['rows'] = FeesCategory::orderBy('title', 'asc')->get();
        $data['departments'] = Department::where('status', 1)->orderBy('title', 'asc')->get();

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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:fees_categories,title',
        ]);
        $text = trim($_POST['title']);
        $textAr = explode("\r\n", $text);
        $titles = array_filter($textAr, 'trim');

        foreach ($titles as $title) {
            //check record in DB
            $existName = FeesCategory::where('title', $title)->first();
            if(!$existName){
                // Insert Data if name does not exist
                $feesCategory = new FeesCategory;
                $feesCategory->title = $title;
                $feesCategory->department_id = $request->department_id;
                $feesCategory->amount = $request->amount;
                $feesCategory->slug = Str::slug($title, '-');
                $feesCategory->description = $request->description;
                $feesCategory->save();
            }
        }
       


        Toastr::success(__('msg_created_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(FeesCategory $feesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesCategory $feesCategory)
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
    public function update(Request $request, FeesCategory $feesCategory)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:fees_categories,title,'.$feesCategory->id,
        ]);

        // Update Data
        $feesCategory->title = $request->title;
        $feesCategory->slug = Str::slug($request->title, '-');
        $feesCategory->department_id = $request->department_id;
        $feesCategory->description = $request->description;
        $feesCategory->status = $request->status;
        $feesCategory->amount = $request->amount;
        $feesCategory->save();


        Toastr::success(__('msg_updated_successfully'), __('msg_success'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesCategory $feesCategory)
    {
        // Delete Data
        $associated = FeesTypeMaster::where('fees_type_id',$feesCategory->id)->first();
        if($associated){
            Toastr::error(__('msg_cant_deleted'), __('msg_error'));
            return redirect()->back();
        }
        $feesCategory->delete();

        Toastr::success(__('msg_deleted_successfully'), __('msg_success'));

        return redirect()->back();
    }
}
