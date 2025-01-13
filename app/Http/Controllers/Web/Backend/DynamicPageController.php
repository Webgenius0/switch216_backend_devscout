<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DynamicPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $data = DynamicPage::latest();
        // dd($data);
        if ($request->ajax()) {
            $data = DynamicPage::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_content', function ($data) {
                    // Strip HTML tags and truncate the content
                    $content = strip_tags($data->page_content);
                    return $content;
                })
                ->addColumn('status', function ($data) {
                    $status = '<div class="form-check form-switch">';
                    $status .= '<input onclick="changeStatus(event,' . $data->id . ')" type="checkbox" class="form-check-input" style="border-radius: 25rem;"' . $data->id . '" name="status"';

                    if ($data->status == "active") {
                        $status .= ' checked';
                    }

                    $status .= '>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="action-wrapper">


                        <button class="action-btn outline-action-btn" type="button" onclick="window.location.href=\'' . route('pages', $data->page_slug) . '\'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                        <path d="M18.3911 8.211C19.3575 9.22772 19.3575 10.7724 18.3911 11.7892C16.7613 13.504 13.9621 15.8334 10.7826 15.8334C7.60296 15.8334 4.8038 13.504 3.17397 11.7892C2.20763 10.7724 2.20763 9.22772 3.17397 8.211C4.8038 6.49619 7.60296 4.16675 10.7826 4.16675C13.9621 4.16675 16.7613 6.49619 18.3911 8.211Z" stroke="#030C09" stroke-width="1.5"></path>
                        <path d="M13.2826 10.0001C13.2826 11.3808 12.1633 12.5001 10.7826 12.5001C9.40184 12.5001 8.28255 11.3808 8.28255 10.0001C8.28255 8.61937 9.40184 7.50008 10.7826 7.50008C12.1633 7.50008 13.2826 8.61937 13.2826 10.0001Z" stroke="#030C09" stroke-width="1.5"></path></svg>
                        </button>


                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View">
                        <i class="material-symbols-outlined fs-16 text-primary">visibility</i>
                        </button>
                         <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" onclick="window.location.href=\'' . route('dynamic_page.edit', $data->id) . '\'">
                         <i class="material-symbols-outlined fs-16 text-body">edit</i>
                        </button>
                        <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" onclick="deleteRecord(event,' . $data->id . ')">
                        <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                        </button>
             
                </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view("backend.layouts.settings.dynamic_page.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function status(Request $request, $id)
    {

        $data = DynamicPage::find($id);
        // check here BookingRequest hotel_id === identifyHotel
        if (empty($data)) {
            return response()->json([
                "success" => false,
                "message" => "Item not found."
            ], 404);
        }

        if ($data->status == 'active') {
            $data->status = 'inactive';
        } else {
            $data->status = 'active';
        }

        $data->save();
        return response()->json([
            'success' => true,
            'message' => 'Item status changed successfully.'
        ]);
    }
}
