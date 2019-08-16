<?php

namespace app\controllers;


class ImagesShow extends Controller
{
    public static function getType(): string
    {
        return parent::UPDATING;
    }

    public function getDataForView(string $viewname, $params=[]): array
    {
        // TODO: Implement getDataForView() method.
    }
}