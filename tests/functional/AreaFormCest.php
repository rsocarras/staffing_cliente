<?php

use Da\User\Model\User;

class AreaFormCest
{
    public function _before(\FunctionalTester $I)
    {
        $user = User::find()->andWhere(['username' => 'admin'])->one();
        if ($user) {
            $I->amLoggedInAs($user);
        }
    }

    public function openCreatePage(\FunctionalTester $I)
    {
        $I->amOnRoute('area/create');
        $I->see('Create Area', 'h1');
        $I->seeElement('form');
        $I->seeElement('input[name="Area[nombre]"]');
        $I->seeElement('input[name="Area[descripcion]"]');
        $I->seeElement('input[name="Area[area_padre]"]');
        $I->dontSeeElement('input[name="Area[uuid]"]');
        $I->dontSeeElement('input[name="Area[user_create]"]');
        $I->dontSeeElement('input[name="Area[empresas_id]"]');
    }

    public function createWithEmptyNombre(\FunctionalTester $I)
    {
        $I->amOnRoute('area/create');
        $I->submitForm('form', [
            'Area[nombre]' => '',
            'Area[descripcion]' => 'Descripción de prueba',
            'Area[area_padre]' => '',
        ]);
        $I->expectTo('see validation errors');
        $I->see('Nombre cannot be blank', '.help-block');
    }

    public function createWithValidData(\FunctionalTester $I)
    {
        $I->amOnRoute('area/create');
        $nombre = 'Area Test ' . time();
        $I->submitForm('form', [
            'Area[nombre]' => $nombre,
            'Area[descripcion]' => 'Descripcion de area de prueba',
            'Area[area_padre]' => '',
        ]);
        $I->expectTo('be redirected to view page after successful create');
        $I->dontSee('Create Area', 'h1');
        $I->see($nombre);
        $I->see('Update');
        $I->see('Delete');
    }

    public function updateArea(\FunctionalTester $I)
    {
        $area = \app\models\Area::find()->one();
        if (!$area) {
            $I->comment('No hay áreas en la BD, saltando test de actualización');
            return;
        }
        $I->amOnRoute('area/update', ['id' => $area->id]);
        $I->see('Update Area', 'h1');
        $I->seeInField('Area[nombre]', $area->nombre);
        $I->submitForm('form', [
            'Area[nombre]' => $area->nombre . ' Actualizado',
            'Area[descripcion]' => $area->descripcion ?? '',
            'Area[area_padre]' => $area->area_padre ?? '',
        ]);
        $I->see($area->nombre . ' Actualizado');
    }
}
