<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'property',
        'value',
        'init_date',
        'end_date',
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

    public function getInitDateAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setInitDateAttribute($value)
    {
        $this->attributes['init_date'] = (!empty($value) ? $this->convertStringToDate($value) : null);
    }

    public function getEndDateAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        return date('d/m/Y', strtotime($value));
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = (!empty($value) ? $this->convertStringToDate($value) : null);
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
