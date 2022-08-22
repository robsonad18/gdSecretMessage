<?php 

require __DIR__."/vendor/autoload.php";

require __DIR__ . "/includes/header.php";

require __DIR__ . "/includes/form.php";

require __DIR__ . "/includes/footer.php";

use \App\File\Image;

new class 
{
    function __construct()
    {
        if (isset($_POST["esconder"])) 
        {
            $obImage = new Image($_FILES["imagem"]);
            $obImage->setText($_POST["texto"]);
            $obImage->download();
        }

        $text = "";
        if (isset($_POST["ler"]))
        {
            $obImage = new Image($_FILES["imagem"]);
            $text = $obImage->getText();
            print($text);
        }
    }
};

