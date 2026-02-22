#!/usr/bin/env bash
set -e

# ====== Configuración ======
YII_BIN="php yii"
MODEL_NS="app\\models"
SEARCH_NS="app\\models\\search"
CTRL_NS="app\\controllers"
VIEW_ROOT="@app/views"

# Si usas otra conexión DB en tus modelos CRUD (normalmente NO hace falta aquí), puedes ajustarlo en los modelos.
# CRUD usa el modelo ya generado, así que no necesita --db como gii/model.

# ====== Carpetas base ======
mkdir -p models/search
mkdir -p controllers
mkdir -p views

gen_crud () {
  local model="$1"
  local slug="$2"
  local controller="${3:-${model}Controller}"

  echo ">>> Generando CRUD para $model -> $controller ($slug)"

  $YII_BIN gii/crud \
    --modelClass="${MODEL_NS}\\${model}" \
    --searchModelClass="${SEARCH_NS}\\${model}Search" \
    --controllerClass="${CTRL_NS}\\${controller}" \
    --viewPath="${VIEW_ROOT}/${slug}" \
    --baseControllerClass="yii\\web\\Controller" \
    --indexWidgetType="grid" \
    --enablePjax=1 \
    --interactive=0 \
    --overwrite=1
}

# ===========================
# RBAC / Seguridad
# ===========================
gen_crud "AuthAssignment" "auth-assignment"
gen_crud "AuthItem" "auth-item"
gen_crud "AuthItemChild" "auth-item-child"
gen_crud "AuthRule" "auth-rule"

# ===========================
# Core / Configuración
# ===========================
gen_crud "Empresas" "empresas"
gen_crud "Setting" "setting"
gen_crud "CompanySetting" "company-setting"
gen_crud "Email" "email"

# ===========================
# Ubicación
# ===========================
gen_crud "LocationCountry" "location-country"
gen_crud "Region" "region"
gen_crud "City" "city"
gen_crud "LocationSedes" "location-sedes"

# ===========================
# Usuarios / perfiles / estructura
# ===========================
gen_crud "User" "user" "UserController"
gen_crud "Profile" "profile"
gen_crud "Area" "area"
gen_crud "Archivos" "archivos"
gen_crud "ArchivoLink" "archivo-link"
gen_crud "ProfileEventosLog" "profile-eventos-log"
gen_crud "ProfileSalarios" "profile-salarios"
gen_crud "EmpleadoVenueHistory" "empleado-venue-history"

# ===========================
# Novedades (motor dinámico)
# ===========================
gen_crud "NovedadOpcionesDependientes" "novedad-opciones-dependientes"
gen_crud "NovedadTipo" "novedad-tipo"
gen_crud "NovedadTipoCampo" "novedad-tipo-campo"
gen_crud "NovedadTipoCampoOpcion" "novedad-tipo-campo-opcion"
gen_crud "NovedadConcepto" "novedad-concepto"
gen_crud "NovedadFlujoPaso" "novedad-flujo-paso"
gen_crud "Novedad" "novedad"

# ===========================
# Maestros / contabilidad / contratos
# ===========================
gen_crud "Cargos" "cargos"
gen_crud "ContabilidadCentroCosto" "contabilidad-centro-costo"
gen_crud "ContabilidadCentroUtilidad" "contabilidad-centro-utilidad"
gen_crud "ContratoTipos" "contrato-tipos"
gen_crud "MaestrosConceptos" "maestros-conceptos"
gen_crud "ConceptoIntegracionMap" "concepto-integracion-map"

# ===========================
# Integraciones / webhooks / logs
# ===========================
gen_crud "EmpresaIntegration" "empresa-integration"
gen_crud "EmpresaWebhook" "empresa-webhook"
gen_crud "IntegrationLog" "integration-log"

# ===========================
# Mallas / distribución de horas
# ===========================
gen_crud "Mallas" "mallas"
gen_crud "MallasHorarios" "mallas-horarios"
gen_crud "MallaDistribucionHoras" "malla-distribucion-horas"

# ===========================
# Nómina
# ===========================
gen_crud "PayrollPeriod" "payroll-period"
gen_crud "NominaRun" "nomina-run"
gen_crud "NominaItem" "nomina-item"
gen_crud "NominaLimitesLegales" "nomina-limites-legales"
gen_crud "NominaRetencionImpuesto" "nomina-retencion-impuesto"

# ===========================
# Planillas / importación
# ===========================
gen_crud "PlanillaTemplate" "planilla-template"
gen_crud "PlanillaImport" "planilla-import"
gen_crud "PlanillaError" "planilla-error"

echo ""
echo "✅ CRUDs generados correctamente."
echo "Revisa rutas tipo: /<slug>/index"