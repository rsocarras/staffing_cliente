<?php

namespace app\controllers;

use app\models\AuthAssignment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Gestión de roles y permisos RBAC.
 */
class RbacController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'role-delete' => ['POST'],
                    'permission-delete' => ['POST'],
                    'role-create-ajax' => ['POST'],
                    'role-update-ajax' => ['POST'],
                    'permission-create-ajax' => ['POST'],
                    'permission-update-ajax' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Listado de roles.
     */
    public function actionRoles()
    {
        $auth = Yii::$app->authManager;
        $allPermissions = $auth->getPermissions();
        return $this->render('roles', [
            'allPermissions' => $allPermissions,
        ]);
    }

    /**
     * JSON para DataTables server-side (roles).
     */
    public function actionRoleData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = trim($request->get('search', [])['value'] ?? '');
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 0);
        $orderDir = (strtolower($request->get('order', [])[0]['dir'] ?? 'asc') === 'desc') ? -1 : 1;

        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        $items = [];
        foreach ($roles as $name => $role) {
            $items[] = [
                'name' => $name,
                'description' => (string) ($role->description ?? ''),
            ];
        }
        $totalCount = count($items);

        if ($searchValue !== '') {
            $search = mb_strtolower($searchValue);
            $items = array_values(array_filter($items, function ($r) use ($search) {
                return (strpos(mb_strtolower($r['name']), $search) !== false)
                    || (strpos(mb_strtolower($r['description']), $search) !== false);
            }));
        }
        $filteredCount = count($items);

        $cols = ['name', 'description'];
        $key = $cols[$orderCol] ?? 'name';
        usort($items, function ($a, $b) use ($key, $orderDir) {
            $c = strcmp($a[$key], $b[$key]);
            return $orderDir === 1 ? $c : -$c;
        });
        $items = array_slice($items, $start, $length <= 0 ? null : $length);

        $data = [];
        foreach ($items as $r) {
            $data[] = [
                '<span class="badge badge-soft-primary">' . Html::encode($r['name']) . '</span>',
                Html::encode($r['description'] ?: '—'),
                $this->renderPartial('_role_actions_dropdown', ['name' => $r['name']]),
            ];
        }
        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    /**
     * Crear o editar rol.
     */
    public function actionRoleUpdate($name = null)
    {
        $auth = Yii::$app->authManager;
        $isNew = ($name === null || $name === '');
        $role = $isNew ? null : $auth->getRole($name);
        if (!$isNew && !$role) {
            throw new NotFoundHttpException('Rol no encontrado.');
        }

        $allPermissions = $auth->getPermissions();
        $childNames = [];
        if ($role) {
            $children = $auth->getChildren($name);
            $childNames = array_keys($children);
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $newName = trim($post['name'] ?? '');
            $description = trim($post['description'] ?? '');
            $permNames = $post['permissions'] ?? [];

            if ($newName === '') {
                Yii::$app->session->setFlash('error', 'El nombre del rol es obligatorio.');
            } else {
                if ($isNew) {
                    $role = $auth->createRole($newName);
                    $role->description = $description;
                    $auth->add($role);
                    Yii::$app->session->setFlash('success', 'Rol creado correctamente.');
                } else {
                    if ($newName !== $name) {
                        $userIds = AuthAssignment::find()->where(['item_name' => $name])->select('user_id')->column();
                        $auth->remove($role);
                        $role = $auth->createRole($newName);
                        $role->description = $description;
                        $auth->add($role);
                        foreach ($userIds as $userId) {
                            $auth->assign($role, (string)$userId);
                        }
                    } else {
                        $role->description = $description;
                        $auth->update($name, $role);
                    }
                    $name = $newName;
                }

                $role = $auth->getRole($name);
                foreach (array_keys($allPermissions) as $permName) {
                    $perm = $auth->getPermission($permName);
                    if (!$perm) continue;
                    $has = in_array($permName, $permNames, true);
                    $current = $auth->hasChild($role, $perm);
                    if ($has && !$current) {
                        $auth->addChild($role, $perm);
                    } elseif (!$has && $current) {
                        $auth->removeChild($role, $perm);
                    }
                }
                if ($isNew) {
                    return $this->redirect(['roles']);
                }
                Yii::$app->session->setFlash('success', 'Rol actualizado correctamente.');
            }
        }

        return $this->render('role-update', [
            'role' => $role,
            'name' => $role ? $role->name : '',
            'description' => $role ? ($role->description ?? '') : '',
            'allPermissions' => $allPermissions,
            'childNames' => $childNames,
            'isNew' => $isNew,
        ]);
    }

    /**
     * Eliminar rol. Retorna JSON si es Ajax.
     */
    public function actionRoleDelete($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        if (!$role) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'message' => 'Rol no encontrado.'];
            }
            throw new NotFoundHttpException('Rol no encontrado.');
        }
        $auth->remove($role);
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }
        Yii::$app->session->setFlash('success', 'Rol eliminado.');
        return $this->redirect(['roles']);
    }

    /**
     * Formulario HTML para editar rol (modal Ajax).
     */
    public function actionRoleFormAjax($name)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        if (!$role) {
            throw new NotFoundHttpException('Rol no encontrado.');
        }
        $allPermissions = $auth->getPermissions();
        $children = $auth->getChildren($name);
        $childNames = array_keys($children);
        return $this->renderPartial('_role_form_modal', [
            'name' => $role->name,
            'description' => $role->description ?? '',
            'allPermissions' => $allPermissions,
            'childNames' => $childNames,
        ]);
    }

    /**
     * Crear rol por Ajax. Retorna JSON.
     */
    public function actionRoleCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $post = Yii::$app->request->post();
        $newName = trim($post['name'] ?? '');
        $description = trim($post['description'] ?? '');
        $permNames = $post['permissions'] ?? [];

        if ($newName === '') {
            return ['success' => false, 'errors' => ['name' => ['El nombre del rol es obligatorio.']]];
        }
        if ($auth->getRole($newName)) {
            return ['success' => false, 'errors' => ['name' => ['Ya existe un rol con ese nombre.']]];
        }

        $role = $auth->createRole($newName);
        $role->description = $description;
        $auth->add($role);
        $allPermissions = $auth->getPermissions();
        foreach (array_keys($allPermissions) as $permName) {
            $perm = $auth->getPermission($permName);
            if ($perm && in_array($permName, $permNames, true)) {
                $auth->addChild($role, $perm);
            }
        }
        return ['success' => true];
    }

    /**
     * Actualizar rol por Ajax. Retorna JSON.
     */
    public function actionRoleUpdateAjax($name)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        if (!$role) {
            return ['success' => false, 'errors' => ['name' => ['Rol no encontrado.']]];
        }
        $post = Yii::$app->request->post();
        $description = trim($post['description'] ?? '');
        $permNames = $post['permissions'] ?? [];

        $role->description = $description;
        $auth->update($name, $role);
        $allPermissions = $auth->getPermissions();
        foreach (array_keys($allPermissions) as $permName) {
            $perm = $auth->getPermission($permName);
            if (!$perm) continue;
            $has = in_array($permName, $permNames, true);
            $current = $auth->hasChild($role, $perm);
            if ($has && !$current) {
                $auth->addChild($role, $perm);
            } elseif (!$has && $current) {
                $auth->removeChild($role, $perm);
            }
        }
        return ['success' => true];
    }

    /**
     * Listado de permisos.
     */
    public function actionPermissions()
    {
        return $this->render('permissions');
    }

    /**
     * JSON para DataTables server-side (permisos).
     */
    public function actionPermissionData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = trim($request->get('search', [])['value'] ?? '');
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 0);
        $orderDir = (strtolower($request->get('order', [])[0]['dir'] ?? 'asc') === 'desc') ? -1 : 1;

        $auth = Yii::$app->authManager;
        $permissions = $auth->getPermissions();
        $items = [];
        foreach ($permissions as $permName => $perm) {
            $items[] = [
                'name' => $permName,
                'description' => (string) ($perm->description ?? ''),
            ];
        }
        $totalCount = count($items);

        if ($searchValue !== '') {
            $search = mb_strtolower($searchValue);
            $items = array_values(array_filter($items, function ($p) use ($search) {
                return (strpos(mb_strtolower($p['name']), $search) !== false)
                    || (strpos(mb_strtolower($p['description']), $search) !== false);
            }));
        }
        $filteredCount = count($items);

        $cols = ['name', 'description'];
        $key = $cols[$orderCol] ?? 'name';
        usort($items, function ($a, $b) use ($key, $orderDir) {
            $c = strcmp($a[$key], $b[$key]);
            return $orderDir === 1 ? $c : -$c;
        });
        $items = array_slice($items, $start, $length <= 0 ? null : $length);

        $data = [];
        foreach ($items as $p) {
            $data[] = [
                '<span class="badge badge-soft-primary">' . Html::encode($p['name']) . '</span>',
                Html::encode($p['description'] ?: '—'),
                $this->renderPartial('_permission_actions_dropdown', ['name' => $p['name']]),
            ];
        }
        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    /**
     * Crear o editar permiso.
     */
    public function actionPermissionUpdate($name = null)
    {
        $auth = Yii::$app->authManager;
        $isNew = ($name === null || $name === '');
        $permission = $isNew ? null : $auth->getPermission($name);
        if (!$isNew && !$permission) {
            throw new NotFoundHttpException('Permiso no encontrado.');
        }

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $newName = trim($post['name'] ?? '');
            $description = trim($post['description'] ?? '');

            if ($newName === '') {
                Yii::$app->session->setFlash('error', 'El nombre del permiso es obligatorio.');
            } else {
                if ($isNew) {
                    $permission = $auth->createPermission($newName);
                    $permission->description = $description;
                    $auth->add($permission);
                    Yii::$app->session->setFlash('success', 'Permiso creado correctamente.');
                    return $this->redirect(['permissions']);
                }
                $permission->description = $description;
                if ($newName !== $name) {
                    $auth->remove($permission);
                    $permission = $auth->createPermission($newName);
                    $permission->description = $description;
                    $auth->add($permission);
                } else {
                    $auth->update($name, $permission);
                }
                Yii::$app->session->setFlash('success', 'Permiso actualizado correctamente.');
            }
        }

        return $this->render('permission-update', [
            'permission' => $permission,
            'name' => $permission ? $permission->name : '',
            'description' => $permission ? ($permission->description ?? '') : '',
            'isNew' => $isNew,
        ]);
    }

    /**
     * Eliminar permiso. Retorna JSON si es Ajax.
     */
    public function actionPermissionDelete($name)
    {
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($name);
        if (!$permission) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['success' => false, 'message' => 'Permiso no encontrado.'];
            }
            throw new NotFoundHttpException('Permiso no encontrado.');
        }
        $auth->remove($permission);
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }
        Yii::$app->session->setFlash('success', 'Permiso eliminado.');
        return $this->redirect(['permissions']);
    }

    /**
     * Formulario HTML para editar permiso (modal Ajax).
     */
    public function actionPermissionFormAjax($name)
    {
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($name);
        if (!$permission) {
            throw new NotFoundHttpException('Permiso no encontrado.');
        }
        return $this->renderPartial('_permission_form_modal', [
            'name' => $permission->name,
            'description' => $permission->description ?? '',
        ]);
    }

    /**
     * Crear permiso por Ajax. Retorna JSON.
     */
    public function actionPermissionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $post = Yii::$app->request->post();
        $newName = trim($post['name'] ?? '');
        $description = trim($post['description'] ?? '');

        if ($newName === '') {
            return ['success' => false, 'errors' => ['name' => ['El nombre del permiso es obligatorio.']]];
        }
        if ($auth->getPermission($newName)) {
            return ['success' => false, 'errors' => ['name' => ['Ya existe un permiso con ese nombre.']]];
        }

        $permission = $auth->createPermission($newName);
        $permission->description = $description;
        $auth->add($permission);
        return ['success' => true];
    }

    /**
     * Actualizar permiso por Ajax. Retorna JSON.
     */
    public function actionPermissionUpdateAjax($name)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $auth = Yii::$app->authManager;
        $permission = $auth->getPermission($name);
        if (!$permission) {
            return ['success' => false, 'errors' => ['name' => ['Permiso no encontrado.']]];
        }
        $post = Yii::$app->request->post();
        $description = trim($post['description'] ?? '');
        $permission->description = $description;
        $auth->update($name, $permission);
        return ['success' => true];
    }
}
