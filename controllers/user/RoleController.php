<?php

namespace app\controllers\user;

use Da\User\Controller\RoleController as BaseRoleController;
use Da\User\Model\AbstractAuthItem;
use Da\User\Validator\AjaxRequestModelValidator;
use Yii;

class RoleController extends BaseRoleController
{
    public function actionUpdate($name)
    {
        $authItem = $this->getItem($name);

        /** @var AbstractAuthItem $model */
        $model = $this->make($this->getModelClass(), [], ['scenario' => 'update', 'item' => $authItem]);

        $this->make(AjaxRequestModelValidator::class, [$model])->validate();

        if ($model->load(Yii::$app->request->post())) {
            $errorMessage = null;
            if ($this->saveAuthItemWithDetails($model, $errorMessage)) {
                Yii::$app->getSession()->setFlash('success', Yii::t('usuario', 'Authorization item successfully updated.'));
                return $this->redirect(['index']);
            }

            $details = $this->flattenErrors($model);
            $flash = Yii::t('usuario', 'Unable to update authorization item.');
            if (!empty($details)) {
                $flash .= ' ' . implode(' | ', $details);
            } elseif (!empty($errorMessage)) {
                $flash .= ' ' . $errorMessage;
            }
            Yii::$app->getSession()->setFlash('danger', $flash);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
                'unassignedItems' => $this->authHelper->getUnassignedItems($model),
                'module' => $this->module,
            ]
        );
    }

    private function saveAuthItemWithDetails(AbstractAuthItem $model, ?string &$errorMessage = null): bool
    {
        if (!$model->validate()) {
            $errorMessage = 'Validation failed.';
            return false;
        }

        $auth = Yii::$app->authManager;

        try {
            if ($model->getIsNewRecord()) {
                $item = $auth->createRole($model->name);
            } else {
                $item = $model->item;
            }

            $item->name = $model->name;
            $item->description = $model->description;
            $item->ruleName = !empty($model->rule) ? $model->rule : null;

            if ($model->getIsNewRecord()) {
                if (!$auth->add($item)) {
                    $model->addError('name', 'No fue posible crear el role.');
                    $errorMessage = 'RBAC add() returned false.';
                    return false;
                }
            } else {
                if (!$auth->update($model->itemName, $item)) {
                    $model->addError('name', 'No fue posible actualizar el role.');
                    $errorMessage = 'RBAC update() returned false.';
                    return false;
                }
                $model->itemName = $item->name;
            }

            $model->item = $item;

            if (!$this->updateChildrenWithDetails($model, $errorMessage)) {
                return false;
            }
        } catch (\Throwable $e) {
            $model->addError('name', $e->getMessage());
            $errorMessage = $e->getMessage();
            return false;
        }

        return true;
    }

    private function updateChildrenWithDetails(AbstractAuthItem $model, ?string &$errorMessage = null): bool
    {
        $auth = Yii::$app->authManager;
        $children = $auth->getChildren($model->item->name);
        $childrenNames = array_keys($children);
        $requestedChildren = is_array($model->children) ? $model->children : [];

        foreach (array_diff($childrenNames, $requestedChildren) as $childName) {
            if (!$auth->removeChild($model->item, $children[$childName])) {
                $model->addError('children', "No fue posible remover el hijo '{$childName}'.");
                $errorMessage = "removeChild failed for '{$childName}'.";
                return false;
            }
        }

        foreach (array_diff($requestedChildren, $childrenNames) as $childName) {
            $childItem = $auth->getItem($childName);
            if ($childItem === null) {
                $model->addError('children', "El ítem RBAC '{$childName}' no existe.");
                $errorMessage = "Child item '{$childName}' not found.";
                return false;
            }

            if (!$auth->addChild($model->item, $childItem)) {
                $model->addError('children', "No fue posible asignar '{$childName}' (posible jerarquía inválida o circular).");
                $errorMessage = "addChild failed for '{$childName}'.";
                return false;
            }
        }

        return true;
    }

    private function flattenErrors(AbstractAuthItem $model): array
    {
        $errors = [];
        foreach ($model->getErrors() as $attribute => $messages) {
            foreach ((array) $messages as $message) {
                $errors[] = "{$attribute}: {$message}";
            }
        }
        return $errors;
    }
}
