<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\Region;
use App\UseCases\Auth\RegisterService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use function Symfony\Component\Debug\Tests\testHeader;

/**
 * Class UsersController
 * @package App\Http\Controllers\Admin
 * @property User $user
 */

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $regions = Region::where('parent_id',null)->orderBy('name')->get();

        return view('admin.regions.index',compact('regions'));
    }


    public function create(Request $request)
    {
        $parent = null;

        if($request->get('parent')){
            $parent = Region::findOrFail($request->get('parent'));
        }

        return view('admin.regions.create',compact('parent'));
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255|unique:regions,name,NULL,id,parent_id, ' . ($request['parent'] ?:'NULL'),
            'slug' => 'required|string|max:255|unique:regions,slug,NULL,id,parent_id, ' . ($request['parent'] ?: 'NULL'),
            'parent' => 'optional|exists:regions,id',
        ]);

        $region = Region::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id']
         ]);

        return redirect()->route('admin.regions.show',$region);
    }


    public function show(Region $region)
    {
        $regions = Region::where('parent_id',$region->id)->orderBy('name')->get();

        return view('admin.users.show',compact('region','regions'));
    }

    public function edit(Region $region)
    {
        return view('admin.region.edit',compact('region'));
    }


    public function update(Request $request, Region $region)
    {
        $this->validate($request,
            [
                'name' => 'required|string|max:255|unique:regions,name, '.$region->id.',id,parent_id,' .$region->parent_id,
                'slug' => 'required|string|max:255|unique:regions,slug, '.$region->id.',id,parent_id,' .$region->parent_id,
            ]);

        $region->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
        ]);
        return redirect()->route('admin.regions.show',$region);
    }


    public function destroy(Region $region)
    {

        $region->delete();

        return redirect()->route('admin.regions.index');
    }

}
