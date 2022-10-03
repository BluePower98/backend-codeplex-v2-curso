<?php

namespace App\Services\Application\ModuleCourse\Comments;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Comments\CommentsRepositoryInterface;

class CommentsService
{
    private CommentsRepositoryInterface $CommentsRepository;

    public function __construct(
        CommentsRepositoryInterface $CommentsRepository
    )
    {
        $this->CommentsRepository = $CommentsRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->CommentsRepository->datatables($request);
    }

    public function store(Request $request): Collection
    {
        return $this->CommentsRepository->store($request->all());
    }

    public function update(Request $request, string $idempresa, int $idcomentarios): Collection
    {
        return $this->CommentsRepository->update($request->all(), $idempresa, $idcomentarios);
    }

    public function delete(string $idempresa, int $idcomentarios): Collection
    {
        return $this->CommentsRepository->delete($idempresa, $idcomentarios);
    }  

    public function show(string $idempresa, int $idcomentarios): Collection
    {
        return $this->CommentsRepository->show($idempresa, $idcomentarios);
    }   
}