<?php

    namespace App\Http\Controllers;

    use App\Models\PpeMovement;
    use Illuminate\Http\Request;

    class PpeMovementController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $ppeMovements = PpeMovement::orderBy('date', 'desc')->paginate(10);

            return view('ppemovement.index', [
                'sidebar' => 'ppeMovements',
                'ppeMovements' => $ppeMovements,
                'menuOpen' => 'menuOpenEpi'
            ]);
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
        public function show(PpeMovement $ppeMovement)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(PpeMovement $ppeMovement)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, PpeMovement $ppeMovement)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(PpeMovement $ppeMovement)
        {
            //
        }
    }
