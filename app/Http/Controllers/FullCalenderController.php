<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FullCalenderController extends Controller
{
    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end', 'penginput', 'session']);

            return response()->json($data);
    	}
    	return view('spm/jadwalAudit');
		// return view('spm/jadwalAudit', ['event' => $events]);
    }

	public function auditor_index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
					   ->where('penginput', Auth::user()->name)
                       ->get(['id', 'title', 'start', 'end', 'penginput', 'session']);
            return response()->json($data);
    	}
    	return view('auditor/jadwalAudit');
    }

	public function auditee_index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
					   ->where('penginput', Auth::user()->name)
                       ->get(['id', 'title', 'start', 'end', 'penginput', 'session']);
            return response()->json($data);
    	}
    	return view('auditee/jadwalAudit');
    }

    // public function action(Request $request)
    // {
	// 	dd($request->all());
    // 	if($request->ajax())
    // 	{
    // 		if($request->type == 'add')
    // 		{
    // 			$event = Event::create([
    // 				'title'		=>	$request->title,
    // 				'start'		=>	$request->start,
    // 				'end'		=>	$request->end
    // 			]);
        
    // 			return response()->json($event);
    // 		}

    // 		if($request->type == 'update')
    // 		{
    // 			$event = Event::find($request->id)->update([
    // 				'title'		=>	$request->title,
    // 				'start'		=>	$request->start,
    // 				'end'		=>	$request->end
    // 			]);

    // 			return response()->json($event);
    // 		}

    // 		if($request->type == 'delete')
    // 		{
    // 			$event = Event::find($request->id)->delete();

    // 			return response()->json($event);
    // 		}
    // 	}
    // }

	public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
					'session'	=>	$request->session,
					'penginput'	=>	Auth::user()->name,
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{

    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end,
					'session'	=>	$request->session,
					'penginput'	=>	Auth::user()->name,
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }

	public function createSession()
	{
		return view('spm/createSession');
	}

	public function storeSession(Request $request)
	{
		$isAlreadySession = Session::where('sesiKe', $request->sesiKe)->exists();

		if (!$isAlreadySession) {
			// dd($request->all());
			foreach ($request->addmore as $key => $value) {
				// $session = new Session;
				// $session->sesiKe = $value->sesiKe;
				// $session->waktuMulai = $value->waktuMulai;
				// $session->waktuSelesai = $value->waktuSelesai;
				// $session->save();
				Session::create($value);
			}

			$request->session()->flash('success', 'Sesi berhasil ditambahkan!');
		} else {
			$request->session()->flash('error', 'Sesi sudah tersedia! Silahkan masukkan nama sesi lain.');
		}

		return redirect()->back();
	}

	public function deleteSession($id)
	{
		$session = Session::find($id);
		$session->delete();

		return redirect()->back()->with('success', 'Sesi berhasil dihapus!');
	}
}
