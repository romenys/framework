<?php

namespace PhpLight\Framework\Controller;

Interface ControllerInterface
{
    /**
     *
     *
     * @param $templateDir
     * @param $template
     * @param $data
     *
     * @return mixed
     */
    public function render($templateDir, $template, $data);
}