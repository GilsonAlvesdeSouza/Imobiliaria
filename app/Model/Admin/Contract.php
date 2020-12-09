<?php

namespace LaraDev\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use LaraDev\Support\Utils;

class Contract extends Model
{
    protected $fillable = [
        'sale',
        'rent',
        'owner',
        'owner_spouse',
        'owner_company',
        'acquirer',
        'acquirer_spouse',
        'acquirer_company',
        'property',
        'sale_price',
        'rent_price',
        'price',
        'tribute',
        'condominium',
        'due_date',
        'deadline',
        'start_at',
        'status'
    ];

    public function setSaleAttribute($value)
    {
        if ($value === true || $value === 'on') {
            $this->attributes['sale'] = 1;
            $this->attributes['rent'] = 0;
        }
    }

    public function setRentAttribute($value)
    {
        if ($value === true || $value === 'on') {
            $this->attributes['rent'] = 1;
            $this->attributes['sale'] = 0;
        }
    }

    public function setOwnerSpouseAttribute($value)
    {
        $this->attributes['owner_spouse'] = ($value === '1' ? 1 : 0);
    }

    public function setOwnerCompanyAttribute($value)
    {
        $this->attributes['owner_company'] = ($value === '0' ? null : $value);
    }

    public function setAcquirerSpouseAttribute($value)
    {
        $this->attributes['acquirer_spouse'] = ($value === '1' ? 1 : 0);
    }

    public function setAcquirerCompanyAttribute($value)
    {
        $this->attributes['acquirer_company'] = ($value === '0' ? null : $value);
    }

    public function getPriceAttribute($value)
    {
        return Utils::convertFloatToCurrency($value);
    }

    public function setSalePriceAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['price'] = Utils::convertStringToDouble($value);
        }
    }

    public function setRentPriceAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['price'] = Utils::convertStringToDouble($value);
        }
    }

    public function getTributeAttribute($value)
    {
        return Utils::convertFloatToCurrency($value);
    }

    public function setTributeAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['tribute'] = Utils::convertStringToDouble($value);
        }
    }

    public function getCondominiumAttribute($value)
    {
        return Utils::convertFloatToCurrency($value);

    }

    public function setCondominiumAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['condominium'] = Utils::convertStringToDouble($value);
        }
    }

    public function getStartAtAttribute($value)
    {
        return Utils::convertDateToString($value);
    }

    public function setStartAtAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['start_at'] = Utils::convertStringToDate($value);
        }
    }
}
