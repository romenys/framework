<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 01/12/16
 * Time: 15:48
 */

namespace PhpLight\Framework\Controller;


use PhpLight\Framework\Components\Parameters;

class Controller
{
    /**
     * @param string $templateDir Directory containing the template
     * @param string $template Template full file name
     * @param array $data Data to inject to the template
     *
     * @throws \Twig_Error_Loader  When the template cannot be found
     * @throws \Twig_Error_Syntax  When an error occurred during compilation
     * @throws \Twig_Error_Runtime When an error occurred during rendering
     *
     * @return string
     */
    public function render($templateDir, $template, $data)
    {
        $parameters = new Parameters();
        $cache = $parameters->getParameters()["cache"];

        $loader = new \Twig_Loader_Filesystem($templateDir);
        $twig = new \Twig_Environment($loader, [
            "cache" => $cache,
            'debug' => true
        ]);

        return $twig->render($template, $data);
    }
}