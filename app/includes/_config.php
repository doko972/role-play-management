<?php

$globalUrl = 'http://localhost:8080';

$errors = [
    'csrf' => 'Votre session est invalide.',
    'referer' => 'D\'où venez vous ?',
    'insert_ko' => 'Erreur lors de la sauvegarde de l\'utilisateur.',
    'update_ko' => 'Erreur lors de la modification de l\'utilisateur.',
    'delete_ko' => 'Erreur lors de la suppression de l\'utilisateur.',
    'no_action' => 'Aucune action identifiée.',
    'upload_fail' => 'Erreur lors de l\'upload de l\'image.',
    'login_fail' => 'Échec de la connexion, vérifiez votre email et votre mot de passe.',
    'access_denied' => 'Accès refusé.',
    'card_no_free' => 'Le rôle est déjà pris',
    'no_story' => 'Aucune histoire à été trouvée',
    'card_not_find' => 'La carte n\'a pas été trouvée',
    'invalid_date_format' => 'Format de date invalide. Utilisez Jour/Mois/Année (JJ/MM/AAAA).',
    'password_mismatch' => 'Les mots de passe ne correspondent pas.',
    'registration_failed' => 'Erreur lors de l\'enregistrement de l\'utilisateur.',
    'invalid_input' => 'Mauvaise saisie.'
];

$messages = [
    'insert_ok' => 'Utilisateur sauvegardé avec succès.',
    'update_ok' => 'Utilisateur modifié avec succès.',
    'login_success' => 'Connexion réussie.',
    'logout_success' => 'Déconnexion réussie.',
    'role_update_success' => 'Rôle de l\'utilisateur mis à jour avec succès.',
    'success_message' => 'Votre histoire a été soumise avec succès',
    'error_message' => 'Erreur lors de la soumission de votre histoire',
    'error_SQL' => 'Erreur SQL',
    'error_POST' => 'Données POST non reçues correctement',
    'upload_fail' => 'Erreur lors du téléchargement de l\'image',
    'error_img_format' => 'Fichier non valide. Seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.',
];
?>