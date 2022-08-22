<?php 

use \App\File\Image;

new class 
{
    function __construct()
    {
        if (isset($_POST["esconder"])) 
        {
            $obImage = new Image($_FILES["imagem"]);
            $obImage->setText($_POST["texto"]);
        }
    }
};

require __DIR__."/vendor/autoload.php";

require __DIR__."/includes/header.php";

require __DIR__."/includes/form.php";

require __DIR__."/includes/footer.php";