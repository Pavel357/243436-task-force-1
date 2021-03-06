<?php

namespace frontend\models;

use yii\base\Model;

class TasksForm extends Model
{
    public $category;

    public $more;

    public $period;

    public $search;

    const NOT_EXECUTOR = 'Без исполнителя';
    const DISTANT_WORK = 'Удаленная работа';
    const DAY = 'day';
    const WEEK = 'week';
    const MONTH = 'month';

    public function rules()
    {
        return [
            [['category', 'more', 'period', 'search'], 'safe'],
        ];
    }

    public function periodList()
    {
        return [self::DAY => 'За день', self::WEEK => 'За неделю', self::MONTH => 'За месяц'];
    }

    public function moreList()
    {
        return [self::NOT_EXECUTOR => 'Без исполнителя', self::DISTANT_WORK => 'Удаленная работа'];
    }
}
