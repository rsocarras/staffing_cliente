import { defineConfig, devices } from '@playwright/test';
import dotenv from 'dotenv';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));

// .env (p. ej. ENVIRONMENT=local) y luego .env.testing (E2E_*); este último tiene prioridad.
dotenv.config({ path: path.join(__dirname, '.env'), quiet: true });
dotenv.config({ path: path.join(__dirname, '.env.testing'), quiet: true });

const baseURL = (process.env.E2E_BASE_URL ?? 'http://127.0.0.1:8080').replace(/\/$/, '');

const showBrowser =
  process.env.ENVIRONMENT?.trim() === 'local' && !process.env.CI;

/**
 * @see https://playwright.dev/docs/test-configuration
 */
export default defineConfig({
  testDir: 'e2e',
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 2 : 0,
  workers: process.env.CI ? 1 : undefined,
  reporter: [
    ['list'],
    ['html', { open: 'never' }],
  ],
  use: {
    baseURL,
    headless: !showBrowser,
    trace: 'on-first-retry',
    screenshot: 'only-on-failure',
    video: process.env.CI ? 'retain-on-failure' : 'off',
  },
  projects: [{ name: 'chromium', use: { ...devices['Desktop Chrome'] } }],
});
