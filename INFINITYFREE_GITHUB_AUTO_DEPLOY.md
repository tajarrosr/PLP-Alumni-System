# Auto-Deploy PLP Alumni System to InfinityFree via GitHub Actions

This guide will help you set up automatic deployment from GitHub to InfinityFree using GitHub Actions, similar to how Vercel works (but using FTP).

---

## Overview

**InfinityFree Limitations:**
- ❌ No native Git/GitHub integration
- ❌ No auto-deploy button in dashboard (like Vercel)
- ✅ BUT we can use GitHub Actions + FTP to achieve auto-deploy

**How it works:**
1. Push changes to GitHub
2. GitHub Actions detects the push
3. GitHub Actions uploads files to InfinityFree via FTP
4. Your website is automatically updated!

---

## Prerequisites

1. Your PLP Alumni System code pushed to a GitHub repository
2. An InfinityFree hosting account (already set up)
3. InfinityFree FTP credentials (we'll get these in Step 1)

---

## Step 1: Get InfinityFree FTP Credentials

1. Log in to your InfinityFree Control Panel
2. Click on your website
3. Look for **"FTP Accounts"** in the menu (or **"FTP"** section)
4. Find or create an FTP account
5. Note down the following:
   - **FTP Host**: Usually `ftpupload.net` (or shown in FTP section)
   - **FTP Username**: Your FTP username
   - **FTP Password**: Your FTP password
   - **FTP Port**: Usually `21`
   - **Target Directory**: Usually `/htdocs/` or `/public_html/`

⚠️ **Important**: Keep these credentials secure! We'll add them to GitHub Secrets.

---

## Step 2: Prepare Your GitHub Repository

1. Make sure your PLP Alumni System code is in a GitHub repository
2. If not already, push your code to GitHub:
   ```bash
   git add .
   git commit -m "Initial commit"
   git remote add origin https://github.com/yourusername/PLP-Alumni-System.git
   git push -u origin main
   ```

---

## Step 3: Create .ftpignore File

This file tells GitHub Actions which files to **exclude** from deployment (similar to `.gitignore`).

1. In your repository root, create a file named `.ftpignore`
2. Add the following content:

```
.git/
.github/
.gitignore
README.md
*.md
INFINITYFREE_DEPLOYMENT_GUIDE.md
INFINITYFREE_GITHUB_AUTO_DEPLOY.md
.vscode/
.idea/
node_modules/
*.log
.env
.env.local
.DS_Store
Thumbs.db
```

This prevents unnecessary files from being uploaded to your hosting.

---

## Step 4: Add GitHub Secrets (FTP Credentials)

1. Go to your GitHub repository
2. Click on **"Settings"** (top menu)
3. In the left sidebar, click **"Secrets and variables"** > **"Actions"**
4. Click **"New repository secret"** button
5. Add the following secrets one by one:

### Secret 1: FTP_HOST
- **Name**: `FTP_HOST`
- **Value**: `ftpupload.net` (or your InfinityFree FTP host)

### Secret 2: FTP_USERNAME
- **Name**: `FTP_USERNAME`
- **Value**: Your InfinityFree FTP username

### Secret 3: FTP_PASSWORD
- **Name**: `FTP_PASSWORD`
- **Value**: Your InfinityFree FTP password

### Secret 4: FTP_SERVER_DIR
- **Name**: `FTP_SERVER_DIR`
- **Value**: `/htdocs/` (or `/public_html/` - check your InfinityFree File Manager)

Click **"Add secret"** after each one.

---

## Step 5: Create GitHub Actions Workflow

1. In your GitHub repository, create the following directory structure:
   - `.github/workflows/` (if it doesn't exist)

2. Create a file named `deploy.yml` inside `.github/workflows/`

3. Add the following content to `deploy.yml`:

```yaml
name: Deploy to InfinityFree

on:
  push:
    branches:
      - main  # Change to 'master' if your default branch is master

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
      - name: Checkout code
        uses: actions/checkout@v3

      - name: FTP Deploy
        uses: SamKirkland/FTP-Deploy-Action@v4.3.5
        with:
          server: ${{ secrets.FTP_HOST }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          server-dir: ${{ secrets.FTP_SERVER_DIR }}
          local-dir: ./
          dangerous-clean-slate: false
          exclude: |
            **/.git*
            **/.git*/**
            **/node_modules/**
            **/.vscode/**
            **/.idea/**
            **/*.md
            **/.env*
            **/README.md
            **/INFINITYFREE_*.md
```

**Note**: 
- Change `main` to `master` if your default branch is `master`
- The workflow will deploy on every push to the main branch

---

## Step 6: Commit and Push

1. Add the new files:
   ```bash
   git add .github/workflows/deploy.yml
   git add .ftpignore
   ```

2. Commit:
   ```bash
   git commit -m "Add GitHub Actions auto-deploy to InfinityFree"
   ```

3. Push to GitHub:
   ```bash
   git push origin main
   ```

---

## Step 7: Monitor the Deployment

1. Go to your GitHub repository
2. Click on the **"Actions"** tab (top menu)
3. You should see a workflow run named **"Deploy to InfinityFree"**
4. Click on it to see the deployment progress
5. Wait for it to complete (green checkmark = success)

---

## Step 8: Verify Your Website

1. Visit your InfinityFree website URL
2. Your changes should be live!
3. Check that everything works correctly

---

## Important Notes

### ⚠️ Database Configuration

**IMPORTANT**: The GitHub Actions deployment uploads files, but **does NOT update your database connection files automatically**.

**You have 2 options:**

#### Option A: Update Database Files Before First Deploy (Recommended)
1. Update the 3 `dbconnection.php` files locally with InfinityFree credentials:
   - `public/includes/dbconnection.php`
   - `admin/includes/dbconnection.php`
   - `alumni/includes/dbconnection.php`
2. Then commit and push (they'll be deployed automatically)

#### Option B: Update Manually After First Deploy
1. After first deployment, manually edit the 3 `dbconnection.php` files via InfinityFree File Manager
2. Subsequent code changes will auto-deploy, but database configs won't be overwritten

**⚠️ Warning**: If you include database credentials in your GitHub repo, anyone with access can see them. Consider using environment variables or updating manually.

### ⚠️ Database Import

- You still need to import `plp_alumnisystem.sql` **manually once** via phpMyAdmin
- GitHub Actions only uploads files, it doesn't run database imports

### ⚠️ File Permissions

- GitHub Actions may not set file permissions correctly
- After first deployment, check image folder permissions:
  - `admin/images` → Set to 755 or 777
  - `alumni/images` → Set to 755 or 777
  - `public/images` → Set to 755 or 777

---

## How to Use Going Forward

**Workflow:**
1. ✅ Make changes to your code locally
2. ✅ Test changes locally
3. ✅ Commit and push to GitHub:
   ```bash
   git add .
   git commit -m "Description of changes"
   git push origin main
   ```
4. ✅ GitHub Actions automatically deploys to InfinityFree
5. ✅ Wait ~1-2 minutes for deployment to complete
6. ✅ Check your website - changes are live!

---

## Troubleshooting

### Issue: Deployment Fails with "Connection Refused"

**Solutions:**
- Verify FTP credentials in GitHub Secrets
- Check FTP host is correct (usually `ftpupload.net`)
- Try FTP port `21`
- Check InfinityFree status page

### Issue: Files Uploaded But Website Shows Errors

**Solutions:**
- Check database connection files are updated with InfinityFree credentials
- Verify database import was done manually
- Check file permissions for `images` folders
- Review error logs in InfinityFree Control Panel

### Issue: Wrong Files Deployed

**Solutions:**
- Check `.ftpignore` file is correct
- Verify `exclude` patterns in `deploy.yml`
- Make sure sensitive files are in `.ftpignore` or `.gitignore`

### Issue: Database Connection Errors After Deployment

**Solutions:**
- Database credentials in `dbconnection.php` files might be wrong
- Update them manually via File Manager
- Or update locally and redeploy

---

## Security Best Practices

1. ✅ **Never commit database passwords to GitHub** (use GitHub Secrets for FTP only)
2. ✅ Use `.ftpignore` to exclude sensitive files
3. ✅ Keep FTP credentials secure in GitHub Secrets
4. ✅ Consider updating database configs manually after first deploy
5. ✅ Use strong passwords for FTP and database

---

## Comparison: InfinityFree vs Vercel

| Feature | Vercel | InfinityFree + GitHub Actions |
|---------|--------|-------------------------------|
| Native Git Integration | ✅ Yes | ❌ No (but can use GitHub Actions) |
| Auto-Deploy Button | ✅ Yes | ❌ No |
| Auto-Deploy via Git Push | ✅ Yes | ✅ Yes (via GitHub Actions) |
| FTP Required | ❌ No | ✅ Yes |
| Database Hosting | ⚠️ Separate | ✅ Included (MySQL) |
| PHP Support | ⚠️ Limited | ✅ Full PHP Support |
| Cost | 💰 Paid (free tier limited) | 💰 Free |
| Setup Complexity | 🟢 Easy | 🟡 Medium (this guide) |

---

## Alternative: Use Vercel Instead?

If you want native Git integration like Vercel, you could:

1. **Deploy to Vercel** (free tier available)
   - Native GitHub integration
   - Auto-deploy on push
   - But: Limited PHP support (Vercel is better for Node.js/static sites)
   - Your PLP Alumni System uses PHP, so this may not work well

2. **Use Netlify** (similar to Vercel)
   - Also limited PHP support
   - Better for static sites/Node.js

3. **Use InfinityFree with GitHub Actions** (this guide)
   - ✅ Full PHP support
   - ✅ Free MySQL database
   - ✅ Auto-deploy via GitHub Actions
   - ⚠️ Requires FTP setup

**Recommendation**: For a PHP application like yours, InfinityFree + GitHub Actions is a good solution!

---

## Summary

✅ **InfinityFree does NOT have native Git integration** (unlike Vercel)

✅ **BUT you CAN set up auto-deploy** using GitHub Actions + FTP

✅ **Workflow**: Push to GitHub → GitHub Actions → FTP Upload → Website Updated

✅ **One-time setup**, then all future pushes auto-deploy!

---

**Need help?** Check GitHub Actions logs in the "Actions" tab of your repository for detailed error messages.

