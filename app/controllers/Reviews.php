<?php

namespace app\controllers;


class Reviews extends Controller
{
    public function __construct()
    {
    }

    public static function getType(): string
    {
        return parent::SINGLE;
    }

    public function getDataForView(string $viewname)
    {
        // TODO: Implement getDataForView() method.
    }
}