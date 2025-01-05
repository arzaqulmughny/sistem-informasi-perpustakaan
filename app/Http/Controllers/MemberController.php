<?php

namespace App\Http\Controllers;

use App\DataTables\MembersDataTable;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MembersDataTable $dataTable)
    {
        $pageTitle = 'Data Anggota';
        return $dataTable->render('pages.members.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();
        $data['profile_picture'] = null;

        try {
            DB::beginTransaction();

            $member = Member::create([
                ...$data,
                'created_by' => $request->user()->id
            ]);

            // Upload profile picture
            if ($file = $request->file('profile_picture')) {
                $url = $file->storePubliclyAs('media', $file->hashName(), 'public');

                $member->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('members.index')->with('success', 'Berhasil menambahkan data');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('pages.members.show', [
            'data' => $member
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        return view('pages.members.edit', [
            'data' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMemberRequest $request, Member $member)
    {
        $data = $request->except('profile_picture');

        try {
            DB::beginTransaction();
            $member->update([
                ...$data,
            ]);

            // Upload profile picture
            if ($file = $request->file('profile_picture')) {
                $url = $file->storePubliclyAs('media', $file->hashName(), 'public');

                // Delete old file if exist
                if ($oldImage = $member->profile_picture) {
                    Storage::disk('public')->exists($oldImage) && Storage::disk('public')->delete($oldImage);
                }

                $member->update([
                    'profile_picture' => $url
                ]);
            }

            DB::commit();
            return redirect()->route('members.show', $member->id)->with('success', 'Berhasil memperbaru data');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan pada server');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        try {
            DB::beginTransaction();
            $member->delete();

            DB::commit();
            return redirect()->route('members.index')->with('success', 'Berhasil menghapus data');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', 'Gagal menghapus data');
        }
    }

    /**
     * Get paginated data via ajax
     */
    public function ajax_get(Request $request)
    {
        $data = DB::table('members')
                    ->when($request->search, function (Builder $query, String $search) {
                        $query->where('name', 'LIKE', '%' . $search .'%');
                    })
                    ->paginate(15);

        return response()->json($data);
    }
}
