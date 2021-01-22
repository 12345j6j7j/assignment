<?php

namespace App\Traits;

use File as CustomFile;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait HasUploudTrait
{
    /**
     * upload folder
     *
     * @var string
     */
    protected $folder = 'public/uploads/';

    /**
     * paginate number
     *
     * @var array
     */
    protected $_relations = [
        'Gallery' => 'book',
    ];

    /**
     * method used to upload image to the model
     *
     * @param string $fieldName
     * @throws \ReflectionException
     */
    public function uploadImage($fieldName = 'image')
    {
        $this->$fieldName = $this->storeImage($fieldName);
        $this->save();
    }

    /**
     * method used to store image if exists, otherwise returns the previous field value
     *
     * @param string $fieldName
     * @param string $attributeName
     * @return string
     * @throws \ReflectionException
     */
    public function storeImage($fieldName = 'image', $attributeName = 'image')
    {
        if ($image = request()->file($fieldName)) {

            if (!empty($this->$attributeName)) Storage::delete($this->$attributeName);
            $className = (new \ReflectionClass($this))->getShortName();

            $path = Storage::putFileAs(
                $this->getFolderName($this->folder . Str::lower(Str::plural($className, 2)) . '/'),
                request()->file($fieldName),
                $this->getFileName($image));

            if (app()->environment() !== 'testing' && !in_array($image->getClientOriginalExtension(), ['pdf', 'doc', 'docx', 'xls', 'xlsx'])) {
                $img = Image::make(storage_path('app/' . $path));

                $img->fit(
                    $this->imageWidth,
                    $this->imageHeight,
                    function ($constraint) {
                        $constraint->upsize();
                });

                $img->save(storage_path('app/' . $path));
            }

            return $path;

        } elseif (strpos(request($attributeName), 'data:image') !== false) {
            return $this->base64($attributeName);
        }

        if (request('remove_image')) {
            if (!empty($this->$attributeName)) Storage::delete($this->$attributeName);
            return null;
        }

        return $this->$attributeName;
    }

    /**
     * method used to return folder name related to current month and year
     *
     * @param $path
     * @return string
     */
    protected function getFolderName($path)
    {
        return $path . now()->format('m-Y');
    }

    /**
     * method used to return file name with extension related to the model object (using ID, name, title)
     *
     * @param $image
     * @return string
     */
    protected function getFileName($image = false)
    {
        $res = '';

        if (isset($this->title)) {
            $res .= Str::slug($this->parseTranslatedData('title')) . '-';
        } elseif (isset($this->name)) {
            $res .= Str::slug($this->parseTranslatedData('name')) . '-';
        }

        $extension = $image != false ? $image->getClientOriginalExtension() : 'jpg';

        return $res . $this->id . '-' . Str::random(2) . '.' . $extension;
    }

    protected function parseTranslatedData($field)
    {
        return gettype($field) == 'array' ? json_decode($this->$field, true)->{app()->getLocale()} : $this->$field;
    }

    /**
     * method used to store image gallery if exists, otherwise do nothing
     *
     * @param string $fieldName
     * @param string $attributeName
     * @param string $aditional
     * @return string
     * @throws \ReflectionException
     */
    public function storeGallery($fieldName = 'image', $attributeName = 'path', $aditional = 'galleries')
    {
        if ($image = request()->file($fieldName)) {
            if (!empty($this->$attributeName)) File::delete($this->$attributeName);
            $className = (new \ReflectionClass($this))->getShortName();
            $fileName = $this->getFileName($image);

            $reflection = new \ReflectionClass($this);
            $string = (string)$this->_relations[$reflection->getShortName()];

            $slug = Str::slug($this->$string->title ?: $this->$string->name);
            $filePath = 'storage/' . request()->file($fieldName)->storeAs(
                    $this->folder . Str::lower(Str::plural($className, 2)) . '/' . $aditional . '/' . $slug . '-' . $this->$string->id,
                    $this->$string->title . '-' . $fileName,
                    'public'
                );

            $this->update([
                'title' => $this->$string->title . '-' . $fileName,
                'path' => $filePath,
                'size' => $image->getSize(),
                'type' => $image->getClientOriginalExtension(),
                'is_visible' => 1
            ]);

            return 'done';

        }
        return '';
    }

    /**
     * method used to return gallery folder name related to exists path, current month and year
     *
     * @param $path
     * @return string
     */
    protected function getGalleryFolderName($path)
    {
        return $path . now()->format('m-Y');
    }

    /**
     * method used to store base64 images (etc. uploads/posts/10-2018/image_name.jpg)
     *
     * @param string $attributeName
     * @return string
     * @throws \ReflectionException
     */
    protected function base64($attributeName = 'image')
    {
        $path = $this->getFolderName($this->folder . Str::lower(Str::plural((new \ReflectionClass($this))->getShortName(), 2)) . '/');
        $filename = $this->getFileName();
        Storage::disk('public')->put($path . '/' . $filename, base64_decode(explode(',', request($attributeName))[1]));
        return 'storage/' . $path . '/' . $filename;
    }
}
