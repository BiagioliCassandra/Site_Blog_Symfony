<?php 
namespace App\Service;

class ForbiddenWord
{
    public function remplaceWord($contenu)
    {
        $forbiddenWord = ["cul", "bite", "chatte", "vagin", "penis", "connard", "fdp", "pd", "merde"];
        if(!empty($contenu))
        {
        $newContenu = preg_remplace($forbiddenWord, "#####", $contenu);
        return $newContenu;
        }
    }
}
?>