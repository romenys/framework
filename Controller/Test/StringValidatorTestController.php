<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 04/01/17
 * Time: 01:20
 */

namespace Romenys\Framework\Controller\Test;

use Romenys\Framework\Controller\Controller;
use Romenys\Framework\Validator\Validators\StringValidator;

class StringValidatorTestController extends Controller
{
    public function validateStringTestAction()
    {
        $this->minLengthStrategyTest();
        $this->maxLengthStrategyTest();
        $this->alphaOnlyStrategyTest();

        $this->allStrategiesTest();
    }

    private function minLengthStrategyTest()
    {
        $params["constraints"]["minLength"] = 3;
        $stringValidator = new StringValidator('sdfsf', $params);
        dump($stringValidator->isValid());

        $params["constraints"]["minLength"] = 3;
        $stringValidator = new StringValidator('s', $params);
        dump(["isValid" => !$stringValidator->isValid(), "errors" => $stringValidator->getErrors()]);
    }

    private function maxLengthStrategyTest()
    {
        $params["constraints"]["maxLength"] = 5;
        $stringValidator = new StringValidator('a long sentense', $params);
        dump(["isValid" => !$stringValidator->isValid(), "errors" => $stringValidator->getErrors()]);

        $params["constraints"]["maxLength"] = 15;
        $stringValidator = new StringValidator('a long sentense', $params);
        dump($stringValidator->isValid());
    }

    private function alphaOnlyStrategyTest()
    {
        $params["constraints"]["alphaOnly"] = true;
        $stringValidator = new StringValidator("Une chaine alpha", $params);
        dump($stringValidator->isValid());

        $stringValidator = new StringValidator("une fausse a1ph4", $params);
        dump(["isValid" => !$stringValidator->isValid(), "errors" => $stringValidator->getErrors()]);

        $params["constraints"]["alphaOnly"] = false;
        $stringValidator = new StringValidator("Une chaine alpha", $params);
        dump(["isValid" => !$stringValidator->isValid(), "errors" => $stringValidator->getErrors()]);

        $stringValidator = new StringValidator("une fausse a1ph4", $params);
        dump(["isValid" => !$stringValidator->isValid(), "errors" => $stringValidator->getErrors()]);
    }

    private function allStrategiesTest()
    {
        $params["constraints"]["maxLength"] = 10;
        $params["constraints"]["minLength"] = 3;
        $params["constraints"]["alphaOnly"] = true;

        $min = new StringValidator("a", $params);
        dump(["isValid" => !$min->isValid(), "errors" => $min->getErrors()]);

        $max = new StringValidator("very loooong sentense", $params);
        dump(["isValid" => !$max->isValid(), "errors"=> $max->getErrors()]);

        $min = new StringValidator("a", $params);
        dump(["isValid" => !$min->isValid(), "errors" => $min->getErrors()]);

        $max = new StringValidator("loooong", $params);
        dump($max->isValid());

        $alpha = new StringValidator("12loooong", $params);
        dump(["isValid" => !$alpha->isValid(), "errors" => $alpha->getErrors()]);

        $alpha = new StringValidator("will pass", $params);
        dump(["isValid" => $alpha->isValid(), "errors" => $alpha->getErrors()]);

        $params["constraints"]["alphaOnly"] = false;
        $alpha = new StringValidator("not fail", $params);
        dump(["isValid" => !$alpha->isValid(), "errors" => $alpha->getErrors()]);
    }
}
