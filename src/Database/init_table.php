<?php

/**
 * Retourne le type SQL correspondant.
 *
 * @param string $type
 * @return string
 */
function choice_type($type)
{
    return match ($type) {
        'id'       => 'INTEGER PRIMARY KEY AUTOINCREMENT',
        'text'     => 'TEXT NOT NULL',
        'int'      => 'INTEGER NOT NULL',
        'datetime' => 'DATETIME DEFAULT CURRENT_TIMESTAMP',
        default    => throw new InvalidArgumentException("Type de colonne inconnu : $type"),
    };
}

/**
 * Génère une requête SQL CREATE TABLE proprement.
 *
 * @param string $table Nom de la table
 * @param array $cols  Tableau associatif [colonne => type]
 * @return string
 */
function createTableQuery($table, $cols)
{
    if (empty($cols)) {
        throw new InvalidArgumentException("Aucune colonne fournie pour la table '$table'.");
    }

    $columns = [];
    foreach ($cols as $name => $type) {
        $columns[] = "$name " . choice_type($type);
    }

    $columns_sql = implode(", ", $columns);

    return "CREATE TABLE IF NOT EXISTS $table ($columns_sql);";
}

extract($data_table);

try {
    $query = createTableQuery($table, $cols);
    return $query;
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
