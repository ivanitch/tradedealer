<?php

namespace App\Controller\v1;


use App\Controller\BaseRestController;
use App\Model\Form\CreditCalculateForm;
use App\Service\CreditCalculationService;
use App\Service\CreditRequestService;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use Exception;

class CreditController extends BaseRestController
{
    public function __construct(
        $id,
        $module,
        private readonly CreditCalculationService $creditCalculationService,
        private readonly CreditRequestService $requestService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
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

        $calculateForm->price          = isset($this->args['price']) ? (int)$this->args['price'] : null;
        $calculateForm->initialPayment = isset($this->args['initialPayment']) ? (float)$this->args['initialPayment'] : null;
        $calculateForm->loanTerm       = isset($this->args['loanTerm']) ? (int)$this->args['loanTerm'] : null;

        if (is_null($calculateForm->price) || is_null($calculateForm->initialPayment) || is_null($calculateForm->loanTerm)) {
            throw new BadRequestHttpException('Missing or invalid required parameters.');
        }

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
        $carId          = isset($this->bodyParams['carId']) ? (int)$this->bodyParams['carId'] : null;
        $programId      = isset($this->bodyParams['programId']) ? (int)$this->bodyParams['programId'] : null;
        $initialPayment = isset($this->bodyParams['initialPayment']) ? (float)$this->bodyParams['initialPayment'] : null;
        $loanTerm       = isset($this->bodyParams['loanTerm']) ? (int)$this->bodyParams['loanTerm'] : null;

        if (is_null($carId) || is_null($programId) || is_null($initialPayment) || is_null($loanTerm)) {
            throw new BadRequestHttpException('Missing or invalid required parameters.');
        }

        if ($this->requestService->save($carId, $programId, $initialPayment, $loanTerm)) {
            return ['success' => true];
        } else {
            throw new BadRequestHttpException('Failed to process request.');
        }
    }
}
