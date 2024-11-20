<?php

namespace App\Services;

class SlugGenerator extends ServiceHelper
{
    /**
     * Gera um slug amigável para URLs a partir de um título.
     *
     * @param string $string O título original.
     * @return string O slug gerado.
     */
    public function generate(string $string): mixed
    {
        if(empty($string)) return false;

        // Converte para minúsculas.
        $slug = mb_strtolower($string, 'UTF-8');

        // Remove acentos e caracteres especiais.
        $slug = self::removeAccents($slug);

        // Substitui espaços e outros separadores por hífens.
        $slug = preg_replace('/[^\w\s-]/', '', $slug); // Remove caracteres não alfanuméricos.
        $slug = preg_replace('/[\s-]+/', '-', $slug);  // Substitui espaços ou hífens múltiplos por um único hífen.

        // Remove hífens no início ou no final.
        $slug = trim($slug, '-');

        return $slug;
    }


     /**
     * Converte um slug de volta para texto legível.
     *
     * @param string $slug O slug.
     * @return string O texto original aproximado.
     */
    public function deslug(string $string): mixed
    {

        if(empty($string)) return false;

        // Substitui hífens por espaços.
        $text = str_replace('-', ' ', $string);

        // Capitaliza a primeira letra de cada palavra.
        $text = ucwords($text);

        return $text;
    }

    /**
     * Remove acentos e caracteres especiais de uma string.
     *
     * @param string $string A string original.
     * @return string A string sem acentos.
     */
    private static function removeAccents(string $string): string
    {
        $unwantedArray = [
            'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i',
            'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u',
            'ç' => 'c', 'ñ' => 'n',
            'Á' => 'a', 'À' => 'a', 'Ã' => 'a', 'Â' => 'a', 'Ä' => 'a',
            'É' => 'e', 'È' => 'e', 'Ê' => 'e', 'Ë' => 'e',
            'Í' => 'i', 'Ì' => 'i', 'Î' => 'i', 'Ï' => 'i',
            'Ó' => 'o', 'Ò' => 'o', 'Õ' => 'o', 'Ô' => 'o', 'Ö' => 'o',
            'Ú' => 'u', 'Ù' => 'u', 'Û' => 'u', 'Ü' => 'u',
            'Ç' => 'c', 'Ñ' => 'n'
        ];
        return strtr($string, $unwantedArray);
    }
}
