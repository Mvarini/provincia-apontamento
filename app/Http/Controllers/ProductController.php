<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\ProductRequest;
    use App\Models\Product;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Storage;

    class ProductController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            $products = Product::orderBy('name', 'asc')->paginate(10);

            return view('products.index', [
                'products' => $products,
                'sidebar' => 'produtos'
            ]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('products.create', [
                'sidebar' => 'produtos'
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(ProductRequest $request)
        {
            $request->validated();

            DB::beginTransaction();

            try {

                if ($request->hasFile('cadtec')) {
                    $cadtecPath = $request->file('cadtec')->store('cadtecs', 'public');
                }

                $product = Product::create([
                    'name' => $request->name,
                    'cadtec' => $request->hasFile('cadtec') ? $cadtecPath : $request->cadtec,
                ]);

                Log::info('Produto cadastrado', ['product' => $product->id, 'action_user_id' => Auth::id()]);

                DB::commit();

                return redirect()->route('product.index')->with('success', 'Produto cadastrado com sucesso!');

            } catch (\Exception $e) {
                Log::error('Produto não cadastrado', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Produto não cadastrado!');
            }
        }

        /**
         * Display the specified resource.
         */
        public function show(Product $product)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Product $product)
        {
            return view('products.edit', [
                'product' => $product,
                'sidebar' => 'produtos'
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(ProductRequest $request, Product $product)
        {
            $request->validated();

            DB::beginTransaction();

            try {

                if ($request->hasFile('cadtec') && $request->file('cadtec')->isValid()) {
                    $cadtecPath = $request->file('cadtec')->store('cadtecs', 'public');
                }

                if ($product->cadtec) {
                    Storage::disk('public')->delete($product->cadtec);
                }

                $product->update([
                    'name' => $request->name,
                    'cadtec' => $request->hasFile('cadtec') ? $cadtecPath : $request->cadtec,
                ]);

                Log::info('Produto atualizado', ['id' => '$produto->id', 'action_user_id' => Auth::id()]);

                DB::commit();

                return redirect()->route('product.index')->with('success', 'Produto atualizado com sucesso!');
            } catch (\Exception $e) {
                Log::error('Produto não atualizado', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

                DB::rollBack();

                return back()->withInput()->with('error', 'Produto não atualizado!');
            }

        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Product $product)
        {
            if ($product->cadtech) {
                Storage::disk('public')->delete($product->cadetec);
            }

            $product->delete();

            Log::info('Produto excluído', ['id' => $product->id, 'action_user_id' => Auth::id()]);

            return redirect()->route('product.index')->with('success', 'Produto excluído com sucesso!');
        }

        public function preview(Product $product)
        {
            if ($product->cadtec) {
                $path = Storage::disk('public')->path($product->cadtec);
                return response()->file($path);
            } else {
                return back()->with('error', 'Não existe arquivo CADTEC para este produto!');
            }
        }

        public function download(Product $product)
        {
            if ($product->cadtec) {
                return Storage::disk('public')->download($product->cadtec, $product->name);
            } else {
                return back()->with('error', 'Não existe arquivo CADTEC para este produto!');
            }
        }
    }
