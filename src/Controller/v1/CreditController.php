<?php

declare(strict_types=1);

namespace App\Controller\v1;

use App\Model\Form\CalculateForm;
use App\Service\CreditCalculationService;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use Yii;

class CreditController extends Controller
{
    private CreditCalculationService $creditCalculationService;

    public function __construct($id, $module, CreditCalculationService $creditCalculationService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->creditCalculationService = $creditCalculationService;
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCalculate(): array
    {
        $calculateForm = new CalculateForm();

        $calculateForm->price          = (int)Yii::$app->request->get('price');
        $calculateForm->initialPayment = (float)Yii::$app->request->get('initialPayment');
        $calculateForm->loanTerm       = (int)Yii::$app->request->get('loanTerm');

        if (!$calculateForm->validate()) {
            throw new BadRequestHttpException('Validation failed: ' . print_r($calculateForm->getErrors(), true));
        }

        return $this->creditCalculationService->calculateLoan(
            $calculateForm->price,
            $calculateForm->initialPayment,
            $calculateForm->loanTerm
        );
    }
}
