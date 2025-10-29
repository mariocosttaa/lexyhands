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
 *       - 'include': Componentes a serem incluídos (padrão: todos). ou navbar ou footer, deixar em branc pra todos
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

    public static function render($array = [], $strings = [])
    {

        // Definindo valores padrão para as variáveis
        $type = isset($array['type']) ? $array['type'] : 'public';
        $view = isset($array['view']) ? $array['view'] : null;
        $strings = isset($strings) ? $strings : [];
        
        if(isset($array['components'])) {
            if($array['components'] !== false) {
                $components = $array['components'];
            } else {
                $components = false;
            }
        } else {
            $components = true;
        }

        $page = isset($array['page']) ? $array['page'] : null;
        $layoutChange = isset($array['layoutChange']) ? $array['layoutChange'] : null;


       

        // Verificando se a view foi definida e se o arquivo existe
        if ($view && file_exists(filename: parent::ROOT_PATH() . "/{$type}/views/{$view}")) {

            // Extraindo as variáveis do array $strings para o escopo
            if ($strings) {
                extract(array: $strings);
            }


            if($components !== false) {
                if(is_array(value: $components))  {
                    if (array_search(needle: 'layout', haystack: $components)) {
                        self::layoutChanges(page: $page, filePath: parent::ROOT_PATH() . '/resources/components/'.$type.'/htmlStarter/layout.php', replacements: $layoutChange);
                    }
                } else {
                    self::layoutChanges(page: $page, filePath: parent::ROOT_PATH() . '/resources/components/'.$type.'/htmlStarter/layout.php', replacements: $layoutChange);
                }
            }

            if($components !== false) {
                if(is_array(value: $components))  {
                    if (array_search(needle: 'navbar', haystack: $components)) {
                        self::defaultJs(); //incluir css padrao do layout
                        include_once parent::ROOT_PATH() . "/resources/components/$type/pageStructure/navbar.php";
                    }
                } else {
                    self::defaultJs(); //incluir css padrao do layout
                    include_once "resources/components/$type/pageStructure/navbar.php";
                }
            }


            // Incluindo a view
            include parent::ROOT_PATH() . "/{$type}/views/{$view}";


            if($components !== false) {
                if(is_array(value: $components))  {
                    if (array_search(needle: 'footer', haystack: $components)) {
                        self::defaultJs(); //incluir css padrao do layout
                        include_once parent::ROOT_PATH() . "/resources/components/$type/pageStructure/footer.php";
                    }
                } else {
                    self::defaultJs(); //incluir css padrao do layout
                    include_once parent::ROOT_PATH() . "/resources/components/$type/pageStructure/footer.php";
                }
            }


        }

        // Se a view não for encontrada ou não definida, retorna null
        return null;
    }

    private static function layoutChanges($page, $filePath, $replacements): void
    {
        if($page) {
            $replacements['pageName'] = $page;
        }

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

    private static function defaultCss() {
        $styles = '
            <!-- System Default Cs -->
            <link rel="stylesheet" media="screen" href="/../public/default/boxicons/css/boxicons.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <link href="/../public/default/icons.min.css" rel="stylesheet" type="text/css" />
        ';
        echo $styles;
    }

    private static function defaultJs() {
        $scripts = '
            <!-- System Default Js -->
            <script src="/../public/default/jquery-3.6.0.min.js"></script>

            <!-- SweetAlert JavaScript e Css -->
            <script src="/../public/default/services/sweetalert2/dist/sweetalert2.all.min.js"></script>

            <script src="/../public/default/system-dinamicAlerts.js"></script>
            
            <!---
            <script src="/../public/default/system.form.filter.js"></script>
            --->
            
            <!--- System Helps --->
            <script src="public/assets/default/js/helpers/modal-url-param.js"></script>
            ';
        echo $scripts;
    }
    
}
