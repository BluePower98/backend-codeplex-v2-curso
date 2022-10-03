<?php

namespace App\Services\Application\ModuleCourse\Alumnos;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\ModuleCourse\Alumnos\AlumnosRepositoryInterface;
use App\Helpers\FileHelper;

class AlumnosService
{
    private AlumnosRepositoryInterface $AlumnosRepository;

    public function __construct(

        AlumnosRepositoryInterface $AlumnosRepository
    )
    {
        $this->AlumnosRepository = $AlumnosRepository;
    }

    public function datatables(Request $request): Collection
    {
        return $this->AlumnosRepository->datatables($request);
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
        foreach ($images as $value) {

            if(!$request->hasFile($value)){
                continue;
            }
            $file=$request->file($value);
            $fileName = "foto" . '.' . $file->getClientOriginalExtension();
            $file->move($upload_path, $fileName);

            $url = $upload_path.'/'. $fileName;

            $request->merge(["foto"=>$url]);
            $this->AlumnosRepository->store($request->all());
        }

    }

    public function update(Request $request, string $idempresa, string $idalumno): Collection
    {
        return $this->AlumnosRepository->update($request->all(), $idempresa, $idalumno);
    }

    public function delete(string $idempresa, string $rucdni): Collection
    {
        return $this->AlumnosRepository->delete($idempresa, $rucdni);
    }
    public function show(string $idempresa, string $idalumno): Collection
    {
        return $this->AlumnosRepository->show($idempresa, $idalumno);
    }
}
