<script src="https://cdn.tailwindcss.com"></script>
<?php
/*
Plugin Name: Signal
Plugin URI: https://github.com/AzizHr
Description: Plugin de signal personnalisé pour WordPress
Version: 1.0
Author: Aziz
Author URI: https://github.com/AzizHr
*/
// Fonction d'activation du plugin
function mon_plugin_activation()   // function pour ajouter une table sur base de donnée juste aprés l'activation du plugin
{
    global $wpdb; //$wpdb comme statement du php
    $table_name = $wpdb->prefix . 'signal';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom varchar(255) NOT NULL,
        prenom varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        type_signal varchar(255) NOT NULL,
        raison_signal varchar(255) NOT NULL,
        commentaire varchar(255) NOT NULL,
        date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql); //execute query du wordpress
}
register_activation_hook(__FILE__, 'mon_plugin_activation'); // once the plugin activated by the user this function is called

// Fonction de désactivation du plugin
function mon_plugin_desactivation()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
register_deactivation_hook(__FILE__, 'mon_plugin_desactivation');

function signal_add_menu_page()
{
    add_menu_page(
        __('Signal', 'textdomain'),
        'Signal',
        'manage_options',
        'Signal',
        '',
        'dashicons-admin-plugins',
        6
    );
    add_submenu_page(
        'Signal',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'Signal',
        'Signal_callback'
    );
}
add_action('admin_menu', 'signal_add_menu_page');

function Signal_callback()
{
?>
    <form class="grid w-1/2 mx-auto gap-3 bg-gray-50 py-4 px-4 rounded shadow-md mt-10" id="form">
        <div class="flex gap-1 items-center">
            <input class="mt-4" type="radio" name="nom" id="nom">
            <label for="nom">nom</label>
        </div>
        <div class="flex gap-1 items-center">
            <input type="radio" name="prenom" id="prenom">
            <label for="prenom">prenom</label>
        </div>
        <div class="flex gap-1 items-center">
            <input type="radio" name="email" id="email">
            <label for="email">Email</label>
        </div>
        <div class="flex gap-1 items-center">
            <input type="radio" name="type_signal" id="type_signal">
            <label for="type_signal">le type de signal</label>
        </div>
        <div class="flex gap-1 items-center">
            <input type="radio" name="raison_signal" id="raison_signal">
            <label for="raison_signal">le raison de votre signal</label>
        </div>
        <div class="flex gap-1 items-center">
            <input type="radio" name="commentaire" id="commentaire">
            <label for="commentaire">un commentaire</label>
        </div>
        <div>
            <input class="py-2 px-4 bg-blue-500 rounded font-bold text-gray-100" type="submit" value="Apply">
        </div>
    </form>
    <script>
        var form = document.getElementById('form')
        form.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(form);
            const data = Object.fromEntries(formData);
            if (data.nom == 'on') {
                var nomInput = `<div class="grid gap-1">
                                    <label for="nom">Nom:</label>
                                    <input class="px-4 py-2 border border-1 border-black rounded" type="text" name="nom" id="nom">
                                </div>`
            } else {
                var nomInput = `<input type="hidden" value=' ' name="nom" id="nom">`
            }
            if (data.prenom == 'on') {
                var prenomInput = `<div class="grid gap-1">
                                    <label for="prenom">Prenom:</label>
                                    <input class="px-4 py-2 border border-1 border-black rounded" type="text" name="prenom" id="prenom">
                                </div>`
            } else {
                var prenomInput = `<input type="hidden" value=' ' name="prenom" id="prenom">`
            }
            if (data.email == 'on') {
                var emailInput = `<div class="grid gap-1">
                                    <label for="email">Email:</label>
                                    <input class="px-4 py-2 border border-1 border-black rounded" type="email" name="email" id="email">
                                </div>`
            } else {
                var emailInput = `<input type="hidden" value=' ' name="email" id="email">`
            }
            if (data.type_signal == 'on') {
                var typeInput = `<div class="grid gap-1">
                                    <label for="type_signal">Type de signal:</label>
                                    <select class="px-4 py-2 border border-1 border-black rounded" name="type_signal" id="type_signal">
                                        <option value="temporary">temporary</option>
                                        <option value="permanent">permanent</option>
                                        <option value="RTP">RTP</option>
                                    </select>
                                </div>`
            } else {
                var typeInput = `<input type="hidden" value=' ' name="type_signal" id="type_signal">`
            }
            if (data.raison_signal == 'on') {
                var raisonInput = `<div class="grid gap-1">
                                    <label for="raison_signal">Raison de signal:</label>
                                    <select class="px-4 py-2 border border-1 border-black rounded" name="raison_signal" id="raison_signal">
                                        <option value="Personal">Personal</option>
                                        <option value="MLK">MLK</option>
                                        <option value="ORM">ORM</option>
                                    </select>
                                </div>`
            } else {
                var raisonInput = `<input type="hidden" value=' ' name="raison_signal" id="raison_signal">`
            }
            if (data.commentaire == 'on') {
                var commentaireInput = `<div class="grid gap-1">
                                    <label for="commentaire">commentaire:</label>
                                    <textarea class="px-4 py-2 border border-1 border-black rounded" style="resize:none" name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                                </div>`
            } else {
                var commentaireInput = `<input type="hidden" value=' ' name="commentaire" id="commentaire">`
            }
            var formSelected = `<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                                    ${nomInput}
                                    ${prenomInput}
                                    ${emailInput}
                                    ${typeInput}
                                    ${raisonInput}
                                    ${commentaireInput}
                                    <div>
                                        <input class="px-4 py-2 border border-1 border-black rounded" type="hidden" name="action" value="mon_plugin_register"> 
                                        <input class="py-2 px-4 mt-4 rounded bg-green-600 font-bold text-gray-100" type="submit" value="Envoyer">
                                    </div>
                                </form>`
            localStorage.setItem("formSelected", formSelected)
            location.replace("http://localhost/plugin/form");
        })
    </script>
