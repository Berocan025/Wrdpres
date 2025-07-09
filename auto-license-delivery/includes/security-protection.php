<?php
/**
 * BERAT K - Güvenlik Koruma Sistemi
 * Bu dosya eklentinin korunması için geliştirilmiştir
 * Geliştirici: BERAT K - WhatsApp: +90 539 511 56 32
 */

// Güvenlik kontrolü
if (!defined('ABSPATH')) {
    exit('Yetkisiz erişim engellendi.');
}

class BeratKSecurityProtection {
    
    private static $instance = null;
    private $security_key = 'BERAT_K_SECURE_2024_LICENSE_PROTECTION';
    private $developer_hash = null;
    private $authorized_domains = array();
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->developer_hash = hash('sha256', 'BERAT_K_DEVELOPER_2024_PROTECTION');
        $this->authorized_domains = array(
            hash('sha256', 'unrivaled.store'),
            hash('sha256', 'localhost'),
            hash('sha256', '127.0.0.1')
        );
        
        add_action('init', array($this, 'security_check'));
        add_action('admin_init', array($this, 'advanced_protection'));
    }
    
    /**
     * Ana güvenlik kontrolü
     */
    public function security_check() {
        if (!$this->verify_integrity()) {
            $this->security_violation();
            return;
        }
        
        if (!$this->domain_check()) {
            $this->unauthorized_domain();
            return;
        }
        
        $this->update_security_timestamp();
    }
    
    /**
     * Gelişmiş koruma sistemi
     */
    public function advanced_protection() {
        // Plugin dosya bütünlüğü kontrolü
        if (!$this->check_file_integrity()) {
            $this->file_tampering_detected();
            return;
        }
        
        // Lisans anahtarı doğrulama
        if (!$this->verify_license_key()) {
            $this->invalid_license();
            return;
        }
    }
    
    /**
     * Şifrelenmiş geliştirici bilgilerini al
     */
    public function get_encrypted_developer_info() {
        $developer_data = array(
            'name' => $this->encrypt_data('BERAT K'),
            'phone' => $this->encrypt_data('0539 511 56 32'),
            'whatsapp' => $this->encrypt_data('https://wa.me/905395115632'),
            'copyright' => $this->encrypt_data('© 2024 BERAT K - Tüm hakları saklıdır'),
            'signature' => hash('sha256', 'BERAT_K_ORIGINAL_DEVELOPER_2024')
        );
        
        return $developer_data;
    }
    
    /**
     * Şifrelenmiş veriyi çöz
     */
    public function decrypt_developer_info($encrypted_data) {
        if (!$this->verify_developer_signature($encrypted_data['signature'])) {
            return $this->get_fake_developer_info();
        }
        
        return array(
            'name' => $this->decrypt_data($encrypted_data['name']),
            'phone' => $this->decrypt_data($encrypted_data['phone']),
            'whatsapp' => $this->decrypt_data($encrypted_data['whatsapp']),
            'copyright' => $this->decrypt_data($encrypted_data['copyright'])
        );
    }
    
    /**
     * Güvenli geliştirici bilgisi görüntüleme
     */
    public function display_secure_developer_info($style = 'default') {
        $encrypted_info = $this->get_encrypted_developer_info();
        $developer_info = $this->decrypt_developer_info($encrypted_info);
        
        // Ek güvenlik kontrolü
        if (!$this->verify_display_context()) {
            return '<!-- Güvenlik ihlali tespit edildi -->';
        }
        
        switch ($style) {
            case 'footer':
                return $this->render_footer_info($developer_info);
            case 'admin':
                return $this->render_admin_info($developer_info);
            case 'whatsapp':
                return $this->render_whatsapp_button($developer_info);
            default:
                return $this->render_default_info($developer_info);
        }
    }
    
    /**
     * Footer için geliştirici bilgisi
     */
    private function render_footer_info($info) {
        $timestamp = $this->get_security_timestamp();
        return '<div class="ald-developer-footer" data-security="' . $timestamp . '">
            <h4 style="margin: 0 0 10px 0; color: #1976d2;">👨‍💻 Geliştirici: ' . esc_html($info['name']) . '</h4>
            <p style="margin: 0 0 15px 0; color: #666; font-size: 14px;">Bu eklenti ' . esc_html($info['name']) . ' tarafından özel olarak geliştirilmiştir.</p>
            <a href="' . esc_url($info['whatsapp']) . '" class="ald-whatsapp-btn" target="_blank">📱 WhatsApp ile İletişim: ' . esc_html($info['phone']) . '</a>
            <div style="margin-top: 10px; font-size: 12px; color: #999;">' . esc_html($info['copyright']) . '</div>
        </div>';
    }
    
    /**
     * Admin panel için geliştirici bilgisi
     */
    private function render_admin_info($info) {
        return '<div style="background: #e3f2fd; padding: 15px; border-radius: 8px; margin: 15px 0; text-align: center;">
            <strong>👨‍💻 Geliştirici: ' . esc_html($info['name']) . '</strong><br>
            📱 <a href="' . esc_url($info['whatsapp']) . '" target="_blank">WhatsApp: ' . esc_html($info['phone']) . '</a>
        </div>';
    }
    
    /**
     * WhatsApp butonu
     */
    private function render_whatsapp_button($info) {
        return '<a href="' . esc_url($info['whatsapp']) . '" class="ald-whatsapp-btn" target="_blank">📱 WhatsApp ile İletişim: ' . esc_html($info['phone']) . '</a>';
    }
    
    /**
     * Varsayılan geliştirici bilgisi
     */
    private function render_default_info($info) {
        return '<small style="color: #666;">👨‍💻 <strong>Geliştirici:</strong> ' . esc_html($info['name']) . ' - WhatsApp: <a href="' . esc_url($info['whatsapp']) . '" style="color: #25d366; text-decoration: none;">' . esc_html($info['phone']) . '</a></small>';
    }
    
    /**
     * Veri şifreleme
     */
    private function encrypt_data($data) {
        $key = hash('sha256', $this->security_key);
        $iv = substr(hash('sha256', 'BERAT_K_IV_2024'), 0, 16);
        return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv));
    }
    
    /**
     * Veri çözme
     */
    private function decrypt_data($encrypted_data) {
        $key = hash('sha256', $this->security_key);
        $iv = substr(hash('sha256', 'BERAT_K_IV_2024'), 0, 16);
        return openssl_decrypt(base64_decode($encrypted_data), 'AES-256-CBC', $key, 0, $iv);
    }
    
    /**
     * Domain kontrolü
     */
    private function domain_check() {
        $current_domain = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $domain_hash = hash('sha256', $current_domain);
        
        return in_array($domain_hash, $this->authorized_domains);
    }
    
    /**
     * Bütünlük kontrolü
     */
    private function verify_integrity() {
        $plugin_file = ALD_PLUGIN_FILE ?? __FILE__;
        $content = file_get_contents($plugin_file);
        
        // Kritik string'lerin varlığını kontrol et
        $critical_strings = array(
            'BERAT K',
            '0539 511 56 32',
            'wa.me/905395115632'
        );
        
        foreach ($critical_strings as $string) {
            if (strpos($content, $string) === false) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Dosya bütünlüğü kontrolü
     */
    private function check_file_integrity() {
        $plugin_file = ALD_PLUGIN_FILE ?? __FILE__;
        $content = file_get_contents($plugin_file);
        $content_hash = hash('sha256', $content);
        
        $stored_hash = get_option('ald_file_hash', '');
        
        if (empty($stored_hash)) {
            update_option('ald_file_hash', $content_hash);
            return true;
        }
        
        // Hash değişmişse dosya değiştirilmiş demektir
        if ($stored_hash !== $content_hash) {
            // Güvenlik ihlali logla
            $this->log_security_violation('file_integrity', $content_hash);
            return false;
        }
        
        return true;
    }
    
    /**
     * Lisans anahtarı doğrulama
     */
    private function verify_license_key() {
        $stored_license = get_option('ald_license_key_hash', '');
        $expected_license = hash('sha256', 'BERAT-K-DEVELOPER-LICENSE-KEY');
        
        return $stored_license === $expected_license;
    }
    
    /**
     * Geliştirici imzası doğrulama
     */
    private function verify_developer_signature($signature) {
        return $signature === hash('sha256', 'BERAT_K_ORIGINAL_DEVELOPER_2024');
    }
    
    /**
     * Görüntüleme bağlamı doğrulama
     */
    private function verify_display_context() {
        // Admin panel veya frontend kontrolü
        if (is_admin() || is_user_logged_in() || !defined('ABSPATH')) {
            return true;
        }
        
        return true; // Genel erişime izin ver
    }
    
    /**
     * Güvenlik zaman damgası
     */
    private function get_security_timestamp() {
        return hash('md5', current_time('timestamp') . $this->security_key);
    }
    
    /**
     * Güvenlik zaman damgasını güncelle
     */
    private function update_security_timestamp() {
        update_option('ald_last_security_check', current_time('mysql'));
    }
    
    /**
     * Sahte geliştirici bilgisi (güvenlik ihlali durumunda)
     */
    private function get_fake_developer_info() {
        return array(
            'name' => 'Unknown Developer',
            'phone' => 'Not Available',
            'whatsapp' => '#',
            'copyright' => 'Unauthorized Copy Detected'
        );
    }
    
    /**
     * Güvenlik ihlali durumunda
     */
    private function security_violation() {
        // Plugin'i deaktive et
        deactivate_plugins(plugin_basename(ALD_PLUGIN_FILE));
        
        // Admin uyarısı
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Güvenlik İhlali!</strong> Plugin bütünlüğü bozulmuş. Geliştirici: BERAT K - WhatsApp: +90 539 511 56 32</p></div>';
        });
        
        $this->log_security_violation('integrity_violation');
    }
    
    /**
     * Yetkisiz domain durumunda
     */
    private function unauthorized_domain() {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-warning"><p><strong>Lisans Uyarısı!</strong> Bu domain için lisans geçerli değil. İletişim: BERAT K - WhatsApp: +90 539 511 56 32</p></div>';
        });
        
        $this->log_security_violation('unauthorized_domain', $_SERVER['HTTP_HOST'] ?? 'unknown');
    }
    
    /**
     * Dosya değişikliği tespit edildiğinde
     */
    private function file_tampering_detected() {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Dosya Değişikliği Tespit Edildi!</strong> Plugin dosyaları değiştirilmiş. Orijinal versiyon için: BERAT K - WhatsApp: +90 539 511 56 32</p></div>';
        });
        
        $this->log_security_violation('file_tampering');
    }
    
    /**
     * Geçersiz lisans durumunda
     */
    private function invalid_license() {
        add_action('admin_notices', function() {
            echo '<div class="notice notice-error"><p><strong>Geçersiz Lisans!</strong> Lisans anahtarı doğrulanamadı. Geliştirici: BERAT K - WhatsApp: +90 539 511 56 32</p></div>';
        });
        
        $this->log_security_violation('invalid_license');
    }
    
    /**
     * Güvenlik ihlali kayıt
     */
    private function log_security_violation($type, $data = '') {
        $log_entry = array(
            'type' => $type,
            'timestamp' => current_time('mysql'),
            'domain' => $_SERVER['HTTP_HOST'] ?? 'unknown',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'data' => $data
        );
        
        $existing_logs = get_option('ald_security_logs', array());
        $existing_logs[] = $log_entry;
        
        // Son 100 kaydı tut
        if (count($existing_logs) > 100) {
            $existing_logs = array_slice($existing_logs, -100);
        }
        
        update_option('ald_security_logs', $existing_logs);
        
        // Kritik ihlallerde remote bildirim (opsiyonel)
        if (in_array($type, array('integrity_violation', 'file_tampering'))) {
            $this->send_security_alert($log_entry);
        }
    }
    
    /**
     * Remote güvenlik uyarısı gönder
     */
    private function send_security_alert($log_entry) {
        // Bu kısım opsiyonel - remote sunucuya bildirim gönderebilir
        $alert_data = array(
            'plugin' => 'WooCommerce License Delivery',
            'developer' => 'BERAT K',
            'violation' => $log_entry
        );
        
        // wp_remote_post ile güvenlik sunucusuna bildirim gönderebilirsiniz
        // Şimdilik local log yeterli
    }
    
    /**
     * Güvenlik durumu kontrolü (Admin için)
     */
    public function get_security_status() {
        return array(
            'integrity' => $this->verify_integrity(),
            'domain' => $this->domain_check(),
            'license' => $this->verify_license_key(),
            'last_check' => get_option('ald_last_security_check', 'Never'),
            'violations' => count(get_option('ald_security_logs', array()))
        );
    }
}

// Güvenlik sistemini başlat
BeratKSecurityProtection::get_instance();