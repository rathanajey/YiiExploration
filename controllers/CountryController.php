<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;
use Yii;
use app\models\CountryForm;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionUpdateCountry()
    {
        $model=new CountryForm();
        if($model->load(Yii::$app->request->post())){
            $query=Yii::$app->db->createCommand()->update('country',
             ['name'=>$model->name, 'code'=>$model->code, 'population'=>$model->population],
             ['code'=>$model->code])
             ->execute();
            $query = Country::find();
            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);
            $countries = $query->orderBy('name')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
                return $this->render('index',[
                    'countries'=>$countries,
                    'pagination'=>$pagination,
                    ]);
        }
        else{
            return $this->render('update-country',['model'=>$model]);
        }
    }
}