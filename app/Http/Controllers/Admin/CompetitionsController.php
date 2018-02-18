<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Group;
use App\Kid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCompetitionsRequest;
use App\Http\Requests\Admin\UpdateCompetitionsRequest;

class CompetitionsController extends Controller
{
    /**
     * Display a listing of Competition.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('competition_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (!Gate::allows('competition_delete')) {
                return abort(401);
            }
            $competitions = Competition::onlyTrashed()->get();
        } else {
            $competitions = Competition::orderBy('date', 'asc')->get();
        }


        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating new Competition.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('competition_create')) {
            return abort(401);
        }
        $groups = Group::all();


        return view('admin.competitions.create', compact('groups'));
    }

    /**
     * Store a newly created Competition in storage.
     *
     * @param  \App\Http\Requests\StoreCompetitionsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompetitionsRequest $request)
    {
        if (!Gate::allows('competition_create')) {
            return abort(401);
        }
        $competition = Competition::create([
            'title' => $request->input('title'),
            'date' => $request->input('date')
        ]);

        $groups = $request->input('groups');

        $competition->groups()->sync($groups);

        return redirect()->route('admin.competitions.index');
    }


    /**
     * Show the form for editing Competition.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('competition_edit')) {
            return abort(401);
        }
        $competition = Competition::findOrFail($id);
        $groups = Group::all();

        return view('admin.competitions.edit', compact('competition', 'groups'));
    }

    /**
     * Update Competition in storage.
     *
     * @param  \App\Http\Requests\UpdateCompetitionsRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionsRequest $request, $id)
    {
        if (!Gate::allows('competition_edit')) {
            return abort(401);
        }
        $competition = Competition::findOrFail($id);
        //      $competition->update($request->all());

        $competition->update([
            'title' => $request->input('title'),
            'date' => $request->input('date')
        ]);

        $groups = $request->input('groups');

        $competition->groups()->sync($groups);


        return redirect()->route('admin.competitions.index');
    }


    /**
     * Display Competition.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('competition_view')) {
            return abort(401);
        }
        $competition = Competition::findOrFail($id);
        $user = Auth::getUser();

        $kids = $competition->kids()->where('user_id', $user->id)->get();

        $groups = $competition->groups()->get();
        $myGroups = $groups->pluck('title', 'id');



        return view('admin.competitions.show', compact('competition', 'kids', 'groups', 'user', 'myGroups'));
    }


    /**
     * Remove Competition from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('competition_delete')) {
            return abort(401);
        }
        $competition = Competition::findOrFail($id);
        $competition->delete();

        return redirect()->route('admin.competitions.index');
    }

    /**
     * Delete all selected Competition at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('competition_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Competition::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Competition from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!Gate::allows('competition_delete')) {
            return abort(401);
        }
        $competition = Competition::onlyTrashed()->findOrFail($id);
        $competition->restore();

        return redirect()->route('admin.competitions.index');
    }

    /**
     * Permanently delete Competition from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (!Gate::allows('competition_delete')) {
            return abort(401);
        }
        $competition = Competition::onlyTrashed()->findOrFail($id);
        $competition->forceDelete();

        return redirect()->route('admin.competitions.index');
    }

    public function getRegister($comp)
    {
        $competition = Competition::find($comp);
        $kids = Kid::where('user_id', Auth::getUser()->id)->get();
        $registeredKids = $competition->kids()->where('user_id', Auth::getUser()->id)->get();
        $kidIds = [];
        foreach ($registeredKids as $registeredKid) {
            $kidIds[] = $registeredKid->id;
        }
        return view('admin.competitions.register', compact('kids', 'competition', 'kidIds'));
    }

    public function postRegister(Request $request)
    {
        $competition = Competition::find($request->input('comp_id'));
        $kids = $request->input('kids');
        $competition->kids()->syncWithoutDetaching($kids);
        $groups = $competition->groups()->get();
        $kidsInfo = Kid::find($kids);

        foreach ($kidsInfo as $kid){
            foreach ($groups as $group){
                if($kid->year >= $group->year_from && $kid->year <= $group->year_to) {
                    $kid->group = $group->id;
                    $competition->groupId()->attach(2, ['group_id' => $group->id]);
                } else {
                    return redirect('admin/competitions/' . $competition->id);
                }
            }
        }


        return redirect('admin/competitions/' . $competition->id);
    }

    public function destroyRegistration($comp, $kidId)
    {
        $competition = Competition::find($comp);
        $competition->kids()->detach($kidId);

        return redirect('admin/competitions/' . $competition->id);
    }

    public function allRegisteredKids($comp)
    {
        $competition = Competition::find($comp);
        $groups = $competition->groups()->get();
        $kids = $competition->kids()->orderBy('sex', 'asc')->get();

        foreach ($groups as $group) {
            foreach ($kids as $kid) {
                if ($kid->year >= $group->year_from && $kid->year <= $group->year_to) {
                    $kid->group = $group;
                }
            }
        }


        return view('admin/competitions/showRegistered', compact('competition', 'groups', 'kids'));
    }
}
