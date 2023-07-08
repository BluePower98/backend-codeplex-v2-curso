<?php

namespace App\Services\Application\ModuleCourse\Specialties;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Helpers\FileHelper;
use App\Repositories\ModuleCourse\Specialties\SpecialtiesRepositoryInterface;

class SpecialtiesService
{
    private SpecialtiesRepositoryInterface $SpecialtiesRepository;

    public function __construct(
        SpecialtiesRepositoryInterface $SpecialtiesRepository
    )
    {
        $this->SpecialtiesRepository = $SpecialtiesRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->SpecialtiesRepository->datatables($request);
    }

    public function store(Request $request): void
    {
        $logo=$request->only(['portada']);
        $this->saveLogo($request,$logo);
    }

    private function saveLogo(Request $request,array $logo)
    {
        $images=array_keys($logo);
        $upload_path=$request->get('upload_path').'/';
        FileHelper::removeByUrl($upload_path);
        foreach ($images as $value) {

            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            $fileName = "portada" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;

            $request->merge(["portada"=>$url]);
            $this->SpecialtiesRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->update($request->all(), $idempresa, $idespecialidad);
    }

    public function delete(string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->delete($idempresa, $idespecialidad);
    }  

    public function show(string $idempresa, int $idespecialidad): Collection
    {
        return $this->SpecialtiesRepository->show($idempresa, $idespecialidad);
    }  
}