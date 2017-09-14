<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 01/12/16
 * Time: 15:48
 */

namespace PhpLight\Framework\Controller;


use Knp\Snappy\Pdf;
use PhpLight\Framework\Components\Parameters;

class Controller implements ControllerInterface
{
    /**
     * @param string $templateDir Directory containing the template
     * @param string $template Template full file name
     * @param array $data Data to inject to the template
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