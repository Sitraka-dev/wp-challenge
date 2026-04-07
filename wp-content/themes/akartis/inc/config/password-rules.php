<?php
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
 * Fonction de validation des règles de mot de passe
 */
function validate_password_strength($password, $username = '') {
    $errors = array();
    
    // Règle 1: Longueur minimale
    if (strlen($password) < 8) {
        $errors[] = __('Le mot de passe doit contenir au moins 8 caractères.', 'textdomain');
    }
    
    // Règle 2: Au moins une majuscule
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins une lettre majuscule.', 'textdomain');
    }
    
    // Règle 3: Au moins une minuscule
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins une lettre minuscule.', 'textdomain');
    }
    
    // Règle 4: Au moins un chiffre
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins un chiffre.', 'textdomain');
    }
    
    // Règle 5: Au moins un caractère spécial
    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = __('Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*).', 'textdomain');
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
            
            // Longueur minimale
            if (password.length < 8) {
                errors.push('❌ Au moins 8 caractères');
            } else {
                success.push('✅ Longueur suffisante');
            }
            
            // Majuscule
            if (!/[A-Z]/.test(password)) {
                errors.push('❌ Au moins une majuscule');
            } else {
                success.push('✅ Contient une majuscule');
            }
            
            // Minuscule
            if (!/[a-z]/.test(password)) {
                errors.push('❌ Au moins une minuscule');
            } else {
                success.push('✅ Contient une minuscule');
            }
            
            // Chiffre
            if (!/[0-9]/.test(password)) {
                errors.push('❌ Au moins un chiffre');
            } else {
                success.push('✅ Contient un chiffre');
            }
            
            // Caractère spécial
            if (!/[^A-Za-z0-9]/.test(password)) {
                errors.push('❌ Au moins un caractère spécial');
            } else {
                success.push('✅ Contient un caractère spécial');
            }
            
            // Nom d'utilisateur
            if (username && password.toLowerCase().indexOf(username.toLowerCase()) !== -1) {
                errors.push('❌ Ne doit pas contenir le nom d\'utilisateur');
            } else if (username) {
                success.push('✅ Ne contient pas le nom d\'utilisateur');
            }
            
            // Afficher le feedback
            displayPasswordFeedback(errors, success);
        }
        
        function displayPasswordFeedback(errors, success) {
            $('#password-validation-feedback').remove();
            
            var feedback = '<div id="password-validation-feedback" style="margin-top: 10px; padding: 10px; border-radius: 4px;">';
            
            if (errors.length === 0) {
                feedback += '<div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb;">';
                feedback += '<strong>✅ Mot de passe fort !</strong><br>';
                feedback += success.join('<br>');
                feedback += '</div>';
            } else {
                feedback += '<div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;">';
                feedback += '<strong>⚠️ Améliorations nécessaires :</strong><br>';
                feedback += errors.join('<br>');
                if (success.length > 0) {
                    feedback += '<br><br><strong>Validé :</strong><br>';
                    feedback += success.join('<br>');
                }
                feedback += '</div>';
            }
            
                                        feedback += '</div>';
            $('#pass1').after(feedback);
        }
        
        // Désactiver le bouton de soumission si le mot de passe n'est pas valide
        $('form').on('submit', function(e) {
            var password = $('#pass1').val();
            var username = $('#user_login').val() || $('#nickname').val() || '';
            
            if (password && !isPasswordValid(password, username)) {
                e.preventDefault();
                alert('Veuillez corriger les erreurs du mot de passe avant de continuer.');
                return false;
            }
        });
        
        function isPasswordValid(password, username) {
            return password.length >= 8 &&
                   /[A-Z]/.test(password) &&
                   /[a-z]/.test(password) &&
                   /[0-9]/.test(password) &&
                   /[^A-Za-z0-9]/.test(password) &&
                   (!username || password.toLowerCase().indexOf(username.toLowerCase()) === -1);
        }
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
        'Règles de mot de passe',
        'Règles de mot de passee',
        'manage_options',
        'password-rules',
        'password_rules_admin_page'
    );
}

function password_rules_admin_page() {
    if (isset($_POST['submit'])) {
        update_option('custom_password_min_length', intval($_POST['min_length']));
        update_option('custom_password_require_uppercase', isset($_POST['require_uppercase']));
        update_option('custom_password_require_lowercase', isset($_POST['require_lowercase']));
        update_option('custom_password_require_numbers', isset($_POST['require_numbers']));
        update_option('custom_password_require_special', isset($_POST['require_special']));
        
        echo '<div class="notice notice-success"><p>Paramètres sauvegardés !</p></div>';
    }
    
    $min_length         = get_option('custom_password_min_length', 8);
    $require_uppercase  = get_option('custom_password_require_uppercase', true);
    $require_lowercase  = get_option('custom_password_require_lowercase', true);
    $require_numbers    = get_option('custom_password_require_numbers', true);
    $require_special    = get_option('custom_password_require_special', true);
    ?>
    
    <div class="wrap">
        <h1>Configuration des règles de mot de passe</h1>
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Longueur minimale</th>
                    <td>
                        <input type="range" name="min_length" min="1" max="100" step="1" value="<?php echo $min_length; ?>" />
                        <p class="description">Nombre minimum de caractères requis : </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Exigences</th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="checkbox" name="require_uppercase" <?php checked($require_uppercase); ?> />
                                Exiger au moins une lettre majuscule
                            </label><br>
                            <label>
                                <input type="checkbox" name="require_lowercase" <?php checked($require_lowercase); ?> />
                                Exiger au moins une lettre minuscule
                            </label><br>
                            <label>
                                <input type="checkbox" name="require_numbers" <?php checked($require_numbers); ?> />
                                Exiger au moins un chiffre
                            </label><br>
                            <label>
                                <input type="checkbox" name="require_special" <?php checked($require_special); ?> />
                                Exiger au moins un caractère spécial
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// 4. Version avancée utilisant les options configurables
function validate_password_strength_configurable($password, $username = '') {
    $errors = array();
    
    $min_length         = get_option('custom_password_min_length', 8);
    $max_length         = get_option('custom_password_max_length', 8);
    $require_uppercase  = get_option('custom_password_require_uppercase', true);
    $require_lowercase  = get_option('custom_password_require_lowercase', true);
    $require_numbers    = get_option('custom_password_require_numbers', true);
    $require_special    = get_option('custom_password_require_special', true);
    
    if (strlen($password) < $min_length) {
        $errors[] = sprintf(__('Le mot de passe doit contenir au moins %d caractères.', 'textdomain'), $min_length);
    }

    if ($max_length > 0 && strlen($password) < $max_length) {
        $errors[] = sprintf(__('Le mot de passe doit contenir au plus %d caractères.', 'textdomain'), $max_length);
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