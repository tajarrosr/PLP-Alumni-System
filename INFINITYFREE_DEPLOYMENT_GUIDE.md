# Step-by-Step Guide: Deploy PLP Alumni System to InfinityFree

This guide will walk you through deploying your PLP Alumni System website to InfinityFree using only the File Manager (no FTP required).

---

## Prerequisites

1. An InfinityFree account (sign up at [infinityfree.net](https://www.infinityfree.net))
2. Your PLP Alumni System project files ready on your computer
3. A zip file of your project (recommended for easier upload)

---

## Step 1: Sign Up / Log In to InfinityFree

1. Go to [https://www.infinityfree.net](https://www.infinityfree.net)
2. Click **"Sign Up"** if you don't have an account, or **"Log In"** if you do
3. Complete the registration process if needed

---

## Step 2: Create a Website

1. After logging in, go to your **Control Panel** (dashboard)
2. Click on **"Create Account"** or **"Add Website"**
3. Enter your desired subdomain (e.g., `yourwebsite.infinityfreeapp.com`) or use your own domain
4. Choose a hosting plan (Free plan is available)
5. Click **"Create"** or **"Submit"**

---

## Step 3: Create MySQL Database

1. In your Control Panel, find your website
2. Click on **"Manage"** or your website name
3. Look for **"MySQL Databases"** in the left menu or main area
4. Click **"Create Database"** or **"New Database"**
5. Note down the following information (you'll need this later):
   - **Database Name**: Usually `epiz_xxxxx_alumnisystem` (or similar)
   - **Database Username**: Usually same as database name
   - **Database Password**: Generated password (save it!)
   - **Database Host**: Usually `sqlXXX.infinityfree.com` (or `localhost`)
6. **IMPORTANT**: Write down these credentials - you'll need them in Step 7

---

## Step 4: Prepare Your Files for Upload

### Option A: Create a Zip File (Recommended - Faster Upload)

1. On your computer, navigate to your project folder: `D:\My Projects\PLP-Alumni-System`
2. Select ALL files and folders (press `Ctrl+A`)
3. Right-click and choose **"Send to" > "Compressed (zipped) folder"** or use WinRAR/7-Zip to create a zip file
4. Name it something like `PLP-Alumni-System.zip`
5. **IMPORTANT**: Make sure ALL folders are included:
   - `admin` folder
   - `alumni` folder
   - `public` folder
   - `index.php` (root file)
   - `plp_alumnisystem.sql` file
   - All other files

### Option B: Upload Files Individually (Not Recommended - Very Slow)

You can upload files one by one, but this is very time-consuming.

---

## Step 5: Access File Manager

1. In your InfinityFree Control Panel, click on your website
2. Look for **"File Manager"** in the left menu
3. Click **"File Manager"** or **"FTP File Manager"**
4. This will open the File Manager in a new tab/window

---

## Step 6: Upload Your Files

### If Using Zip File (Recommended):

1. In File Manager, navigate to the **`htdocs`** folder (or **`public_html`** folder - depends on your hosting)
   - This is usually the root directory for your website
   - If you see multiple folders, `htdocs` or `public_html` is the one you need
2. **Delete any default files** if present (like `index.html`, `default.php`, etc.)
3. Click **"Upload"** button (usually at the top)
4. Click **"Select Files"** or **"Browse"**
5. Select your `PLP-Alumni-System.zip` file
6. Click **"Upload"** and wait for it to finish
7. After upload completes, locate the zip file in File Manager
8. **Right-click** on the zip file and select **"Extract"** or **"Unzip"**
9. The files will be extracted to the current directory
10. **Delete the zip file** after extraction (to save space)
11. If files were extracted to a subfolder, move all contents to `htdocs` root:
    - Open the extracted folder
    - Select all files (Ctrl+A)
    - Cut them (Ctrl+X)
    - Go back to `htdocs`
    - Paste them (Ctrl+V)

### If Uploading Individual Files:

1. Navigate to `htdocs` folder
2. For each folder (`admin`, `alumni`, `public`):
   - Click **"New Folder"** and create the folder name
   - Enter the folder and upload all files inside
3. Upload all root files (`index.php`, `plp_alumnisystem.sql`, etc.)
4. This method is very slow - zip file method is much better!

---

## Step 7: Update Database Connection Files

You need to update **3 database connection files** with your InfinityFree database credentials.

1. In File Manager, navigate to the following files:
   - `public/includes/dbconnection.php`
   - `admin/includes/dbconnection.php`
   - `alumni/includes/dbconnection.php`

2. For each file, do the following:
   - **Right-click** on the file and select **"Edit"** or **"Edit with Code Editor"**
   - Replace the database credentials with your InfinityFree database information:

```php
<?php 
// DB credentials.
define('DB_HOST','sqlXXX.infinityfree.com');  // Replace with your database host
define('DB_USER','epiz_xxxxx_alumnisystem');  // Replace with your database username
define('DB_PASS','your_database_password');    // Replace with your database password
define('DB_NAME','epiz_xxxxx_alumnisystem');  // Replace with your database name
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
```

3. **Replace the values**:
   - `DB_HOST`: Your database host (from Step 3)
   - `DB_USER`: Your database username (from Step 3)
   - `DB_PASS`: Your database password (from Step 3)
   - `DB_NAME`: Your database name (from Step 3)

4. Click **"Save"** after editing each file

**Example** (yours will be different):
```php
define('DB_HOST','sql311.infinityfree.com');
define('DB_USER','epiz_34567890_alumnisystem');
define('DB_PASS','MyPassword123!');
define('DB_NAME','epiz_34567890_alumnisystem');
```

---

## Step 8: Import Database

1. In your InfinityFree Control Panel, go back to your website dashboard
2. Look for **"phpMyAdmin"** in the menu (usually under "Tools" or "Database")
3. Click **"phpMyAdmin"** - it will open in a new window
4. Log in with your database credentials if prompted:
   - Username: Your database username
   - Password: Your database password
5. In phpMyAdmin:
   - Click on your database name in the left sidebar (e.g., `epiz_xxxxx_alumnisystem`)
   - Click on the **"Import"** tab at the top
   - Click **"Choose File"** or **"Browse"**
   - Navigate to and select your `plp_alumnisystem.sql` file
     - **Note**: You may need to download it from File Manager first if you can't access it locally
     - To download: Go to File Manager, find `plp_alumnisystem.sql`, right-click, select "Download"
   - Scroll down and click **"Go"** or **"Import"**
   - Wait for the import to complete (should show "Import has been successfully finished")
6. Verify the import:
   - Check that tables are created in the left sidebar (tbladmin, tblalumni, tblevents, etc.)
   - You should see multiple tables listed

---

## Step 9: Set Proper File Permissions (If Needed)

Usually InfinityFree handles this automatically, but if you encounter upload issues:

1. In File Manager, navigate to the `images` folders:
   - `admin/images`
   - `alumni/images`
   - `public/images`
2. Right-click each `images` folder
3. Select **"Change Permissions"** or **"File Permissions"**
4. Set permissions to **755** (or **777** if 755 doesn't work)
5. Click **"OK"**

---

## Step 10: Test Your Website

1. In your InfinityFree Control Panel, find your website URL
   - It should be something like: `https://yourwebsite.infinityfreeapp.com`
   - Or your custom domain if you set one up
2. Open a web browser and visit your website URL
3. The homepage should load (redirecting to `public/home.php`)
4. Test the following:
   - **Public Pages**: Home, About, Contact, Events, Job Lists
   - **Admin Login**: Go to `yourwebsite.infinityfreeapp.com/admin/login.php`
     - Default credentials:
       - Username: `admin`
       - Password: `admin`
     - ⚠️ **IMPORTANT**: Change this password immediately after first login!
   - **Alumni Registration**: Go to `yourwebsite.infinityfreeapp.com/alumni/registration.php`
   - **Alumni Login**: Go to `yourwebsite.infinityfreeapp.com/alumni/login.php`

---

## Step 11: Fix Common Issues

### Issue: Database Connection Error

**Solution**:
- Double-check all database credentials in the 3 `dbconnection.php` files
- Make sure there are no extra spaces before/after the values
- Verify database name, username, password, and host are correct
- Try using `localhost` instead of `sqlXXX.infinityfree.com` if connection fails

### Issue: Page Not Found (404 Error)

**Solution**:
- Verify `index.php` is in the `htdocs` root folder
- Check that all folders (`admin`, `alumni`, `public`) are uploaded correctly
- Make sure file paths are correct

### Issue: CSS/Images Not Loading

**Solution**:
- Check that all CSS, JS, and image folders are uploaded
- Verify file paths in your PHP files use relative paths (they should)
- Clear browser cache (Ctrl+F5)

### Issue: Cannot Upload Images

**Solution**:
- Check folder permissions for `images` folders (should be 755 or 777)
- Verify the `images` folders exist and are writable

### Issue: SQL Import Failed

**Solution**:
- Check file size limit (InfinityFree free plan has limits)
- Try importing in smaller chunks if the file is too large
- Make sure you selected the correct database before importing
- Check for SQL syntax errors in the file

---

## Step 12: Security Recommendations

After deployment:

1. **Change Admin Password**:
   - Log in to admin panel
   - Go to Change Password
   - Set a strong password

2. **Remove SQL File** (Optional but Recommended):
   - Delete `plp_alumnisystem.sql` from File Manager after import
   - This prevents others from downloading your database structure

3. **Keep Your Database Credentials Secure**:
   - Never share your database credentials
   - Don't commit them to version control

---

## Quick Reference: File Structure After Upload

Your `htdocs` folder should look like this:

```
htdocs/
├── admin/
│   ├── includes/
│   │   └── dbconnection.php (UPDATED)
│   ├── images/
│   ├── css/
│   ├── js/
│   └── ... (other admin files)
├── alumni/
│   ├── includes/
│   │   └── dbconnection.php (UPDATED)
│   ├── images/
│   └── ... (other alumni files)
├── public/
│   ├── includes/
│   │   └── dbconnection.php (UPDATED)
│   ├── images/
│   ├── css/
│   ├── js/
│   └── ... (other public files)
├── index.php
└── plp_alumnisystem.sql (can be deleted after import)
```

---

## Support

If you encounter issues:

1. Check InfinityFree documentation: [https://forum.infinityfree.net](https://forum.infinityfree.net)
2. Verify all steps were completed correctly
3. Check InfinityFree status page for service issues
4. Review error messages carefully - they often indicate the problem

---

## Summary Checklist

- [ ] Created InfinityFree account
- [ ] Created website/hosting account
- [ ] Created MySQL database
- [ ] Saved database credentials (host, username, password, database name)
- [ ] Uploaded all files to `htdocs` folder
- [ ] Updated `public/includes/dbconnection.php`
- [ ] Updated `admin/includes/dbconnection.php`
- [ ] Updated `alumni/includes/dbconnection.php`
- [ ] Imported `plp_alumnisystem.sql` via phpMyAdmin
- [ ] Tested website homepage
- [ ] Tested admin login
- [ ] Tested alumni registration/login
- [ ] Set image folder permissions (if needed)
- [ ] Changed default admin password

---

**Congratulations! Your PLP Alumni System should now be live on InfinityFree!** 🎉

