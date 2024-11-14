<?php

/**
 * A classe Layout é responsável por renderizar vistas e gerenciar alterações de layout.
 *
 * Métodos públicos:
 * - render(array $array = [], array $strings = []): ?string
 *   Este método renderiza uma vista com base nos parâmetros fornecidos.
 *   Parâmetros:
 *     - $array: Um array associativo que pode conter:
 *       - 'type': Tipo de visualização (padrão: 'public').
 *       - 'view': Nome da vista a ser renderizada.
 *       - 'include': Componentes a serem incluídos (padrão: todos).
 *       - 'page': Nome da página a ser definida.
 *       - 'layoutChange': Alterações de layout a serem aplicadas.
 *     - $strings: Um array de strings para substituição na vista.
 *   Retorna:
 *     - Uma string contendo o conteúdo renderizado ou null se a vista não for encontrada.
 *
 * Uso:
 * $html = Layout::render(['type' => 'private', 'view' => 'home/index.php', 'page' => 'Home', 'layoutChange' => ['pageName' => 'obaaa', 'pageTitle' => 'obaaa']], ['title' => 'Página Inicial']);
 * $html = Layout::render(['type' => 'private', 'view' => 'home/index.php', 'page' => 'Home'], ['title' => 'Página Inicial']);

 * echo $html; 
 */

namespace App\Services;

class Layout  extends ServiceHelper
{

    public static function render($array = [], $strings = []): ?string
    {

        // Definindo valores padrão para as variáveis
        $type = isset($array['type']) ? $array['type'] : 'public';
        $view = isset($array['view']) ? $array['view'] : null;
        $strings = isset($strings) ? $strings : [];
        $include = isset($array['include']) ? $array['include'] : [];
        $page = isset($array['page']) ? $array['page'] : null;
        $layoutChange = isset($array['layoutChange']) ? $array['layoutChange'] : null;


        // Verificando se a view foi definida e se o arquivo existe
        if ($view && file_exists(filename: parent::ROOT_PATH() . "/{$type}/views/{$view}")) {

            // Incluindo o layout se necessário
            if (array_search(needle: 'layout', haystack: $include) || !$include) {

                //verificar se tem apenas o parametro de nome da página
                if($page) {
                    $layoutChange['pageName'] = $page;
                }

                self::layoutChanges(filePath: 'resources/components/'.$type.'/htmlStarter/layout.php', replacements: $layoutChange);
            }

            // Incluindo o header, se necessário
            if (array_search(needle: 'navbar', haystack: $include) || !$include) {
                include_once "resources/components/$type/pageStructure/navbar.php";
            }

            // Extraindo as variáveis do array $strings para o escopo
            if ($strings) {
                extract(array: $strings);
            }

            // Incluindo a view
            include parent::ROOT_PATH() . "/{$type}/views/{$view}";

            // Incluindo o header, se necessário
            if (array_search(needle: 'footer', haystack: $include) || !$include) {
                include_once "resources/components/$type/pageStructure/footer.php";
            }
        }

        // Se a view não for encontrada ou não definida, retorna null
        return null;
    }

    private static function layoutChanges($filePath, $replacements): void
    {
        // Obtendo o conteúdo do arquivo
        $content = file_get_contents($filePath);
    
        // Criando as chaves no formato {{ key }} para fazer a substituição
        $search = array_map(callback: function($key): string {
            return '{{ ' . trim(string: $key) . ' }}'; // Envolvendo as chaves com {{ }}
        }, array: array_keys($replacements));
    
        // Realizando as substituições usando str_replace
        $content = str_replace(search: $search, replace: array_values(array: $replacements), subject: $content);
    
        // Incluindo o conteúdo processado
        echo $content;
    }
    
}
