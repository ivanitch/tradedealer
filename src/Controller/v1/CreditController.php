<?php

declare(strict_types=1);

namespace App\Controller\v1;

use App\Model\CreditRequest;
use App\Model\Form\CreditCalculateForm;
use App\Service\CreditCalculationService;
use Exception;
use Yii;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class CreditController extends Controller
{
    private CreditCalculationService $creditCalculationService;

    public function __construct($id, $module, CreditCalculationService $creditCalculationService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->creditCalculationService = $creditCalculationService;
    }

    /**
     * Расчет кредита (калькулятор)
     *
     * @return array
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCalculate(): array
    {
        $calculateForm = new CreditCalculateForm();

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

    /**
     * Заявка на кредит
     *
     * @return array
     * @throws BadRequestHttpException
     * @throws Exception
     */
    public function actionRequest(): array
    {
        $request = new CreditRequest();

        $bodyParams = Yii::$app->request->getBodyParams();

        $request->car_id          = isset($bodyParams['carId']) ? (int)$bodyParams['carId'] : null;
        $request->program_id      = isset($bodyParams['programId']) ? (int)$bodyParams['programId'] : null;
        $request->initial_payment = isset($bodyParams['initialPayment']) ? (float)$bodyParams['initialPayment'] : null;
        $request->loan_term       = isset($bodyParams['loanTerm']) ? (int)$bodyParams['loanTerm'] : null;

        if (!$request->validate()) {
            throw new BadRequestHttpException('Validation failed: ' . print_r($request->getErrors(), true));
        }

        if ($request->save()) {
            return ['success' => true];
        } else {
            Yii::error('Failed to save request: ' . print_r($request->getErrors(), true), __METHOD__);
            throw new BadRequestHttpException('Failed to save request: ' . print_r($request->getErrors(), true));
        }
    }
}
