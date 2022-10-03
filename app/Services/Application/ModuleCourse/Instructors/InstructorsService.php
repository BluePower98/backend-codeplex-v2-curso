<?php

namespace App\Services\Application\ModuleCourse\Instructors;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Instructors\InstructorsRepositoryInterface;
use App\Helpers\FileHelper;

class InstructorsService
{
    private InstructorsRepositoryInterface $InstructorsRepository;

    public function __construct(
        InstructorsRepositoryInterface $InstructorsRepository
    )
    {
        $this->InstructorsRepository = $InstructorsRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->InstructorsRepository->datatables($request);
    }

    public function store(Request $request): void
    {
      $logo=$request->only(['foto']);
      $this->saveLogo($request,$logo);
    }

    private function saveLogo(Request $request,array $logo)
    {
        $images=array_keys($logo);
        $upload_path=$request->get('upload_path').'/';
        FileHelper::removeByUrl($upload_path);
        // dd($images);
        foreach ($images as $value) {
            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            // $fileName = FileHelper::sanitizerFileName($file->getClientOriginalName());
            // dd($fileName);
            $fileName = "foto" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;

            // $this->repository->updatelogo([

            //     'idempresa' => $idempresa,
            //     'idalumno' => $idalumno,
            //     'foto' => $url
            // ]);

            $request->merge(["foto"=>$url]);

            $this->InstructorsRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructorsRepository->update($request->all(), $idempresa, $idinstructor);
    }

    public function delete(string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructorsRepository->delete($idempresa, $idinstructor);
    }

    public function show(string $idempresa, int $idinstructor): Collection
    {
        return $this->InstructorsRepository->show($idempresa, $idinstructor);
    }

}
