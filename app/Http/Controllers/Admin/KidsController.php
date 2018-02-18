<?php

namespace App\Http\Controllers\Admin;

use App\Kid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreKidsRequest;
use App\Http\Requests\Admin\UpdateKidsRequest;

class KidsController extends Controller
{
    /**
     * Display a listing of Kid.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('kid_access')) {
            return abort(401);
        }

        $user = Auth::getUser();

        if (request('show_deleted') == 1) {
            if (!Gate::allows('kid_delete')) {
                return abort(401);
            }
            $kids = Kid::where('user_id', Auth::getUser()->id)->onlyTrashed()->get();
            $title = 'Vaikų sąrašas';
        } else {

                $kids = Kid::where('user_id', Auth::getUser()->id)->get();
                $title = 'Mano treniruojamų vaikų sąrašas';

        }

        return view('admin.kids.index', compact('kids', 'title', 'user'));
    }

    public function allKids()
    {
        if (!Gate::allows('kid_access')) {
            return abort(401);
        }

        $user = Auth::getUser();

        if (request('show_deleted') == 1) {
            if (!Gate::allows('kid_delete')) {
                return abort(401);
            }
            $kids = Kid::onlyTrashed()->get();
            $title = 'Vaikų sąrašas';
        } else {
            $allKids = Kid::all();
            $title = 'Visų vaikų sąrašas';

        }

        return view('admin.kids.allKids', compact('kids', 'title', 'user', 'allKids'));
    }

    /**
     * Show the form for creating new Kid.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('kid_create')) {
            return abort(401);
        }

        $groups = \App\Group::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        //       $coaches = \App\Coach::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $clubs = \App\Club::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $users = User::get()->pluck('name', 'id');

        return view('admin.kids.create', compact('groups', 'users', 'clubs'));
    }

    /**
     * Store a newly created Kid in storage.
     *
     * @param  \App\Http\Requests\StoreKidsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKidsRequest $request)
    {
        if (!Gate::allows('kid_create')) {
            return abort(401);
        }
        //     $kid = Kid::create($request->all());
        $user = Auth::getUser();
        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['club_id'] = $user->club_id;

        $kid = Kid::create($data);

        if (Auth::getUser()->id == 1) {
            return redirect('/admin/mykids');
        }
        return redirect()->route('admin.kids.index');
    }


    /**
     * Show the form for editing Kid.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('kid_edit')) {
            return abort(401);
        }

        $groups = \App\Group::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $coaches = \App\Coach::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $clubs = \App\Club::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $kid = Kid::findOrFail($id);

        return view('admin.kids.edit', compact('kid', 'groups', 'coaches', 'clubs'));
    }

    /**
     * Update Kid in storage.
     *
     * @param  \App\Http\Requests\UpdateKidsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKidsRequest $request, $id)
    {
        if (!Gate::allows('kid_edit')) {
            return abort(401);
        }
        $kid = Kid::findOrFail($id);
        $kid->update($request->all());


        return redirect()->route('admin.kids.index');
    }


    /**
     * Display Kid.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('kid_view')) {
            return abort(401);
        }
        $kid = Kid::findOrFail($id);

        return view('admin.kids.show', compact('kid'));
    }


    /**
     * Remove Kid from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('kid_delete')) {
            return abort(401);
        }
        $kid = Kid::findOrFail($id);
        $kid->delete();

        return redirect()->route('admin.kids.index');
    }

    /**
     * Delete all selected Kid at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('kid_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Kid::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Kid from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('kid_delete')) {
            return abort(401);
        }
        $kid = Kid::onlyTrashed()->findOrFail($id);
        $kid->restore();

        return redirect()->route('admin.kids.index');
    }

    /**
     * Permanently delete Kid from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('kid_delete')) {
            return abort(401);
        }
        $kid = Kid::onlyTrashed()->findOrFail($id);
        $kid->forceDelete();

        return redirect()->route('admin.kids.index');
    }
}
