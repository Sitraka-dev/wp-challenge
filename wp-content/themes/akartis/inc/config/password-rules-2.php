<?php 

// 4. Version avancée utilisant les options configurables
function validate_password_strength_configurable($password, $username = '') {
    return validate_password_strength($password, $username); // Utiliser la fonction principale mise à jour
}

// 5. Fonction utilitaire pour obtenir les règles actuelles (pour affichage)
function get_current_password_rules() {
    return array(
        'min_length' => get_option('custom_password_min_length', 8),
        'min_uppercase' => get_option('custom_password_min_uppercase', 1),
        'min_lowercase' => get_option('custom_password_min_lowercase', 1),
        'min_numbers' => get_option('custom_password_min_numbers', 1),
        'min_special' => get_option('custom_password_min_special', 1)
    );
}

// 6. Générateur de mot de passe respectant les règles
function generate_compliant_password() {
    $rules = get_current_password_rules();
    $password = '';
    
    // Caractères disponibles
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $special = '!@#$%^&*()_+-=[]{}|;:,.<>?';
    
    // Ajouter le nombre requis de chaque type
    for ($i = 0; $i < $rules['min_uppercase']; $i++) {
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    }
    for ($i = 0; $i < $rules['min_lowercase']; $i++)
/**
 * Validation de mot de passe personnalisée pour WordPress Admin
 * À ajouter dans functions.php du thème ou dans un plugin
 */

// 1. Validation côté serveur lors de la création/modification d'utilisateur
add_action('user_profile_update_errors', 'validate_custom_password_rules', 10, 3);

function validate_custom_password_rules($errors, $update, $user) {
    // Vérifier si un nouveau mot de passe est défini
    if (!empty($_POST['pass1'])) {
        $password = $_POST['pass1'];
        $username = isset($_POST['user_login']) ? $_POST['user_login'] : $user->user_login;
        
        // Règles de validation personnalisées
        $validation_errors = validate_password_strength($password, $username);
        
        // Ajouter les erreurs à l'objet WP_Error
        foreach ($validation_errors as $error) {
            $errors->add('weak_password', $error);
        }
    }
}

/**
 * Fonction de validation des règles de mot de passe avec compteurs dynamiques
 */
function validate_password_strength($password, $username = '') {
    $errors = array();
    
    // Récupérer les paramètres configurés
    $min_length = get_option('custom_password_min_length', 8);
    $min_uppercase = get_option('custom_password_min_uppercase', 1);
    $min_lowercase = get_option('custom_password_min_lowercase', 1);
    $min_numbers = get_option('custom_password_min_numbers', 1);
    $min_special = get_option('custom_password_min_special', 1);
    
    // Règle 1: Longueur minimale
    if (strlen($password) < $min_length) {
        $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d caractères.', 'textdomain'), $min_length);
    }
    
    // Règle 2: Compter et vérifier les majuscules
    if ($min_uppercase > 0) {
        $uppercase_count = preg_match_all('/[A-Z]/', $password);
        if ($uppercase_count < $min_uppercase) {
            $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d lettre(s) majuscule(s). Trouvé : %d', 'textdomain'), $min_uppercase, $uppercase_count);
        }
    }
    
    // Règle 3: Compter et vérifier les minuscules
    if ($min_lowercase > 0) {
        $lowercase_count = preg_match_all('/[a-z]/', $password);
        if ($lowercase_count < $min_lowercase) {
            $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d lettre(s) minuscule(s). Trouvé : %d', 'textdomain'), $min_lowercase, $lowercase_count);
        }
    }
    
    // Règle 4: Compter et vérifier les chiffres
    if ($min_numbers > 0) {
        $numbers_count = preg_match_all('/[0-9]/', $password);
        if ($numbers_count < $min_numbers) {
            $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d chiffre(s). Trouvé : %d', 'textdomain'), $min_numbers, $numbers_count);
        }
    }
    
    // Règle 5: Compter et vérifier les caractères spéciaux
    if ($min_special > 0) {
        $special_count = preg_match_all('/[^A-Za-z0-9]/', $password);
        if ($special_count < $min_special) {
            $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d caractère(s) spécial/spéciaux. Trouvé : %d', 'textdomain'), $min_special, $special_count);
        }
    }
    
    // Règle 6: Ne doit pas contenir le nom d'utilisateur
    if (!empty($username) && stripos($password, $username) !== false) {
        $errors[] = __('Le mot de passe ne peut pas contenir le nom d\'utilisateur.', 'textdomain');
    }
    
    // Règle 7: Ne doit pas être dans la liste des mots de passe communs
    $common_passwords = array('password', '123456', 'admin', 'qwerty', 'azerty', 'motdepasse');
    if (in_array(strtolower($password), $common_passwords)) {
        $errors[] = __('Ce mot de passe est trop commun. Veuillez en choisir un autre.', 'textdomain');
    }
    
    // Règle 8: Pas de caractères consécutifs identiques (plus de 2)
    if (preg_match('/(.)\1{2,}/', $password)) {
        $errors[] = __('Le mot de passe ne peut pas contenir plus de 2 caractères identiques consécutifs.', 'textdomain');
    }
    
    return $errors;
}

// 2. JavaScript pour validation en temps réel côté client
add_action('admin_footer-user-new.php', 'password_validation_script');
add_action('admin_footer-user-edit.php', 'password_validation_script');
add_action('admin_footer-profile.php', 'password_validation_script');

function password_validation_script() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Récupérer les paramètres via AJAX au chargement
        var passwordRules = {
            minLength: <?php echo get_option('custom_password_min_length', 8); ?>,
            minUppercase: <?php echo get_option('custom_password_min_uppercase', 1); ?>,
            minLowercase: <?php echo get_option('custom_password_min_lowercase', 1); ?>,
            minNumbers: <?php echo get_option('custom_password_min_numbers', 1); ?>,
            minSpecial: <?php echo get_option('custom_password_min_special', 1); ?>
        };
        
        // Validation en temps réel
        $('#pass1').on('keyup', function() {
            var password = $(this).val();
            var username = $('#user_login').val() || $('#nickname').val() || '';
            
            if (password.length > 0) {
                validatePasswordRealTime(password, username);
            } else {
                $('#password-validation-feedback').remove();
            }
        });
        
        function validatePasswordRealTime(password, username) {
            var errors = [];
            var success = [];
            
            // Compter les différents types de caractères
            var uppercaseCount = (password.match(/[A-Z]/g) || []).length;
            var lowercaseCount = (password.match(/[a-z]/g) || []).length;
            var numbersCount = (password.match(/[0-9]/g) || []).length;
            var specialCount = (password.match(/[^A-Za-z0-9]/g) || []).length;
            
            // Longueur minimale
            if (password.length < passwordRules.minLength) {
                errors.push('❌ Au moins ' + passwordRules.minLength + ' caractères (actuel: ' + password.length + ')');
            } else {
                success.push('✅ Longueur suffisante (' + password.length + ' caractères)');
            }
            
            // Majuscules
            if (passwordRules.minUppercase > 0) {
                if (uppercaseCount < passwordRules.minUppercase) {
                    errors.push('❌ Au moins ' + passwordRules.minUppercase + ' majuscule(s) (actuel: ' + uppercaseCount + ')');
                } else {
                    success.push('✅ ' + uppercaseCount + ' majuscule(s) - OK');
                }
            }
            
            // Minuscules
            if (passwordRules.minLowercase > 0) {
                if (lowercaseCount < passwordRules.minLowercase) {
                    errors.push('❌ Au moins ' + passwordRules.minLowercase + ' minuscule(s) (actuel: ' + lowercaseCount + ')');
                } else {
                    success.push('✅ ' + lowercaseCount + ' minuscule(s) - OK');
                }
            }
            
            // Chiffres
            if (passwordRules.minNumbers > 0) {
                if (numbersCount < passwordRules.minNumbers) {
                    errors.push('❌ Au moins ' + passwordRules.minNumbers + ' chiffre(s) (actuel: ' + numbersCount + ')');
                } else {
                    success.push('✅ ' + numbersCount + ' chiffre(s) - OK');
                }
            }
            
            // Caractères spéciaux
            if (passwordRules.minSpecial > 0) {
                if (specialCount < passwordRules.minSpecial) {
                    errors.push('❌ Au moins ' + passwordRules.minSpecial + ' caractère(s) spécial/spéciaux (actuel: ' + specialCount + ')');
                } else {
                    success.push('✅ ' + specialCount + ' caractère(s) spécial/spéciaux - OK');
                }
            }
            
            // Nom d'utilisateur
            if (username && password.toLowerCase().indexOf(username.toLowerCase()) !== -1) {
                errors.push('❌ Ne doit pas contenir le nom d\'utilisateur');
            } else if (username) {
                success.push('✅ Ne contient pas le nom d\'utilisateur');
            }
            
            // Caractères consécutifs identiques
            if (/(.)\1{2,}/.test(password)) {
                errors.push('❌ Pas plus de 2 caractères identiques consécutifs');
            }
            
            // Afficher le feedback avec compteurs
            displayPasswordFeedback(errors, success, {
                uppercase: uppercaseCount,
                lowercase: lowercaseCount,
                numbers: numbersCount,
                special: specialCount,
                length: password.length
            });
        }
        
        function displayPasswordFeedback(errors, success, counts) {
            $('#password-validation-feedback').remove();
            
            var feedback = '<div id="password-validation-feedback" style="margin-top: 10px; padding: 15px; border-radius: 4px; border: 1px solid;">';
            
            // Afficher les compteurs actuels
            feedback += '<div style="margin-bottom: 10px; padding: 8px; background: #f8f9fa; border-radius: 3px;">';
            feedback += '<strong>📊 Analyse du mot de passe :</strong><br>';
            feedback += 'Longueur: ' + counts.length + ' | ';
            feedback += 'Majuscules: ' + counts.uppercase + ' | ';
            feedback += 'Minuscules: ' + counts.lowercase + ' | ';
            feedback += 'Chiffres: ' + counts.numbers + ' | ';
            feedback += 'Spéciaux: ' + counts.special;
            feedback += '</div>';
            
            if (errors.length === 0) {
                feedback += '<div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 3px;">';
                feedback += '<strong>✅ Mot de passe fort ! Toutes les exigences sont respectées.</strong><br>';
                if (success.length > 0) {
                    feedback += success.join('<br>');
                }
                feedback += '</div>';
            } else {
                feedback += '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px; margin-bottom: 10px;">';
                feedback += '<strong>⚠️ Améliorations nécessaires :</strong><br>';
                feedback += errors.join('<br>');
                feedback += '</div>';
                
                if (success.length > 0) {
                    feedback += '<div style="background-color: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 3px;">';
                    feedback += '<strong>✅ Exigences déjà respectées :</strong><br>';
                    feedback += success.join('<br>');
                    feedback += '</div>';
                }
            }
            
            feedback += '</div>';
            $('#pass1').after(feedback);
        }
        
        // Fonction de validation pour le formulaire
        function isPasswordValid(password, username) {
            var uppercaseCount = (password.match(/[A-Z]/g) || []).length;
            var lowercaseCount = (password.match(/[a-z]/g) || []).length;
            var numbersCount = (password.match(/[0-9]/g) || []).length;
            var specialCount = (password.match(/[^A-Za-z0-9]/g) || []).length;
            
            return password.length >= passwordRules.minLength &&
                   uppercaseCount >= passwordRules.minUppercase &&
                   lowercaseCount >= passwordRules.minLowercase &&
                   numbersCount >= passwordRules.minNumbers &&
                   specialCount >= passwordRules.minSpecial &&
                   (!username || password.toLowerCase().indexOf(username.toLowerCase()) === -1) &&
                   !/(.)\1{2,}/.test(password);
        }
        
        // Désactiver le bouton de soumission si le mot de passe n'est pas valide
        $('form').on('submit', function(e) {
            var password = $('#pass1').val();
            var username = $('#user_login').val() || $('#nickname').val() || '';
            
            if (password && !isPasswordValid(password, username)) {
                e.preventDefault();
                alert('Veuillez corriger les erreurs du mot de passe avant de continuer.');
                $('#pass1').focus();
                return false;
            }
        });
    });
    </script>
    
    <style>
    #password-validation-feedback {
        font-size: 12px;
        line-height: 1.4;
    }
    #password-validation-feedback strong {
        display: block;
        margin-bottom: 5px;
    }
    </style>
    <?php
}