<?php
}
function mon_plugin_shortcode_signal()
{
    ob_start();
?>
    <p id="p"></p>
    <script>
        var p = document.getElementById('p')
        var formSelected = localStorage.getItem("formSelected")
        p.innerHTML = formSelected
    </script>
<?php
    return ob_get_clean();
}
add_shortcode('mon_plugin_form_signal', 'mon_plugin_shortcode_signal');
function mon_plugin_register()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';


    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $type_signal = $_POST['type_signal'];
    $raison_signal = $_POST['raison_signal'];
    $commentaire = $_POST['commentaire'];

    $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'type_signal' => $type_signal,
            'raison_signal' => $raison_signal,
            'commentaire' => $commentaire
        )
    );

    wp_redirect(home_url(''));
    exit;
}
add_action('admin_post_mon_plugin_register', 'mon_plugin_register');
function affiche_signal_add_menu_page()
{
    add_menu_page(
        __('affiche_Signal', 'textdomain'),
        'affiche_Signal',
        'manage_options',
        'affiche_Signal',
        '',
        'dashicons-admin-home',
        6
    );
    add_submenu_page(
        'affiche_Signal',
        __('Books Shortcode Reference', 'textdomain'),
        __('Shortcode Reference', 'textdomain'),
        'manage_options',
        'affiche_Signal',
        'affiche_Signal_callback'
    );
}
add_action('admin_menu', 'affiche_signal_add_menu_page');

function affiche_Signal_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'signal';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
?>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">nom</th>
                <th scope="col" class="px-6 py-3">prenom</th>
                <th scope="col" class="px-6 py-3">email</th>
                <th scope="col" class="px-6 py-3">type_signal</th>
                <th scope="col" class="px-6 py-3">raison_signal</th>
                <th scope="col" class="px-6 py-3">commentaire</th>
                <th scope="col" class="px-6 py-3">date</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            <?php foreach ($results as $result) { ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><?= $result->nom ?></td>
                    <td class="px-6 py-4"><?= $result->prenom ?></td>
                    <td class="px-6 py-4"><?= $result->email ?></td>
                    <td class="px-6 py-4"><?= $result->type_signal ?></td>
                    <td class="px-6 py-4"><?= $result->raison_signal ?></td>
                    <td class="px-6 py-4"><?= $result->commentaire ?></td>
                    <td class="px-6 py-4"><?= $result->date ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php
}
?>
<script src="https://cdn.tailwindcss.com"></script>