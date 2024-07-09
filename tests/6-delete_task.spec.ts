import { test, expect } from '@playwright/test';
import { login } from './loginfunction.spec';

test('deleteTask', async ({ page }) => {
    // Step 1: Navigate to the create task page
    await page.goto('http://127.0.0.1:8000/login');
    
    // Step 2: Handle the redirect to the login page
    await login(page, 'test@example.com', '12345678');

    await page.goto('http://127.0.0.1:8000/tasks');

    await page.click('.fa-pencil');
    await page.click('.fa-trash');


    await expect(page.locator('text=Task Deleted')).toBeVisible();
});
