<?php

namespace App\Database\Migrations;

use App\Services\SqlEasy;

class UpdateSettingsTable
{
    public function up(): void
    {
        $pdo = (new SqlEasy())->conn();

        // Check and add email column (alias for contact_email, keep both for compatibility)
        $checkEmail = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'settings' 
                      AND COLUMN_NAME = 'email'";
        $stmt = $pdo->query($checkEmail);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN email VARCHAR(255) NULL AFTER contact_email");
        }

        // Check and add phone column (alias for contact_phone, keep both for compatibility)
        $checkPhone = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                      WHERE TABLE_SCHEMA = DATABASE() 
                      AND TABLE_NAME = 'settings' 
                      AND COLUMN_NAME = 'phone'";
        $stmt = $pdo->query($checkPhone);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN phone VARCHAR(50) NULL AFTER contact_phone");
        }

        // Check and add site_logo_dark column
        $checkSiteLogoDark = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                             WHERE TABLE_SCHEMA = DATABASE() 
                             AND TABLE_NAME = 'settings' 
                             AND COLUMN_NAME = 'site_logo_dark'";
        $stmt = $pdo->query($checkSiteLogoDark);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN site_logo_dark VARCHAR(500) NULL AFTER site_logo");
        }

        // Check and add whatsapp column (note: view uses 'whatssap' but correct spelling is 'whatsapp')
        $checkWhatsapp = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                         WHERE TABLE_SCHEMA = DATABASE() 
                         AND TABLE_NAME = 'settings' 
                         AND COLUMN_NAME = 'whatsapp'";
        $stmt = $pdo->query($checkWhatsapp);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN whatsapp VARCHAR(50) NULL");
        }

        // Also add whatssap for compatibility with view typo
        $checkWhatssap = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                         WHERE TABLE_SCHEMA = DATABASE() 
                         AND TABLE_NAME = 'settings' 
                         AND COLUMN_NAME = 'whatssap'";
        $stmt = $pdo->query($checkWhatssap);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN whatssap VARCHAR(50) NULL");
        }

        // Check and add youtube column (if doesn't exist as youtube_url)
        $checkYoutube = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                        WHERE TABLE_SCHEMA = DATABASE() 
                        AND TABLE_NAME = 'settings' 
                        AND COLUMN_NAME = 'youtube'";
        $stmt = $pdo->query($checkYoutube);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN youtube VARCHAR(500) NULL");
        }

        // Check and add pinterest column
        $checkPinterest = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                         WHERE TABLE_SCHEMA = DATABASE() 
                         AND TABLE_NAME = 'settings' 
                         AND COLUMN_NAME = 'pinterest'";
        $stmt = $pdo->query($checkPinterest);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN pinterest VARCHAR(500) NULL");
        }

        // Also add facebook and linkedin as aliases (they exist as facebook_url and linkedin_url)
        $checkFacebook = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                         WHERE TABLE_SCHEMA = DATABASE() 
                         AND TABLE_NAME = 'settings' 
                         AND COLUMN_NAME = 'facebook'";
        $stmt = $pdo->query($checkFacebook);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN facebook VARCHAR(500) NULL");
        }

        $checkLinkedin = "SELECT COUNT(*) as count FROM information_schema.COLUMNS 
                         WHERE TABLE_SCHEMA = DATABASE() 
                         AND TABLE_NAME = 'settings' 
                         AND COLUMN_NAME = 'linkedin'";
        $stmt = $pdo->query($checkLinkedin);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result['count'] == 0) {
            $pdo->exec("ALTER TABLE settings ADD COLUMN linkedin VARCHAR(500) NULL");
        }
    }

    public function down(): void
    {
        $pdo = (new SqlEasy())->conn();
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS email");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS phone");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS site_logo_dark");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS whatsapp");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS whatssap");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS youtube");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS pinterest");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS facebook");
        $pdo->exec("ALTER TABLE settings DROP COLUMN IF EXISTS linkedin");
    }
}

