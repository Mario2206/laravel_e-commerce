<?php


namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileUpload
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * check file and uplood it
     *
     * @param string $field
     * @param string $filename
     * @param string $storagePath
     * @return string|null
     */
    public function upload(string $field, string $filename, string $storagePath = "images")  {

        if($this->request->file($field)->isValid()) {
            $file = $this->request->file($field);

            $filename = md5(str_slug($filename) . time()) . "." . $file->getClientOriginalExtension();

            $this->request->file('miniature')->storeAs($storagePath, $filename);

            return $filename;
        }

        return null;
    }

    public function remove(string $filename, string $storagePath = "images" ) {
        File::delete( storage_path("app/" . $storagePath ) . "/" . $filename);
    }

}
