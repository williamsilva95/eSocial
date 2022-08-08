<?php

namespace App\Http\Controllers;

use App\Dominio;
use App\Exports\DominiosExport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class DominioController extends Controller
{
    function __construct()
    {
        // obriga estar logado;
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $dominio = Dominio::getAllForIndex();

        $result = $dominio->paginate('10');

        return view('dominio.index', compact('result'));
    }

    public function create()
    {
        return view('dominio.form');
    }

    public function store(Request $request)
    {
        try {
            $result = DB::transaction(function () use ($request){

                $id = $request->input('id');

                $dominio = Dominio::find($id);

                if (!$dominio){
                    $dominio = new Dominio();
                }

                $validate = validator($request->all(), $dominio->rules(), $dominio->mensages);

                if($validate->fails()){
                    return back()->withErrors($validate);
                }

                $dominio->fill($request->all());

                $dominio->nome = $request->input('nome');
                $dominio->tld = $request->input('tld');

                $save = $dominio->save();

                if($save) {
                    toast('Domínio salvo com sucesso.','success');
                    return redirect('/dominio');
                }else{
                    Alert::warning('Erro ao salvar domínio.');
                    return back();
                }

            });

            DB::commit();
            return $result;
        }catch (\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function edit(Dominio $dominio)
    {
        return view('dominio.form', compact('dominio'));
    }

    public function show($id)
    {
        $dominio = Dominio::find($id);

        return view('dominio.view', compact('dominio'));
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');

            $delete = DB::table('dominios')->where('id', $id)->delete();

            if ($delete){
                return response()->json(['success' => true, 'msg'=> 'Domínio excluído com sucesso.']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Erro ao excluir Domínio.']);
            }
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function pesquisar(Request $request)
    {
        if($request->input('texto') == false){
            return redirect('/');
        }
        $dominio = Dominio::where('nome','like','%'.$request->input('texto').'%')
            ->orWhere('tld','like','%'.$request->input('texto').'%')->get();

        return view('pesquisa',compact('dominio'));
    }

    public function exportar(Request $request)
    {
        try {
            return $this->exportarExcel($request->all());
        } catch(Exception $exception) {
            toast('Erro ao exportar planilha.','error');
            return redirect()->back();
        }
    }

    public function exportarExcel()
    {
        // Obtem consulta
        $dominio = $this->gerarConsultaExportacao()->get();

        // Retorna o resultado da consulta da planilha
        return Excel::download(new DominiosExport($dominio), 'dominios.xlsx');
    }

    public function gerarConsultaExportacao()
    {
        $query = Dominio::query()
            ->select([
                'dominios.id',
                'dominios.nome',
                'dominios.tld',
                'dominios.created_at',
            ]);

        return $query;
    }
}
