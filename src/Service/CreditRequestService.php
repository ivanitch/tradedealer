<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\CreditRequest;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use Yii;

/**
 * Сервис для обработки и сохранения кредитных заявок.
 */
class CreditRequestService
{
    /**
     * Новая заявка на кредит
     *
     * @param int $carId ID автомобиля
     * @param int $programId ID кредитной программы
     * @param float $initialPayment Первоначальный взнос
     * @param int $loanTerm Срок кредита в месяцах
     *
     * @return bool Успешно ли сохранена заявка
     *
     * @throws BadRequestHttpException|Exception
     */
    public function save(int $carId, int $programId, float $initialPayment, int $loanTerm): bool
    {
        $request = new CreditRequest();

        $request->car_id          = $carId;
        $request->program_id      = $programId;
        $request->initial_payment = $initialPayment;
        $request->loan_term       = $loanTerm;

        if (!$request->validate()) {
            Yii::error('Failed to validate request model before saving: ' . print_r($request->getErrors(), true), __METHOD__);
            throw new BadRequestHttpException('Failed to save request due to validation errors: ' . print_r($request->getErrors(), true));
        }

        if ($request->save()) {
            return true;
        } else {
            Yii::error('Failed to save request to database: ' . print_r($request->getErrors(), true), __METHOD__);
            throw new BadRequestHttpException('Failed to save request: ' . print_r($request->getErrors(), true));
        }
    }
}
