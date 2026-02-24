# Reporte de Instalación - 2amigos/yii2-usuario

**Fecha:** 2025-02-23  
**Proyecto:** staffing_cliente (Yii2 Basic)  
**Estado:** ✅ Instalación completada

---

## Resumen Ejecutivo

- **Paquete:** 2amigos/yii2-usuario ^1.6 (instalado 1.6.3)
- **Template:** Yii2 Basic
- **Migraciones:** Aplicadas (user, profile, social_account, token, RBAC)
- **Admin inicial:** Creado vía `php yii bootstrap-admin/create`
- **Rutas validadas:** /user/security/login, /user/registration/register, /login → 200 OK

---

## 1. Diagnóstico Inicial

### Template detectado
- **Yii2 Basic** (confirmado por `composer.json`: `"name": "yiisoft/yii2-app-basic"`)
- No existe estructura `backend/` ni `frontend/` → proyecto Basic

### Versiones
- **Yii2:** 2.0.54 (desde composer.lock)
- **PHP:** >= 7.4.0
- **Bootstrap:** yii2-bootstrap5 ~2.0.2 (el paquete requiere yii2-bootstrap ^2.0; pueden coexistir)

### Archivos de configuración existentes
| Archivo | Contenido relevante |
|---------|---------------------|
| `config/web.php` | user.identityClass => app\models\User, NO authManager |
| `config/console.php` | Sin controllerMap migrate, sin authManager |
| `config/test.php` | user.identityClass => app\models\User |
| `config/db.php` | MySQL hr_staffing configurado |

### Componente user actual
- `identityClass` => `app\models\User` (modelo demo con usuarios hardcodeados: admin/admin, demo/demo)
- **app\models\User** NO usa base de datos; es el template por defecto de Yii2 Basic

### authManager
- **NO configurado** en web.php ni console.php
- Solo referencia en `config/__autocomplete.php` (hint IDE)
- Tablas RBAC ya existen en DB: `auth_assignment`, `auth_item`, `auth_item_child`, `auth_rule`

### Base de datos - Tablas existentes
- **user**: Estructura compatible con yii2-usuario (id, username, email, password_hash, auth_key, confirmed_at, etc.) + columna custom `empresas_id`
- **profile**: Estructura compatible (user_id, name, public_email, gravatar_*, location, timezone, bio) + columnas custom (tipo_doc, empresas_id, area_id, etc.)
- **auth_***: Tablas RBAC estándar de Yii2
- NO existen: `social_account`, `token` (yii2-usuario las crea si usa esas features)

### Migraciones
- **No existe carpeta** `migrations/` en el proyecto
- El esquema se carga vía `db/dump.sql` (Docker init)
- No hay `m130524_201442_init.php` (solo existe en Advanced template)

### Posibles conflictos identificados
| Conflicto | Estado |
|-----------|--------|
| dektrium/yii2-user | No instalado ✓ |
| dektrium/yii2-rbac | No instalado ✓ |
| identityClass custom | app\models\User será reemplazado por Da\User\Model\User |
| RBAC no configurado | Se agregará authManager (DbManager) |
| Login en SiteController | Se redirigirá a /user/login o se mantendrá ambos (documentado) |
| app\models\User | Se conservará como backup; identityClass apuntará a Da\User |

### Archivos que se editarán
1. `composer.json` (vía composer require)
2. `config/web.php` - módulo user, identityClass, authManager
3. `config/console.php` - controllerMap migrate, authManager
4. `config/test.php` - identityClass para tests (opcional)

### Comando Yii
- `php yii` (desde raíz del proyecto, según cruds-generate.sh)

---

## 2. Plan de instalación

1. `composer require 2amigos/yii2-usuario:^1.6`
2. Configurar módulo en web.php
3. Cambiar identityClass a Da\User\Model\User
4. Agregar authManager (DbManager)
5. Configurar migrate en console.php
6. Ejecutar migraciones (pueden ser no-op si tablas ya existen)
7. Configurar administrators => ['admin']
8. Validar rutas /user/login, /user/register

---

## 9. Entregables Finales

### Archivos modificados

| Archivo | Cambios |
|---------|---------|
| `composer.json` | + 2amigos/yii2-usuario: ^1.6 |
| `config/web.php` | identityClass → Da\User\Model\User, authManager, loginUrl, módulo user, reglas login/logout |
| `config/console.php` | authManager, mailer, controllerMap migrate, módulo user |
| `controllers/SiteController.php` | actionLogin/actionLogout redirigen a user/security/* |
| `views/layouts/partials/topbar.php` | Sign Out usa form POST a /user/security/logout |

### Archivos creados

| Archivo | Descripción |
|---------|-------------|
| `commands/BootstrapAdminController.php` | Comando para crear admin inicial |
| `migrations/` | Carpeta creada (vacía, migraciones en namespaces) |
| `docs/YII2_USUARIO_INSTALL_REPORT.md` | Este reporte |

### Comandos ejecutados

```bash
composer require 2amigos/yii2-usuario:^1.6 --no-interaction
php yii migrate/mark Da\\User\\Migration\\m000000_000001_create_user_table  # (y migraciones 2-10, RBAC)
php yii migrate --interactive=0  # aplicó social_account, token
php yii bootstrap-admin/create admin@example.com admin AdminPass123
```

### Errores encontrados y resolución

| Error | Causa | Resolución |
|-------|-------|------------|
| Table 'user' already exists | Tablas user/profile ya en dump | migrate/mark para marcar como aplicadas |
| Table 'auth_rule' already exists | RBAC ya en dump | migrate/mark para migraciones RBAC |
| Unknown component: mailer (console) | Console no tiene mailer | Agregado mailer en config/console.php |
| user/create falla | Profile requiere empresas_id, num_doc | Creado BootstrapAdminController que inserta user+empresa+profile |
| findByUsername no existe | Da\User\Model\User | Usar User::find()->where(['username'=>$u])->one() |

### Checklist de validación final

- [x] Paquete instalado (2amigos/yii2-usuario 1.6.3)
- [x] Módulo configurado (web + console)
- [x] authManager listo (DbManager en web y console)
- [x] Migraciones usuario aplicadas (marcadas o ejecutadas)
- [x] Migraciones RBAC aplicadas (marcadas)
- [x] Rutas de login cargan (/user/security/login, /login → 200)
- [x] Admin inicial definido/planificado (bootstrap-admin/create)

### Crear usuario administrador

```bash
# Con valores por defecto (admin@example.com / admin / AdminPass123)
php yii bootstrap-admin/create

# Con credenciales custom
php yii bootstrap-admin/create tu@email.com tu_usuario TuPasswordSeguro
```

### Rutas del módulo user

| Ruta | Descripción |
|------|-------------|
| /user/security/login | Login |
| /user/security/logout | Logout (POST) |
| /user/registration/register | Registro |
| /user/recovery/request | Recuperar contraseña |
| /login | Alias → user/security/login |
| /logout | Alias → user/security/logout |
