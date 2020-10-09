<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LivrosCreateRequest;
use App\Http\Requests\LivrosUpdateRequest;
use App\Repositories\LivrosRepository;
use App\Validators\LivrosValidator;

/**
 * Class LivrosController.
 *
 * @package namespace App\Http\Controllers;
 */
class LivrosController extends Controller
{
    /**
     * @var LivrosRepository
     */
    protected $repository;

    /**
     * @var LivrosValidator
     */
    protected $validator;

    /**
     * LivrosController constructor.
     *
     * @param LivrosRepository $repository
     * @param LivrosValidator $validator
     */
    public function __construct(LivrosRepository $repository, LivrosValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $livros = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $livros,
            ]);
        }

        return view('livros.index', compact('livros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LivrosCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LivrosCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $livro = $this->repository->create($request->all());

            $response = [
                'message' => 'Livros created.',
                'data'    => $livro->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livro = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $livro,
            ]);
        }

        return view('livros.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $livro = $this->repository->find($id);

        return view('livros.edit', compact('livro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LivrosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LivrosUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $livro = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Livros updated.',
                'data'    => $livro->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Livros deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Livros deleted.');
    }
}
