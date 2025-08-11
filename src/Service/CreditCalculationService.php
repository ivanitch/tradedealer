<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\CreditProgram;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;

/**
 * Сервис для расчета кредитного платежа и выбора кредитной программы.
 */
class CreditCalculationService
{
    /**
     * Выбирает подходящую кредитную программу и рассчитывает ежемесячный платеж.
     *
     * @param int $price Цена автомобиля
     * @param float $initialPayment Первоначальный взнос
     * @param int $loanTerm Срок кредита в месяцах
     * @return array Массив с информацией о кредитной программе и ежемесячном платеже
     * @throws NotFoundHttpException Если подходящая кредитная программа не найдена.
     * @throws BadRequestHttpException Если срок кредита равен нулю, что приводит к делению на нуль.
     */
    public function calculateLoan(int $price, float $initialPayment, int $loanTerm): array
    {

        if ($initialPayment > 200000 && $loanTerm < 60) {
            $program = CreditProgram::findOne(['interest_rate' => 12.3]);
        } else {
            $program = CreditProgram::find()->one();
        }

        if ($program === null) {
            throw new NotFoundHttpException('No suitable credit programs found.');
        }

        $loanAmount = $price - $initialPayment;

        if ($loanTerm == 0) {
            throw new BadRequestHttpException('Loan term cannot be zero.');
        }

        if ($program->interest_rate == 0) {
            $monthlyPayment = $loanAmount / $loanTerm;
        } else {
            $monthlyRate    = ($program->interest_rate / 100) / 12;
            $monthlyPayment = $loanAmount * ($monthlyRate + $monthlyRate / (pow(1 + $monthlyRate, $loanTerm) - 1));
        }

        return [
            'programId'      => $program->id,
            'interestRate'   => (float)$program->interest_rate,
            'monthlyPayment' => (int)round($monthlyPayment),
            'title'          => $program->title,
        ];
    }
}
