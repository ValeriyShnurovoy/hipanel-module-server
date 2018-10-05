<?php

namespace hipanel\modules\server\models;

/**
 * Class Consumption
 *
 * @property string $type
 * @property float[] $value
 * @property float[] $overuse
 */
class Consumption extends \hipanel\base\Model
{
    use \hipanel\base\ModelTrait;

    public function rules()
    {
        return [
            [['id', 'object_id'], 'integer'],
            [['value', 'overuse'], 'safe'],
            [['type', 'limit', 'time', 'unit', 'action_unit', 'currency'], 'string'],
            [['price'], 'number'],
        ];
    }

    public function getCurrentValue(): ?string
    {
        return $this->value[$this->getCurrent()];
    }

    public function getCurrentOveruse(): ?string
    {
        return $this->overuse[$this->getCurrent()];
    }

    public function getPreviousValue(): ?string
    {
        return $this->value[$this->getPrevious()];
    }

    public function getPreviousOveruse(): ?string
    {
        return $this->overuse[$this->getPrevious()];
    }

    private function getCurrent(): string
    {
        return date('m');
    }

    private function getPrevious(): string
    {
        return date('m', strtotime('-1month'));
    }
}