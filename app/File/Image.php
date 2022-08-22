<?php 

namespace App\File;

class Image 
{
    private $image;

    private $name;

    private $type;

    private $width;

    private $height;

    function __construct($file)
    {
        $this->name = $file["name"];
        $this->type = $file["type"];

        $this->image = imagecreatefromstring(file_get_contents($file["tmp_name"]));

        list($this->width, $this->height) = getimagesize($file["tmp_name"]);
    }

    private function getPixel(int $x, int $y):array
    {
        $index = imagecolorat($this->image, $x, $y);
        return imagecolorsforindex($this->image, $index);
    }

    function setText(string $text)
    {
        $text = ">".$text."<";

        $position = 0;
        for($x = 0; $x < $this->width; $x++)
        {
            for($y = 0; $y < $this->height; $y++)
            {
                if (!isset($text[$position])) return true;

                $pixel = $this->getPixel($x, $y);

                $position++;
            }
        }
    }
}