// 3. Ajouter des règles personnalisées via les options WordPress
add_action('admin_menu', 'password_rules_admin_menu');

function password_rules_admin_menu() {
    add_options_page(
        'Règles de Mot de Passe',
        'Mots de Passe',
        'manage_options',
        'password-rules',
        'password_rules_admin_page'
    );
}

function password_rules_admin_page() {
    if (isset($_POST['submit'])) {
        update_option('custom_password_min_length', intval($_POST['min_length']));
        update_option('custom_password_min_uppercase', intval($_POST['min_uppercase']));
        update_option('custom_password_min_lowercase', intval($_POST['min_lowercase']));
        update_option('custom_password_min_numbers', intval($_POST['min_numbers']));
        update_option('custom_password_min_special', intval($_POST['min_special']));
        
        echo '<div class="notice notice-success"><p>Paramètres sauvegardés !</p></div>';
    }
    
    $min_length = get_option('custom_password_min_length', 8);
    $min_uppercase = get_option('custom_password_min_uppercase', 1);
    $min_lowercase = get_option('custom_password_min_lowercase', 1);
    $min_numbers = get_option('custom_password_min_numbers', 1);
    $min_special = get_option('custom_password_min_special', 1);
    ?>
    
    <div class="wrap">
        <h1>Configuration des Règles de Mot de Passe</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Longueur minimale</th>
                    <td>
                        <input type="number" name="min_length" value="<?php echo $min_length; ?>" min="4" max="50" />
                        <p class="description">Nombre minimum de caractères requis.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Lettres majuscules</th>
                    <td>
                        <input type="number" name="min_uppercase" value="<?php echo $min_uppercase; ?>" min="0" max="10" />
                        <p class="description">Nombre minimum de lettres majuscules (A-Z). 0 pour désactiver.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Lettres minuscules</th>
                    <td>
                        <input type="number" name="min_lowercase" value="<?php echo $min_lowercase; ?>" min="0" max="10" />
                        <p class="description">Nombre minimum de lettres minuscules (a-z). 0 pour désactiver.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Chiffres</th>
                    <td>
                        <input type="number" name="min_numbers" value="<?php echo $min_numbers; ?>" min="0" max="10" />
                        <p class="description">Nombre minimum de chiffres (0-9). 0 pour désactiver.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Caractères spéciaux</th>
                    <td>
                        <input type="number" name="min_special" value="<?php echo $min_special; ?>" min="0" max="10" />
                        <p class="description">Nombre minimum de caractères spéciaux (!@#$%^&*). 0 pour désactiver.</p>
                    </td>
                </tr>
            </table>
            
            <h2>Aperçu des règles actuelles</h2>
            <div style="background: #f0f0f1; padding: 15px; border-radius: 4px; margin: 20px 0;">
                <strong>Un mot de passe valide doit contenir :</strong><br>
                • Au moins <?php echo $min_length; ?> caractères<br>
                <?php if ($min_uppercase > 0): ?>
                • Au moins <?php echo $min_uppercase; ?> lettre(s) majuscule(s)<br>
                <?php endif; ?>
                <?php if ($min_lowercase > 0): ?>
                • Au moins <?php echo $min_lowercase; ?> lettre(s) minuscule(s)<br>
                <?php endif; ?>
                <?php if ($min_numbers > 0): ?>
                • Au moins <?php echo $min_numbers; ?> chiffre(s)<br>
                <?php endif; ?>
                <?php if ($min_special > 0): ?>
                • Au moins <?php echo $min_special; ?> caractère(s) spécial/spéciaux<br>
                <?php endif; ?>
            </div>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// 4. Version avancée utilisant les options configurables
function validate_password_strength_configurable($password, $username = '') {
    $errors = array();
    
    $min_length = get_option('custom_password_min_length', 8);
    $require_uppercase = get_option('custom_password_require_uppercase', true);
    $require_lowercase = get_option('custom_password_require_lowercase', true);
    $require_numbers = get_option('custom_password_require_numbers', true);
    $require_special = get_option('custom_password_require_special', true);
    
    if (strlen($password) < $min_length) {
        $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d caractères.', 'textdomain'), $min_length);
    }
    
    if ($require_uppercase && !preg_match('/[A-Z]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins une lettre majuscule.', 'textdomain');
    }
    
    if ($require_lowercase && !preg_match('/[a-z]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins une lettre minuscule.', 'textdomain');
    }
    
    if ($require_numbers && !preg_match('/[0-9]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins un chiffre.', 'textdomain');
    }
    
    if ($require_special && !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins un caractère spécial.', 'textdomain');
    }
    
    return $errors;
}

// 5. Hook pour appliquer les règles lors de la réinitialisation de mot de passe
add_action('validate_password_reset', 'validate_password_reset_custom', 10, 2);

function validate_password_reset_custom($errors, $user) {
    if (!empty($_POST['pass1'])) {
        $validation_errors = validate_password_strength($_POST['pass1'], $user->user_login);
        foreach ($validation_errors as $error) {
            $errors->add('weak_password', $error);
        }
    }
}

// 6. Notification pour informer les utilisateurs des nouvelles règles
add_action('admin_notices', 'password_rules_admin_notice');

function password_rules_admin_notice() {
    $screen = get_current_screen();
    if (in_array($screen->id, array('user', 'user-new', 'profile'))) {
        echo '<div class="notice notice-info">
                <p><strong>Règles de mot de passe :</strong> 8+ caractères, majuscule, minuscule, chiffre et caractère spécial requis.</p>
              </div>';
    }
}
?>