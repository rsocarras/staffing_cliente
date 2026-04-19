import { expect, test } from '@playwright/test';

/**
 * Login real contra la app Yii (Da\User) en /login.
 * Requiere E2E_BASE_URL, E2E_USER y E2E_PASSWORD en .env.testing (ver .env.testing.example).
 */
test.describe('Autenticación', () => {
  test('inicia sesión con credenciales de .env.testing', async ({ page }) => {
    const user = process.env.E2E_USER?.trim();
    const password = process.env.E2E_PASSWORD?.trim();

    test.skip(
      !user || !password,
      'Defina E2E_USER y E2E_PASSWORD en staffing_cliente/.env.testing (copie desde .env.testing.example).',
    );

    await page.goto('/login');

    await expect(page.getByRole('heading', { name: 'Iniciar sesión' })).toBeVisible();

    // Algunos despliegues usan label "Email"; la vista yii2-usuario por defecto usa "Usuario o correo electrónico".
    const userField = page
      .getByLabel(/Email|Usuario o correo electrónico/)
      .or(page.getByPlaceholder(/usuario|email/i));
    await userField.fill(user!);

    await page.getByLabel('Contraseña').fill(password!);
    await page.getByRole('button', { name: 'Iniciar sesión' }).click();

    await expect(page).not.toHaveURL(/\/login\/?(\?.*)?$/);
  });
});
