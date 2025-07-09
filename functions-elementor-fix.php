// Elementor sayfalarında BERAT K Lisans CSS'ini yükle
function berat_k_license_elementor_css() {
    if (class_exists('\Elementor\Plugin')) {
        ?>
        <style id="berat-k-license-elementor-css">
        /* BERAT K Lisans Eklentisi - Elementor Uyumlu CSS */
        .license-keys-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            border-radius: 15px !important;
            padding: 25px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3) !important;
            margin: 20px 0 !important;
            position: relative !important;
            overflow: hidden !important;
            animation: float 6s ease-in-out infinite !important;
        }

        .license-keys-container::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent) !important;
            animation: shimmer 3s infinite !important;
            z-index: 1 !important;
        }

        .license-key-box {
            background: rgba(255,255,255,0.95) !important;
            border-radius: 12px !important;
            padding: 20px !important;
            margin: 15px 0 !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
            position: relative !important;
            z-index: 2 !important;
            transition: all 0.3s ease !important;
        }

        .waiting-container {
            text-align: center !important;
            padding: 40px 20px !important;
            background: rgba(255,255,255,0.1) !important;
            border-radius: 15px !important;
            margin: 20px 0 !important;
        }

        .clock-animation {
            width: 120px !important;
            height: 120px !important;
            border: 8px solid rgba(255,255,255,0.3) !important;
            border-radius: 50% !important;
            position: relative !important;
            margin: 0 auto 20px !important;
            animation: pulse 2s ease-in-out infinite !important;
        }

        .copy-license-btn {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            color: white !important;
            border: none !important;
            padding: 12px 25px !important;
            border-radius: 25px !important;
            cursor: pointer !important;
            font-weight: bold !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
        }

        /* Animasyonlar */
        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        /* Mobil uyumluluk */
        @media (max-width: 768px) {
            .license-keys-container {
                padding: 15px !important;
                margin: 10px !important;
            }
            .clock-animation {
                width: 80px !important;
                height: 80px !important;
            }
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'berat_k_license_elementor_css', 999);

// Elementor önizleme modunda da çalışsın
add_action('elementor/frontend/after_enqueue_styles', 'berat_k_license_elementor_css');