<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Core\StoreRequest;
use App\Models\core\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Store::limit(1)->get();
        $data = Store::all()->take(1);
        $data = Store::all();
        $data = Store::get()->paginate(2);

        // Store::chunk(1, function($data){
        //     echo <<<'HTML'
        //         <hr><br>
        //     HTML;
        //     print_r($data);
        // });

        $count = Store::all()->count();
        return response()->json(['data'=>$data, 'total'=>$count]);
    }

    public function newIndex()
    {
          $data = Store::all();
          $data = Store::orderBy('id', 'asc')->paginate(2);

          return view('Lista', ['data' => $data]);    
    }

    public function search(Request $request)
    {
      $filters = $request->except('_token');
      
      if(empty($request->search))
      { 
        return redirect('lista');
      }

      $data = Store::where('name_fantasy', 'LIKE', "%{$request->search}%")->paginate();
      
      return view('Lista', ['data' => $data, 'filters' => $filters]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = $request->all();

        // $validation = Validator::make(
        // $request->all(), 
        // [
        //     'cnpj' => 'required|unique:store',
        //     'name_fantasy' => 'nullable|unique:store'
        // ]);

        // if($validation->fails())
        // {
        //     return response()->json([$validation->errors(), 422]);
        // }
        
        Store::create($data);
        return response()->json(['data' => $data]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $data = Store::find($id);
        
        return view('Form', ['data' => $data]);
    }

    public function updateTwo(Request $request, $id)
    {
        
        $data = Store::findOrFail($id);
        
        $dataNew = $request->except(['_token', '_method']);
        
        if($request->hasFile('image'))//Verifica se tem imagem
        {
            if(Storage::exists($data->image))//Verifica se tem imagem antiga, para excluir e adicionar a nova
            {
                Storage::delete([$data->image]);
            }

            $nameFile = Str::of($request->name_fantasy.rand(0,1000))->slug('-'). '.' .$request->image->getClientOriginalExtension();
            $dataNew['image'] = $request->image->storeAs('public', $nameFile);

        }

        $data->update($dataNew);
        echo 'aqui';
        return redirect()->route('lista2');
        echo 'depois';
        return response()->json(['data' => $data]);
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
        $data = Store::findOrFail($id);
        
        $dataNew = $request->all();

        $data->update($dataNew);
        return response()->json(['data' => $data]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function destroy($id)
    {
        $data = Store::find($id);
        if(is_null($data) || !isset($data)){
            return response()->json(['mensagem', 'Não foi possível encontrar esse registro']);
        }
        $data->delete();
        return response()->json(['data', $data]);
    }
}
