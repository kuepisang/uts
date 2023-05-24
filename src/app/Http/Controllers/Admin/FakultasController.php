<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFakultasRequest;
use App\Http\Requests\StoreFakultasRequest;
use App\Http\Requests\UpdateFakultasRequest;
use App\Models\Fakultas;
use Fakultas;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('fakultas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Fakultas::query()->select(sprintf('%s.*', (new Fakultas)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'fakultas_show';
                $editGate      = 'fakkultas_edit';
                $deleteGate    = 'fakultas_delete';
                $crudRoutePart = 'fakultass';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('fakultasname', function ($row) {
                return $row->fakultasname ? $row->fakultasname : '';
            });
            $table->editColumn('author', function ($row) {
                return $row->author ? $row->author : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.fakultass.index');
    }

    public function create()
    {
        abort_if(Gate::denies('fakultas_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultass.create');
    }

    public function store(StoreFakultasRequest $request)
    {
        $fakultas = Fakultas::create($request->all());

        return redirect()->route('admin.fakultass.index');
    }

    public function edit(Fakultas $fakultas)
    {
        abort_if(Gate::denies('fakultas_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultass.edit', compact('fakultas'));
    }

    public function update(UpdateFakultasRequest $request, Fakultas $fakultas)
    {
        $fakultas->update($request->all());

        return redirect()->route('admin.fakultass.index');
    }

    public function show(Fakultas $fakultas)
    {
        abort_if(Gate::denies('fakultas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fakultass.show', compact('fakultas'));
    }

    public function destroy(Fakultas $fakultas)
    {
        abort_if(Gate::denies('fakultas_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultas->delete();

        return back();
    }

    public function massDestroy(MassDestroyFakultasRequest $request)
    {
        $fakultas = Fakultas::find(request('ids'));

        foreach ($fakultas as $fakultas) {
            $fakultas->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
