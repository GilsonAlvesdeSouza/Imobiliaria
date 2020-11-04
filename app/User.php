<?php

namespace LaraDev;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use LaraDev\Model\Admin\Company;
use LaraDev\Suporte\Cropper;
use LaraDev\Support\Utils;
use phpDocumentor\Reflection\Types\Object_;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'genre',
        'document',
        'document_secondary',
        'document_secondary_complement',
        'date_of_birth',
        'place_of_birth',
        'civil_status',
        'cover',
        'occupation',
        'income',
        'company_work',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'state',
        'city',
        'telephone',
        'cell',
        'type_of_communion',
        'spouse_name',
        'spouse_genre',
        'spouse_document',
        'spouse_document_secondary',
        'spouse_document_secondary_complement',
        'spouse_date_of_birth',
        'spouse_place_of_birth',
        'spouse_occupation',
        'spouse_income',
        'spouse_company_work',
        'lessor',
        'lessee',
        'admin',
        'client'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'user', 'id');
    }

    public function getUrlCoverAttribute()
    {
        if (!empty($this->cover)) {
            return Storage::url(Cropper::thumb($this->cover, 500, 500));
        }
        return '';
    }

    /**
     * @param $value
     */
    public function setLessorAttribute($value)
    {
        $this->attributes['lessor'] = Utils::setValueCheckBox($value);
    }

    public function setLesseeAttribute($value)
    {
        $this->attributes['lessee'] = Utils::setValueCheckBox($value);
    }

    public function getDocumentAttribute($value)
    {
        return substr($value, 0, 3) . "." . substr($value, 3, 3) . "." . substr($value, 6, 3) . "-" . substr($value, 9, 2);
    }

    public function setDocumentAttribute($value)
    {
        $this->attributes['document'] = Utils::clearField($value);
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Utils::convertStringToDate($value);
    }

    public function getDateOfBirthAttribute($value)
    {
        return Utils::convertDateToString($value);
    }

    public function setIncomeAttribute($value)
    {
        $this->attributes['income'] = Utils::convertStringToDouble($value);
    }

    public function getIncomeAttribute($value)
    {
        return Utils::convertFloatToCurrency($value);
    }

    public function setZipcodeAttribute($value)
    {
        $this->attributes['zipcode'] = Utils::clearField($value);
    }

    public function getTelephoneAttribute($value)
    {
        return substr($value, 0, 0) . '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . '-' . substr($value, 7, 4);
    }

    public function setTelephoneAttribute($value)
    {
        $this->attributes['telephone'] = Utils::clearField($value);
    }

    public function getCellAttribute($value)
    {
        return substr($value, 0, 0) . '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . '-' . substr($value, 7, 4);
    }

    public function setCellAttribute($value)
    {
        $this->attributes['cell'] = Utils::clearField($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setSpouseDocumentAttribute($value)
    {
        $this->attributes['spouse_document'] = Utils::clearField($value);
    }

    public function setSpouseDateOfBirthAttribute($value)
    {
        $this->attributes['spouse_date_of_birth'] = Utils::convertStringToDate($value);
    }

    public function getSpouseDateOfBirthAttribute($value)
    {
        return Utils::convertDateToString($value);
    }

    public function setSpouseIncomeAttribute($value)
    {
        $this->attributes['spouse_income'] = Utils::convertStringToDouble($value);
    }

    public function getSpouseIncomeAttribute($value)
    {
        return Utils::convertFloatToCurrency($value);
    }

    public function setAdminAttribute($value)
    {
        $this->attributes['admin'] = Utils::setValueCheckBox($value);
    }

    public function setClientAttribute($value)
    {
        $this->attributes['client'] = Utils::setValueCheckBox($value);
    }

}
