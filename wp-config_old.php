<?php
/**
 * Podstawowa konfiguracja WordPressa.
 *
 * Skrypt wp-config.php używa tego pliku podczas instalacji.
 * Nie musisz dokonywać konfiguracji przy pomocy przeglądarki internetowej,
 * możesz też skopiować ten plik, nazwać kopię "wp-config.php"
 * i wpisać wartości ręcznie.
 *
 * Ten plik zawiera konfigurację:
 *
 * * ustawień MySQL-a,
 * * tajnych kluczy,
 * * prefiksu nazw tabel w bazie danych,
 * * ABSPATH.
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Ustawienia MySQL-a - możesz uzyskać je od administratora Twojego serwera ** //
/** Nazwa bazy danych, której używać ma WordPress */
define('DB_NAME', 'baza23157_searchit');

/** Nazwa użytkownika bazy danych MySQL */
define('DB_USER', 'admin23157_searchit');

/** Hasło użytkownika bazy danych MySQL */
define('DB_PASSWORD', '9GK-zxC-fmR-S6m');

/** Nazwa hosta serwera MySQL */
define('DB_HOST', '23157.m.tld.pl');

/** Kodowanie bazy danych używane do stworzenia tabel w bazie danych. */
define('DB_CHARSET', 'utf8mb4');

/** Typ porównań w bazie danych. Nie zmieniaj tego ustawienia, jeśli masz jakieś wątpliwości. */
define('DB_COLLATE', '');

define('DISABLE_WP_CRON', true);

define('WP_MEMORY_LIMIT', '512M');

/**#@+
 * Unikatowe klucze uwierzytelniania i sole.
 *
 * Zmień każdy klucz tak, aby był inną, unikatową frazą!
 * Możesz wygenerować klucze przy pomocy {@link https://api.wordpress.org/secret-key/1.1/salt/ serwisu generującego tajne klucze witryny WordPress.org}
 * Klucze te mogą zostać zmienione w dowolnej chwili, aby uczynić nieważnymi wszelkie istniejące ciasteczka. Uczynienie tego zmusi wszystkich użytkowników do ponownego zalogowania się.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'QK+~WmBM_os yk.UUG2&S@7U&|no^/-%C|c9[<%LdV0p^gGC)*/COA_zO%`e8>hj');
define('SECURE_AUTH_KEY',  'DHZ3JjiM#yIBC;w9}|G|Nz.yB,J0T+oSd7:;peV: %-oruA18#l4cJY6|.L-Q~(:');
define('LOGGED_IN_KEY',    '2: b -{4z]NQSe&~:Y-B+wC~<YgS@!vEv%;gAff;n7CjzHogRRL~L++=}_Tky!#M');
define('NONCE_KEY',        '._9<`# j}XRy=E[9Pk2&Gb3IRjP hX*ie:c}-)$-hH4lZ;-b@@+NHm#A!J!b Czy');
define('AUTH_SALT',        'XOCkY2P<e?-%RJaIK~3B&*^S=m5,]?{^:R&;8kcav;WPZe~LXuB^vn47g{.|MJ4I');
define('SECURE_AUTH_SALT', 'iElUfc485|dZE,r:gXT|qm.f@=!!nirLb7NfzvHOa:)R&PS 2V31X8uNx`y*Do0f');
define('LOGGED_IN_SALT',   'cw%fy#+{xA$f-*c*s09n=z`K1/ *L+@ ey|=fO:u!cdqU?EMj}x(l-;UE_j;e7lQ');
define('NONCE_SALT',       '`3.rW@:APO1WV,RrK.xNe?0O-Gl.|}h)9PK*gKvD3X07*+]t,|pKyqK}Pj|;GTYi');

/**#@-*/

/**
 * Prefiks tabel WordPressa w bazie danych.
 *
 * Możesz posiadać kilka instalacji WordPressa w jednej bazie danych,
 * jeżeli nadasz każdej z nich unikalny prefiks.
 * Tylko cyfry, litery i znaki podkreślenia, proszę!
 */
$table_prefix  = 'wp_';

/**
 * Dla programistów: tryb debugowania WordPressa.
 *
 * Zmień wartość tej stałej na true, aby włączyć wyświetlanie
 * ostrzeżeń podczas modyfikowania kodu WordPressa.
 * Wielce zalecane jest, aby twórcy wtyczek oraz motywów używali
 * WP_DEBUG podczas pracy nad nimi.
 *
 * Aby uzyskać informacje o innych stałych, które mogą zostać użyte
 * do debugowania, przejdź na stronę Kodeksu WordPressa.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* To wszystko, zakończ edycję w tym miejscu! Miłego blogowania! */

/** Absolutna ścieżka do katalogu WordPressa. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Ustawia zmienne WordPressa i dołączane pliki. */
require_once(ABSPATH . 'wp-settings.php');
