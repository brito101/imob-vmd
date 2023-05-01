<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'property',
        'value',
        'date_of_sale',
    ];

    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return number_format($value, 2, ',', '.');
    }

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = (!empty($value) ? floatval($this->convertStringToDouble($value)) : null);
    }

    public function getDateOfSaleAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setDateOfSaleAttribute($value)
    {
        $this->attributes['date_of_sale'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }

    public function propertyObject()
    {
        return Property::find($this->property);
    }

    /**
     * Aux Functions
     */
    private function convertStringToDouble($param)
    {
        if (empty($param)) {
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }

    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }
        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }
}
