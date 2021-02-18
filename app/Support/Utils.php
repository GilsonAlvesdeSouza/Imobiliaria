<?php


namespace LaraDev\Support;


class Utils
{
    /**
     * Limpa a string para ficar no padrão a ser salvo na base de dados
     * @param string|null $param
     * @return string|string[]
     */
    public static function clearField(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }

    /**
     * converte string em data para ficar no padrão a ser salvo na base de dados
     * @param string|null $param
     * @return string|null
     */
    public static function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime("$day-$month-$year"))->format("Y-m-d");
    }

    /**
     * converte data da base de dados para o formato PT-br
     * @param string|null $param
     * @return false|string|null
     */
    public static function convertDateToString(?string $param)
    {
        if (empty($param)){
            return null;
        }
        return date("d/m/Y", strtotime($param));
    }

    /**
     * converte string para double para ficar no padrão a ser salvo na base de dados
     * @param string|null $param
     * @return float|null
     */
    public static function convertStringToDouble(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return doubleval(str_replace(',', '.', str_replace('.', '', $param)));
    }

    /**
     * converte o valor da renda do cliente na base de dados em formato de moeda
     * @param $param
     * @return string|null
     */
    public static function convertFloatToCurrency($param)
    {
        if (empty($param)) {
            return null;
        }
        return number_format($param, '2', ',', '.');
    }

    /**
     * Seta o valor do checkbox para ser salvo na base de dados
     * @param $value
     * @return int
     */
    public static function setValueCheckBox($value )
    {
       return ($value === true || $value == 'on'  ? 1 : 0);
    }
}
