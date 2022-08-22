<?php

namespace App\File;

use \App\Utils\Converter;

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

    private function getPixel(int $x, int $y): array
    {
        $index = imagecolorat($this->image, $x, $y);
        return imagecolorsforindex($this->image, $index);
    }

    /**
     * Metodo responsavel por definir a cor de um pixel
     *
     * @param int $x
     * @param int $y
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return void
     */
    private function setPixel(int $x, int $y, int $red, int $green, int $blue)
    {
        $color = imagecolorallocate($this->image, $red, $green, $blue);
        return imagesetpixel($this->image, $x, $y, $color);
    }

    function setText(string $text)
    {
        $text = ">" . $text . "<";

        $position = 0;
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                if (!isset($text[$position])) return true;

                $pixel = $this->getPixel($x, $y);

                $redBin = Converter::getDecBin($pixel["red"]);
                $greenBin = Converter::getDecBin($pixel["green"]);
                $blueBin = Converter::getDecBin($pixel["blue"]);

                $charBin = Converter::getCharBin($text[$position]);

                $redBin = substr($redBin, 0, 5) . substr($charBin, 0, 3);
                $greenBin = substr($greenBin, 0, 6) . substr($charBin, 3, 2);
                $blueBin = substr($blueBin, 0, 5) . substr($charBin, 5, 3);

                $red = Converter::getBinDec($redBin);
                $green = Converter::getBinDec($greenBin);
                $blue = Converter::getBinDec($blueBin);

                $this->setPixel($x, $y, $red, $green, $blue);

                $position++;
            }
        }
    }

    function download()
    {
        header("Content-Type: image/png");
        header("Content-Lenght: " . filesize($this->image));
        header("Content-Disposition: atachment; filename=imagem.png");
        imagepng($this->image);
        imagedestroy($this->resource);
    }

    function getText(): string
    {
        $text = "";
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $pixel = $this->getPixel($x, $y);

                $redBin = Converter::getDecBin($pixel["red"]);
                $greenBin = Converter::getDecBin($pixel["green"]);
                $blueBin = Converter::getDecBin($pixel["blue"]);

                $charBin = substr($redBin, 5, 3) . substr($greenBin, 6, 2) . substr($blueBin, 5, 3);
                $char = Converter::getBinChar($charBin);

                if ($x == 0 && $y == 0 && $char != ">") die("Não existe nenhuma mensagem gravada nessa imagem");

                if ($char == "<") return $text;

                $text .= $char != ">" ? $char : "";
            }
        }
        die("Nenhuma mensagem gravada");
    }
}
