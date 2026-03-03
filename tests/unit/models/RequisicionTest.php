<?php

namespace tests\unit\models;

use app\models\Requisicion;

class RequisicionTest extends \Codeception\Test\Unit
{
    public function testOptsEstadoContieneEstadosEsperados()
    {
        $opts = Requisicion::optsEstado();
        verify($opts)->arrayHasKey(Requisicion::ESTADO_DRAFT);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_APPROVAL_PENDING);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_APPROVED);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_REJECTED);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_ORDER_PENDING);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_PERSON_ASSIGNED);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_HIRING_IN_PROGRESS);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_ACTIVE);
        verify($opts)->arrayHasKey(Requisicion::ESTADO_CANCELLED);
    }

    public function testIsEditableSoloEnDraft()
    {
        $model = new Requisicion();
        $model->estado = Requisicion::ESTADO_DRAFT;
        verify($model->isEditable())->true();

        $model->estado = Requisicion::ESTADO_SUBMITTED;
        verify($model->isEditable())->false();

        $model->estado = Requisicion::ESTADO_ACTIVE;
        verify($model->isEditable())->false();
    }

    public function testIsMaestraCuandoNoTieneParent()
    {
        $model = new Requisicion();
        $model->parent_id = null;
        verify($model->isMaestra())->true();

        $model->parent_id = 1;
        verify($model->isMaestra())->false();
    }

    public function testValidacionNumeroVacantesMinimo()
    {
        $model = new Requisicion();
        $model->numero_vacantes = 0;
        $model->validate(['numero_vacantes']);
        verify($model->hasErrors('numero_vacantes'))->true();

        $model->numero_vacantes = 1;
        $model->validate(['numero_vacantes']);
        verify($model->hasErrors('numero_vacantes'))->false();
    }

    public function testValidacionSalarioAuxilioNoNegativos()
    {
        $model = new Requisicion();
        $model->salario = -100;
        $model->validate(['salario']);
        verify($model->hasErrors('salario'))->true();

        $model->salario = 0;
        $model->validate(['salario']);
        verify($model->hasErrors('salario'))->false();
    }
}
