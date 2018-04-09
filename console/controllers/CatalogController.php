<?php
namespace console\controllers;

use yii\console\Controller;
use yii\console\ExitCode;

use common\models\engine\CatalogModel;
use common\models\engine\ExceptionLogModel;

class CatalogController extends Controller
{
    public function actionNestedSetsClear(){
        try{
            CatalogModel::ClearNestedSets();

            $this->stdout("Nested Sets is clear");

            return ExitCode::OK;
        } catch(\Exception $ex) {
            ExceptionLogModel::Run($ex);

            $this->stdout($ex->getMessage());

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }

    public function actionNestedSetsRun(){
        try{
            CatalogModel::NestedSetsRun();

            $this->stdout("Nested Sets is set value");

            return ExitCode::OK;
        } catch(\Exception $ex) {
            ExceptionLogModel::Run($ex);

            $this->stdout($ex->getMessage());

            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}