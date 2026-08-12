<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALSEA | {{ __('Explore Halmahera Selatan') }}</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        /* Google Translate Element Overrides */
        body { top: 0 !important; }
        .skiptranslate iframe { display: none !important; }
        
        /* Hide Google Translate completely, we use a custom proxy select */
        .goog-te-banner-frame { display: none !important; }
        .skiptranslate iframe { display: none !important; }
        body { top: 0 !important; }
        
        /* Hide the original text popup tooltip when hovering */
        #goog-gt-tt, .goog-tooltip { display: none !important; }
        
        /* Force remove the blue highlight on hover */
        html body .goog-text-highlight,
        html body .goog-text-highlight:hover,
        html body span.goog-text-highlight,
        html body font.goog-text-highlight { 
            background-color: transparent !important; 
            box-shadow: none !important;
            border: none !important; 
        }
    </style>
    @livewireStyles
</head>
<body class="bg-surface text-on-surface font-body-md overflow-x-hidden">
    
    <x-public-navigation />

    <main>
        {{ $slot }}
    </main>

    <x-public-footer />

    @livewireScripts
    
    <!-- Google Translate Script -->
    <script type="text/javascript">
        // Prevent Google Translate from translating Material Icons
        document.addEventListener('DOMContentLoaded', function() {
            const icons = document.querySelectorAll('.material-symbols-outlined');
            icons.forEach(icon => {
                icon.classList.add('notranslate');
                icon.setAttribute('translate', 'no');
            });
        });

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id', // Bahasa asli website (Indonesia)
                includedLanguages: 'en,nl,ja,zh-CN' // Bahasa terjemahan
            }, 'google_translate_element');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const customSelect = document.getElementById('custom_lang_selector');
            
            if (customSelect) {
                // Check cookie for initial language
                const match = document.cookie.match(/(^|;) ?googtrans=([^;]*)(;|$)/);
                if (match) {
                    const lang = match[2].split('/').pop();
                    if (lang && customSelect.querySelector(`option[value="${lang}"]`)) {
                        customSelect.value = lang;
                    }
                }

                // Sync with Google Translate combobox
                let attempts = 0;
                const syncInterval = setInterval(() => {
                    const googleSelect = document.querySelector('.goog-te-combo');
                    if (googleSelect) {
                        clearInterval(syncInterval);
                        
                        customSelect.addEventListener('change', function() {
                            if (this.value === '') {
                                // Clear Google Translate cookies and reload to restore original text
                                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=" + location.hostname + "; path=/;";
                                document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; domain=." + location.hostname + "; path=/;";
                                location.reload();
                            } else {
                                googleSelect.value = this.value;
                                googleSelect.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        });
                    }
                    attempts++;
                    if (attempts > 50) clearInterval(syncInterval);
                }, 500);
            }
        });

        // Ultimate fix for Google Translate hover highlight
        document.addEventListener('mouseover', function(e) {
            if (e.target && e.target.tagName === 'FONT') {
                e.target.style.backgroundColor = 'transparent';
                e.target.style.boxShadow = 'none';
                if (e.target.classList.contains('goog-text-highlight')) {
                    e.target.classList.remove('goog-text-highlight');
                }
            }
        }, true);
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    @stack('scripts')
</body>
</html>
