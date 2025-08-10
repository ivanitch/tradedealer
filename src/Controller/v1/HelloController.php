<?php

declare(strict_types=1);

namespace App\Controller\v1;

use App\Controller\BaseRestController;
use Yii;

class HelloController extends BaseRestController
{
    public function actionIndex(): string
    {
        return 'Hello, world! 👋 | Yii version ' . Yii::getVersion();
    }
}
