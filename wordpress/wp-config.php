<?php
/**
 * WordPress için taban ayar dosyası.
 *
 * Bu dosya şu ayarları içerir: MySQL ayarları, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardım sayfasına göz atabilirsiniz. MySQL ayarlarınızı servis sağlayıcınızdan edinebilirsiniz.
 *
 * Bu dosya kurulum sırasında wp-config.php dosyasının oluşturulabilmesi için
 * kullanılır. İsterseniz bu dosyayı kopyalayıp, ismini "wp-config.php" olarak değiştirip,
 * değerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */

// ** MySQL ayarları - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanılacak veritabanının adı */
define( 'DB_NAME', 'wordpress' );

/** MySQL veritabanı kullanıcısı */
define( 'DB_USER', 'root' );

/** MySQL veritabanı parolası */
define( 'DB_PASSWORD', '' );

/** MySQL sunucusu */
define( 'DB_HOST', 'localhost' );

/** Yaratılacak tablolar için veritabanı karakter seti. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Veritabanı karşılaştırma tipi. Herhangi bir şüpheniz varsa bu değeri değiştirmeyin. */
define('DB_COLLATE', '');

/**#@+
 * Eşsiz doğrulama anahtarları.
 *
 * Her anahtar farklı bir karakter kümesi olmalı!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kılmak için istediğiniz zaman bu değerleri değiştirebilirsiniz. Bu tüm kullanıcıların tekrar giriş yapmasını gerektirecektir.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '+*zT$Ua^^Z!DQJXUh&_KbXv}k) @H>|(~^f N^stF{J<%xeS%Up%:.|eXlbogrEy' );
define( 'SECURE_AUTH_KEY',  '(oifKln4je#RBK%C9-{>;AA8=O}m.yr;U$[j|~3P)8)Y ~m[hH/2rsI<pIE<WYW?' );
define( 'LOGGED_IN_KEY',    'ljm_v0 l^DxT&o%n`}[8aOR.f1O8 x7 YJH0phu_cN-O)$z=Re[n_:*@eDRh&4HB' );
define( 'NONCE_KEY',        'O_W~@:@BlUP<HxS4)6Gh:DpXR3}fAzzpfiB!1Nm)2EP7_oo^#n2K}5>!u<X:I]%3' );
define( 'AUTH_SALT',        '-s<<yLg0ytiQ{cjLu1^aO_)vTWq>Gt*^IfZsC`.3a:1*0#/m}FU:K.@|*Bmg^3y]' );
define( 'SECURE_AUTH_SALT', 'ujuPw9&]:C{7 bymK^M7M#*OkN0kH@Qn??kmhb-P3;ydtMrd,8a}CoK]nXT7r0pN' );
define( 'LOGGED_IN_SALT',   '.Mgx$5#Z)g:m~fT4ji19h$muR5OIwB,25=iU~%j8o +PfK.mC/:B{:e<n7|^-ID?' );
define( 'NONCE_SALT',       'xDkHWx0(m&(0_<XNH8VoWsF>N]aS4#p_r`TIs&>C{J%dQQD]nt+7oJX(mxOYC=@~' );
/**#@-*/

/**
 * WordPress veritabanı tablo ön eki.
 *
 * Tüm kurulumlara ayrı bir önek vererek bir veritabanına birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix = 'wp_';

/**
 * Geliştiriciler için: WordPress hata ayıklama modu.
 *
 * Bu değeri "true" yaparak geliştirme sırasında hataların ekrana basılmasını sağlayabilirsiniz.
 * Tema ve eklenti geliştiricilerinin geliştirme aşamasında WP_DEBUG
 * kullanmalarını önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);

/* Hepsi bu kadar. Mutlu bloglamalar! */

/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** WordPress değişkenlerini ve yollarını kurar. */
require_once(ABSPATH . 'wp-settings.php');
