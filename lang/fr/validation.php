<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'unique'   => 'La valeur du champ :attribute est déjà utilisée.',
    'max'      => [
        'string' => 'Le texte de :attribute ne peut pas dépasser :max caractères.',
    ],
    'min'      => [
        'string' => 'Le texte de :attribute doit contenir au moins :min caractères.',
    ],
    // Tu peux ajouter d'autres règles ici si besoin
    
    'attributes' => [
        'code' => 'Code',
        'nomFiliere' => 'Nom de la Filière',
        'nom_classe' => 'Nom de la Classe',
        'inscription' => 'Montant Inscription',
        'mensualite' => 'Mensualité',
    ],
];