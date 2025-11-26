<?php

    namespace App\Http\Controllers;

    use App\Models\Ppe;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;

    class PpeController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $ppes = Ppe::orderBy('name', 'asc')->paginate(10);

            return view('ppes.index', [
                'sidebar' => 'epi',
                'menuOpen' => 'menuOpenEpi',
                'ppes' => $ppes,
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('ppes.create', [
                'sidebar' => 'epi',
                'menuOpen' => 'menuOpenEpi'
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $validated = $request->validate(
                [
                    'name' => 'required|unique:ppes,name',
                    'ca' => 'nullable'
                ],
                [
                    'name.required' => 'Campo obrigatório',
                    'name.unique' => 'EPI já existe'
                ]
            );

            try {

                DB::beginTransaction();

                $ppes = Ppe::create($validated);

                Log::info('EPI cadastrado', ['id' => $ppes->id, 'action_id_user' => auth()->id()]);

                DB::commit();

                return redirect()->route('ppe.index')->with('success', 'EPI cadastrado com sucesso!');

            } catch (\exception $e) {
                Log::info('Erro ao cadastrar EPI', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                DB::rollBack();
                return back()->withInput()->with('error', 'Erro ao cadastrar EPI');
            }
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Request $request, Ppe $ppe)
        {
            return view('ppes.edit', [
                'sidebar' => 'epi',
                'menuOpen' => 'menuOpenEpi',
                'ppe' => $ppe
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, Ppe $ppe)
        {
            $validated = $request->validate(
                [
                    'name' => 'required|unique:ppes,name,' . $ppe->id,
                    'ca' => 'nullable'
                ],
                [
                    'name.required' => 'Campo obrigatório',
                    'name.unique' => 'EPI já existe'
                ]
            );

            try {
                DB::beginTransaction();

                $ppe->update($validated);

                Log::info('EPI editado', ['id' => $ppe->id, 'action_id_user' => auth()->id()]);

                DB::commit();

                return redirect()->route('ppe.index')->with('success', 'EPI editado com sucesso!');
            } catch (\exception $e) {
                Log::info('Erro ao editar EPI', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Erro ao editar EPI');
            }
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Ppe $ppe)
        {
            try {
                Log::info('EPI deletado', ['id' => $ppe->id, 'action_id_user' => auth()->id()]);
                $ppe->delete();
                return redirect()->route('ppe.index')->with('success', 'EPI deletado com sucesso!');
            } catch (\exception $e) {
                Log::info('Erro ao deletar EPI', ['error' => $e->getMessage(), 'action_id_user' => auth()->id()]);
                return back()->with('error', 'Erro ao deletar EPI');
            }
        }
    }
