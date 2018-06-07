<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Kadaitasklist;   

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $kadaitasklists = $user->kadaitasklists()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'kadaitasklists' => $kadaitasklists,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $kadaitasklist = new Kadaitasklist;

        return view('kadaitaslist.create', [
            'kadaitasklist' => $kadaitasklist,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
            'content' => 'required|max:191',
            'status' => 'required|max:191',
        ]);

        $request->user()->kadaitasklists()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $kadaitasklist = Kadaitasklist::find($id);

        return view('kadaitasklists.show', [
            'kadaitaslist' => $kadaitasklist,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $kadaitasklist = Kadaitasklist::find($id);

        return view('kadaitasklists.edit', [
            'kadaitasklist' => $kadaitasklist,
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
       $this->validate($request, [
            'content' => 'required|max:191',   // add
            'status' => 'required|max:191',
        ]);


        $kadaitasklist = Kadaitasklist::find($id);
        $kadaitasklist->content = $request->content;    // add
        $kadaitasklist->status = $request->status;
        $kadaitasklist->save();


        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kadaitasklist = \App\Kadaitasklist::find($id);

        if (\Auth::user()->id === $kadaitasklist->user_id) {
            $kadaitasklist->delete();
        }

        return redirect()->back();
    }
}
