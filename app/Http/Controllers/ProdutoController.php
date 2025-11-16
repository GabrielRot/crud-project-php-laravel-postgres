<?php
    namespace App\Http\Controllers;

    use App\Models\Produto;
    use Illuminate\Http\Request;
    use Illuminate\Routing\Controller;

    class ProdutoController extends Controller {
        public function index() {
            return response()->json(Produto::all());
        }

        public function show($id) {
            $produto = Produto::find($id);

            if (!$produto) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            return response()->json($produto);
        }

        public function store(Request $request) {
            $request->validate([
                'nome'       => 'required|string',
                'preco'      => 'required|numeric',
                'quantidade' => 'required|integer',
            ]);

            $produto = Produto::create($request->all());

            return response()->json($produto, 201);
        }

        public function update(Request $request, $id) {
            $produto = Produto::find($id);

            if (!$produto) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            $request->validate([
                'nome'       => 'sometimes|required|string',
                'preco'      => 'sometimes|required|numeric',
                'quantidade' => 'sometimes|required|integer',
            ]);

            $produto->update($request->all());

            return response()->json($produto);
        }

        public function destroy($id) {
            $produto = Produto::find($id);

            if (!$produto) {
                return response()->json(['error' => 'Produto não encontrado'], 404);
            }

            $produto->delete();

            return response()->json(['message' => 'Produto deletado com sucesso']);
        }
    }