<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use \App\Rekmed;
use App\RekmedAnak;
use App\RekmedSuami;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('admin')) return $next($request);
            abort(403, 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $find = NULL;
        if ($search) {
            $find = Rekmed::where('rek_id', 'LIKE', $search)->get();
        }
        
        return view('admin.index', ['find' => $find]);
    }

    public function create(Request $request)
    {
        $id = $request->get('id');
        $id = strtoupper($id);
        return view('admin.create', ['id' => $id]);
    }

    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'rek_id'=>'required|min:6|max:6|unique:rekmed',
            'rek_nik'=>'unique:rekmed'
        ])->validate();

        $rek_id = strtoupper($request->get('rek_id'));
        
        $rekmed = new Rekmed;
        $rekmed->rek_id = $rek_id;
        $rekmed->rek_name = $request->get('rek_name');

        $rekmed->rek_nik = $request->get('rek_nik');
        $rekmed->rek_tempat_lahir = $request->get('rek_tempat_lahir');
        $rekmed->rek_tanggal_lahir = $request->get('rek_tanggal_lahir');
        $rekmed->rek_darah = $request->get('rek_darah');
        $rekmed->rek_agama = $request->get('rek_agama');
        $rekmed->rek_job = $request->get('rek_job');
        $rekmed->rek_alamat = $request->get('rek_alamat');
        $rekmed->rek_status = $request->get('rek_status');

        $rekmed->u_id = $request->get('u_id');
        $rekmed->save();

        if ($request->get('rs_name')) {
            $suami = new RekmedSuami;
            $suami->rek_id = $rek_id;
            
            $suami->rs_name = $request->get('rs_name');
            $suami->rs_job = $request->get('rs_job');
            $suami->rs_darah = $request->get('rs_darah');
            $suami->rs_hp = $request->get('rs_hp');
            $suami->rs_alamat = $request->get('rs_alamat');
            
            $suami->save();
        }

        for ($i=1; $i <= 5; $i++) {
            if ($request->get("ra_name$i")) {
                $anak = new RekmedAnak;
                $anak->rek_id = $rek_id;
                
                $anak->ra_name = $request->get("ra_name$i");
                $anak->ra_tempat_lahir = $request->get("ra_tempat_lahir$i");
                $anak->ra_tanggal_lahir = $request->get("ra_tanggal_lahir$i");
                $anak->ra_darah = $request->get("ra_darah$i");
                
                $anak->save();
            }
        }

        return redirect()->route('admin.create.rek')->with('status', $rek_id);
    }

    public function show($rek_id)
    {
        $rekmed = Rekmed::findOrFail($rek_id);
        return view('admin.show', ['rekmed'=>$rekmed]);
    }

}
